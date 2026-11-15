<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Laporan;
use App\Models\Kategori;

class KepsekController extends Controller
{
    /**
     * Dashboard Kepala Sekolah (Monitoring Eksekutif)
     */
    public function dashboard()
    {
        $totalUnit = (int) Barang::sum('jumlah');
        $totalAsetRupiah = (float) Barang::selectRaw('SUM(jumlah * nilai_perolehan) as total')->value('total') ?? 0;
        
        $baikUnit = (int) Barang::where('kondisi', 'Baik')->sum('jumlah');
        $rusakRinganUnit = (int) Barang::where('kondisi', 'Rusak Ringan')->sum('jumlah');
        $rusakBeratUnit = (int) Barang::where('kondisi', 'Rusak Berat')->sum('jumlah');
        $afkirUnit = (int) Barang::where('kondisi', 'Afkir')->sum('jumlah');

        $rasioKelaikan = $totalUnit > 0 ? round(($baikUnit / $totalUnit) * 100, 1) : 100.0;

        $totalRuangan = Ruangan::count();
        $ruanganTerisi = Ruangan::has('barangs')->count();

        $barangTerbaru = Barang::with(['kategori', 'ruangan'])
            ->latest('id')
            ->limit(5)
            ->get();

        $kategoriStats = Kategori::withCount(['barangs as total_unit' => function($q) {
                $q->select(\Illuminate\Support\Facades\DB::raw('COALESCE(SUM(jumlah), 0)'));
            }])
            ->orderByDesc('total_unit')
            ->limit(6)
            ->get();

        $laporanPerluAtensi = Laporan::with(['pelapor', 'ruangan'])
            ->whereIn('status', ['Menunggu Verifikasi', 'Sedang Diproses'])
            ->latest('id')
            ->limit(6)
            ->get();

        $ruanganList = Ruangan::withCount('barangs')
            ->with(['pj'])
            ->orderBy('nama')
            ->get();

        return view('kepsek.dashboard', compact(
            'totalUnit',
            'totalAsetRupiah',
            'baikUnit',
            'rusakRinganUnit',
            'rusakBeratUnit',
            'afkirUnit',
            'rasioKelaikan',
            'totalRuangan',
            'ruanganTerisi',
            'barangTerbaru',
            'kategoriStats',
            'laporanPerluAtensi',
            'ruanganList'
        ));
    }

    /**
     * Monitoring Inventaris Sekolah (Read-Only Eksekutif)
     */
    public function inventaris(Request $request)
    {
        $query = Barang::with(['kategori', 'ruangan']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        if ($kategoriId = $request->input('kategori_id')) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($kondisi = $request->input('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        $perPage = $this->resolvePerPage($request);
        $barangs = $query->latest('id')->paginate($perPage)->withQueryString();
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();

        return view('kepsek.inventaris', compact('barangs', 'kategoris', 'ruangans'));
    }

    /**
     * Monitoring Persebaran Ruangan
     */
    public function ruangan(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $ruangans = Ruangan::with(['pj', 'barangs'])->latest('id')->paginate($perPage)->withQueryString();
        return view('kepsek.ruangan', compact('ruangans'));
    }

    /**
     * Monitoring Laporan & Pengaduan Sarpras
     */
    public function laporan(Request $request)
    {
        $query = Laporan::with(['pelapor', 'ruangan', 'barang']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($jenis = $request->input('jenis')) {
            $query->where('jenis', $jenis);
        }

        $perPage = $this->resolvePerPage($request);
        $laporans = $query->latest('id')->paginate($perPage)->withQueryString();
        return view('kepsek.laporan', compact('laporans'));
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
