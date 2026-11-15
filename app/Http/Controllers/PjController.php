<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\ActivityLog;

class PjController extends Controller
{
    /**
     * Dashboard Penanggung Jawab (Cek Barang di Lab/Ruangan Sendiri)
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        
        // Ambil ruangan yang dipimpin oleh PJ ini
        $ruangans = $user->ruangans()->with(['barangs.kategori'])->get();
        $ruanganUtama = $ruangans->first();

        $allBarangs = $ruanganUtama ? $ruanganUtama->barangs : collect();
        $totalAset = $allBarangs->sum('jumlah');
        $baikCount = $allBarangs->where('kondisi', 'Baik')->sum('jumlah');
        $rusakCount = $allBarangs->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->sum('jumlah');

        $perPage = $this->resolvePerPage($request);
        $barangs = $ruanganUtama 
            ? $ruanganUtama->barangs()->with('kategori')->paginate($perPage)->withQueryString()
            : \App\Models\Barang::whereRaw('1=0')->paginate($perPage)->withQueryString();

        $laporanSaya = $user->laporans()->with('barang')->latest('id')->limit(5)->get();

        return view('pj.dashboard', compact(
            'user',
            'ruangans',
            'ruanganUtama',
            'barangs',
            'totalAset',
            'baikCount',
            'rusakCount',
            'laporanSaya'
        ));
    }

    /**
     * Riwayat Laporan & Form Pengaduan PJ
     */
    public function laporanIndex(Request $request)
    {
        $user = Auth::user();
        $perPage = $this->resolvePerPage($request);
        $laporans = $user->laporans()->with(['ruangan', 'barang'])->latest('id')->paginate($perPage)->withQueryString();
        
        $ruangans = $user->ruangans()->with('barangs')->get();
        $ruanganUtama = $ruangans->first();
        $barangsLab = $ruanganUtama ? $ruanganUtama->barangs : collect();

        $rusakCount = $user->laporans()->where('jenis', 'Barang Rusak')->count();
        $hilangCount = $user->laporans()->where('jenis', 'Barang Hilang')->count();
        $usulanCount = $user->laporans()->whereIn('jenis', ['Kebutuhan Barang Baru', 'Ganti Barang Rusak'])->count();

        return view('pj.laporan', compact(
            'user',
            'laporans',
            'ruangans',
            'ruanganUtama',
            'barangsLab',
            'rusakCount',
            'hilangCount',
            'usulanCount'
        ));
    }

    /**
     * Kirim Laporan / Pengaduan Baru ke Admin Sarpras
     * Validasi: Foto maks 3 MB (3072 KB), PDF/Excel maks 5 MB (5120 KB)
     */
    public function laporanStore(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Ganti Barang Rusak,Kebutuhan Barang Baru,Barang Rusak,Barang Hilang',
            'urgensi' => 'required|in:Biasa,Penting,Darurat',
            'nama_barang' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'barang_id' => 'nullable|exists:barangs,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'file_lampiran' => 'nullable|mimes:pdf,xls,xlsx,csv|max:5120',
        ], [
            'foto_bukti.max' => 'Ukuran file foto maksimal adalah 3 MB (3072 KB).',
            'file_lampiran.max' => 'Ukuran file PDF/Excel maksimal adalah 5 MB (5120 KB).',
            'file_lampiran.mimes' => 'Lampiran dokumen harus berformat PDF, XLS, XLSX, atau CSV.',
        ]);

        $user = Auth::user();
        $ruanganId = $request->ruangan_id ?? $user->ruangans()->first()?->id;

        // Generate Kode Laporan otomatis
        $tahun = date('Y');
        $count = Laporan::whereYear('created_at', $tahun)->count() + 1;
        $kodeLaporan = 'LAP-' . $tahun . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $fotoPath = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')->store('laporans/foto', 'public');
        }

        $lampiranPath = null;
        if ($request->hasFile('file_lampiran')) {
            $lampiranPath = $request->file('file_lampiran')->store('laporans/dokumen', 'public');
        }

        $laporan = Laporan::create([
            'kode_laporan' => $kodeLaporan,
            'user_id' => $user->id,
            'ruangan_id' => $ruanganId,
            'barang_id' => $request->barang_id,
            'jenis' => $request->jenis,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'urgensi' => $request->urgensi,
            'status' => 'Menunggu Verifikasi',
            'foto_bukti' => $fotoPath,
            'file_lampiran' => $lampiranPath,
            'tanggal_lapor' => now(),
        ]);

        ActivityLog::log('CREATE_LAPORAN', "PJ {$user->name} mengirimkan {$laporan->jenis}: {$laporan->nama_barang} ({$laporan->kode_laporan}).", $user);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Laporan {$laporan->kode_laporan} berhasil dikirim ke Admin Sarpras!",
                'laporan' => $laporan,
            ]);
        }

        return back()->with('success', "Laporan {$laporan->kode_laporan} berhasil dikirim ke Admin Sarpras dan dalam antrean verifikasi!");
    }

    /**
     * Resolusi dan persistensi pilihan jumlah baris per halaman
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->input('per_page', session('table_per_page', 10));
        if ($perPage > 0) {
            session(['table_per_page' => $perPage]);
        }
        return $perPage > 0 ? $perPage : 10;
    }
}
