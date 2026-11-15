<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\User;
use App\Models\Laporan;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    /**
     * Dashboard Utama Admin
     */
    public function dashboard()
    {
        $totalBarang = (int) Barang::sum('jumlah');
        $totalAsetJenis = Barang::count();
        $totalRuangan = Ruangan::count();
        $totalKategori = Kategori::count();
        $totalNilaiAset = (float) Barang::selectRaw('SUM(jumlah * nilai_perolehan) as total')->value('total') ?? 0;
        
        $barangBaikCount = (int) Barang::where('kondisi', 'Baik')->sum('jumlah');
        $rusakRinganCount = (int) Barang::where('kondisi', 'Rusak Ringan')->sum('jumlah');
        $rusakBeratCount = (int) Barang::where('kondisi', 'Rusak Berat')->sum('jumlah');
        $afkirCount = (int) Barang::where('kondisi', 'Afkir')->sum('jumlah');
        $barangRusakCount = $rusakRinganCount + $rusakBeratCount + $afkirCount;
        $rasioKelayakan = $totalBarang > 0 ? round(($barangBaikCount / $totalBarang) * 100, 1) : 0;

        $laporanBelumVerifikasi = Laporan::where('status', 'Menunggu Verifikasi')->count();

        $barangTerbaru = Barang::with(['kategori', 'ruangan'])
            ->latest('id')
            ->limit(5)
            ->get();

        $laporanTerbaru = Laporan::with(['pelapor', 'ruangan', 'barang'])
            ->latest('id')
            ->limit(5)
            ->get();

        $topRuangans = Ruangan::withCount(['barangs as total_unit' => function($q) {
                $q->select(\Illuminate\Support\Facades\DB::raw('COALESCE(SUM(jumlah), 0)'));
            }])
            ->orderByDesc('total_unit')
            ->limit(4)
            ->get();

        $aktivitasTerbaru = ActivityLog::with('user')
            ->latest('id')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalAsetJenis',
            'totalRuangan',
            'totalKategori',
            'totalNilaiAset',
            'barangBaikCount',
            'rusakRinganCount',
            'rusakBeratCount',
            'afkirCount',
            'barangRusakCount',
            'rasioKelayakan',
            'laporanBelumVerifikasi',
            'barangTerbaru',
            'laporanTerbaru',
            'topRuangans',
            'aktivitasTerbaru'
        ));
    }

    /**
     * Data Inventaris Barang
     */
    public function barangIndex(Request $request)
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

        if ($ruanganId = $request->input('ruangan_id')) {
            $query->where('ruangan_id', $ruanganId);
        }

        if ($kondisi = $request->input('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        $perPage = $this->resolvePerPage($request);
        $barangs = $query->latest('id')->paginate($perPage)->withQueryString();
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();

        return view('admin.barang.index', compact('barangs', 'kategoris', 'ruangans'));
    }

    public function barangCreate()
    {
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        return view('admin.barang.create', compact('kategoris', 'ruangans'));
    }

    public function barangStore(Request $request)
    {
        if (!$request->filled('kode')) {
            $request->merge(['kode' => 'BRG-' . date('ym') . '-' . strtoupper(\Illuminate\Support\Str::random(4))]);
        }

        $request->validate([
            'kode' => 'required|string|max:50|unique:barangs,kode',
            'nama' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:30',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Afkir',
            'nilai_perolehan' => 'nullable|numeric|min:0',
            'tahun_pengadaan' => 'nullable|integer|min:1990|max:2030',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('foto');
        $data['satuan'] = $request->input('satuan', 'Unit');
        $data['nilai_perolehan'] = $request->input('nilai_perolehan', 0);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barangs', 'public');
        }

        $barang = Barang::create($data);
        ActivityLog::log('CREATE_BARANG', "Menambahkan barang baru: {$barang->nama} ({$barang->kode}).");

        return redirect()->route('admin.barang', ['per_page' => session('table_per_page', 10)])->with('success', "Barang {$barang->nama} berhasil ditambahkan!");
    }

    public function barangUpdate(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        if (!$request->filled('kode')) {
            $request->merge(['kode' => $barang->kode]);
        }

        $request->validate([
            'kode' => "required|string|max:50|unique:barangs,kode,{$barang->id}",
            'nama' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Afkir',
            'nilai_perolehan' => 'nullable|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('barangs', 'public');
        }

        $barang->update($data);
        ActivityLog::log('UPDATE_BARANG', "Memperbarui data barang: {$barang->nama} ({$barang->kode}).");

        return back()->with('success', "Barang {$barang->nama} berhasil diperbarui!");
    }

    public function barangDestroy($id)
    {
        $barang = Barang::findOrFail($id);
        $nama = $barang->nama;

        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();
        ActivityLog::log('DELETE_BARANG', "Menghapus barang: {$nama}.");

        return redirect()->route('admin.barang', ['per_page' => session('table_per_page', 10)])->with('success', "Barang {$nama} berhasil dihapus!");
    }

    /**
     * Kategori Barang
     */
    public function kategoriIndex(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $kategoris = Kategori::withCount('barangs')->latest('id')->paginate($perPage)->withQueryString();
        return view('admin.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        if (!$request->filled('kode')) {
            $request->merge(['kode' => 'KAT-' . strtoupper(\Illuminate\Support\Str::random(4))]);
        }

        $request->validate([
            'kode' => 'required|string|max:20|unique:kategoris,kode',
            'nama' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::create($request->all());
        ActivityLog::log('CREATE_KATEGORI', "Menambahkan kategori baru: {$kategori->nama}.");

        return back()->with('success', "Kategori {$kategori->nama} berhasil ditambahkan!");
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        if (!$request->filled('kode')) {
            $request->merge(['kode' => $kategori->kode]);
        }

        $request->validate([
            'kode' => "required|string|max:20|unique:kategoris,kode,{$kategori->id}",
            'nama' => 'required|string|max:100',
        ]);

        $kategori->update($request->all());
        ActivityLog::log('UPDATE_KATEGORI', "Memperbarui kategori: {$kategori->nama}.");

        return back()->with('success', "Kategori {$kategori->nama} berhasil diperbarui!");
    }

    public function kategoriDestroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $nama = $kategori->nama;
        $kategori->delete();
        ActivityLog::log('DELETE_KATEGORI', "Menghapus kategori: {$nama}.");

        return back()->with('success', "Kategori {$nama} berhasil dihapus!");
    }

    /**
     * Ruangan & Lokasi
     */
    public function ruanganIndex(Request $request)
    {
        $perPage = $this->resolvePerPage($request);
        $ruangans = Ruangan::with(['pj', 'barangs'])->latest('id')->paginate($perPage)->withQueryString();
        $listPJ = User::where('role', 'pj')->where('is_active', true)->get();

        return view('admin.ruangan', compact('ruangans', 'listPJ'));
    }

    public function ruanganStore(Request $request)
    {
        if (!$request->filled('kode')) {
            $request->merge(['kode' => 'RNG-' . strtoupper(\Illuminate\Support\Str::random(4))]);
        }

        $request->validate([
            'kode' => 'required|string|max:30|unique:ruangans,kode',
            'nama' => 'required|string|max:150',
            'sub' => 'nullable|string|max:150',
            'gedung' => 'required|string|max:100',
            'lantai' => 'nullable|string|max:100',
            'pj_id' => 'nullable|exists:users,id',
            'catatan' => 'nullable|string',
        ]);

        $ruangan = Ruangan::create($request->all());
        ActivityLog::log('CREATE_RUANGAN', "Menambahkan ruangan: {$ruangan->nama} ({$ruangan->kode}).");

        return back()->with('success', "Ruangan {$ruangan->nama} berhasil didaftarkan!");
    }

    public function ruanganUpdate(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        if (!$request->filled('kode')) {
            $request->merge(['kode' => $ruangan->kode]);
        }

        $request->validate([
            'kode' => "required|string|max:30|unique:ruangans,kode,{$ruangan->id}",
            'nama' => 'required|string|max:150',
            'gedung' => 'required|string|max:100',
            'pj_id' => 'nullable|exists:users,id',
        ]);

        $ruangan->update($request->all());
        ActivityLog::log('UPDATE_RUANGAN', "Memperbarui ruangan: {$ruangan->nama}.");

        return back()->with('success', "Ruangan {$ruangan->nama} berhasil diperbarui!");
    }

    public function ruanganDestroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $nama = $ruangan->nama;
        $ruangan->delete();
        ActivityLog::log('DELETE_RUANGAN', "Menghapus ruangan: {$nama}.");

        return back()->with('success', "Ruangan {$nama} berhasil dihapus!");
    }

    /**
     * Penanggung Jawab (PJ) Lab & Ruangan
     */
    public function penanggungJawabIndex(Request $request)
    {
        $query = User::where('role', 'pj')->with('ruangans');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }

        $perPage = $this->resolvePerPage($request);
        $listPJ = $query->latest('id')->paginate($perPage)->withQueryString();
        $ruangans = Ruangan::all();

        return view('admin.penanggung-jawab', compact('listPJ', 'ruangans'));
    }

    public function penanggungJawabStore(Request $request)
    {
        $cleanNip = trim($request->nip);
        $autoEmail = str_replace(' ', '', $cleanNip) . '@sekolah.sch.id';

        $request->validate([
            'name' => 'required|string|max:150',
            'nip' => 'required|string|max:30|unique:users,nip',
            'email' => 'nullable|email|max:100|unique:users,email',
            'password' => 'required|string|min:4',
            'jabatan' => 'required|string|max:100',
            'jurusan' => 'nullable|string|max:50',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'kontak' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'nip.unique' => 'NIP sudah terdaftar di sistem inventaris.',
            'password.required' => 'Kata sandi / sandi wajib diisi untuk login PJ.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
            'foto.max' => 'Ukuran foto profil maksimal 3 MB.',
        ]);

        $data = [
            'name' => $request->name,
            'nip' => $cleanNip,
            'email' => strtolower($request->email ?: $autoEmail),
            'password' => Hash::make($request->password),
            'role' => 'pj',
            'jabatan' => $request->jabatan,
            'jurusan' => $request->jurusan ?? 'Umum',
            'kontak' => $request->kontak,
            'is_active' => true,
        ];

        if ($request->hasFile('foto')) {
            $data['foto_profil'] = $request->file('foto')->store('profiles', 'public');
        }

        $user = User::create($data);

        // Tugaskan ke ruangan jika dipilih
        if ($request->filled('ruangan_id')) {
            Ruangan::where('id', $request->ruangan_id)->update(['pj_id' => $user->id]);
        }

        ActivityLog::log('CREATE_PJ', "Mendaftarkan Penanggung Jawab baru: {$user->name} (NIP. {$user->nip}).");

        return back()->with('success', "Penanggung Jawab {$user->name} (NIP: {$user->nip}) berhasil ditambahkan! PJ dapat login menggunakan NIP & sandi yang didaftarkan.");
    }

    public function penanggungJawabUpdate(Request $request, $id)
    {
        $user = User::where('role', 'pj')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150',
            'nip' => "required|string|max:30|unique:users,nip,{$user->id}",
            'email' => "required|email|max:100|unique:users,email,{$user->id}",
            'jabatan' => 'required|string|max:100',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'password' => 'nullable|string|min:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'foto.max' => 'Ukuran foto profil maksimal 3 MB.',
        ]);

        $data = $request->only(['name', 'nip', 'email', 'jabatan', 'jurusan', 'kontak']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto')->store('profiles', 'public');
        }

        $user->update($data);

        if ($request->filled('ruangan_id')) {
            Ruangan::where('id', $request->ruangan_id)->update(['pj_id' => $user->id]);
        }

        ActivityLog::log('UPDATE_PJ', "Memperbarui profil PJ: {$user->name}.");

        return back()->with('success', "Data PJ {$user->name} berhasil diperbarui!");
    }

    public function penanggungJawabDestroy($id)
    {
        $user = User::where('role', 'pj')->findOrFail($id);
        $nama = $user->name;
        $user->delete();

        ActivityLog::log('DELETE_PJ', "Menghapus akun PJ: {$nama}.");
        return back()->with('success', "Penanggung Jawab {$nama} berhasil dihapus!");
    }

    /**
     * Laporan Masuk dari PJ Lab
     */
    public function laporanMasukIndex(Request $request)
    {
        $query = Laporan::with(['pelapor', 'ruangan', 'barang']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_laporan', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%")
                  ->orWhereHas('pelapor', fn($p) => $p->where('name', 'like', "%{$search}%"));
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($jenis = $request->input('jenis')) {
            $query->where('jenis', $jenis);
        }

        $perPage = $this->resolvePerPage($request);
        $laporans = $query->latest('id')->paginate($perPage)->withQueryString();
        $totalLaporan = Laporan::count();
        $menungguCount = Laporan::where('status', 'Menunggu Verifikasi')->count();
        $prosesCount = Laporan::where('status', 'Sedang Diproses')->count();
        $selesaiCount = Laporan::where('status', 'Selesai Disetujui')->count();

        return view('admin.laporan-masuk', compact(
            'laporans',
            'totalLaporan',
            'menungguCount',
            'prosesCount',
            'selesaiCount'
        ));
    }

    public function laporanMasukUpdate(Request $request, $id)
    {
        $laporan = Laporan::with(['barang'])->findOrFail($id);

        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Sedang Diproses,Selesai Disetujui,Ditolak',
            'kondisi_barang' => 'nullable|string|max:100',
            'respon_admin' => 'required|string',
        ]);

        $laporan->status = $request->status;
        $laporan->kondisi_barang = $request->kondisi_barang;
        $laporan->respon_admin = $request->respon_admin;
        $laporan->admin_id = auth()->id();

        if ($request->status === 'Selesai Disetujui') {
            $laporan->tanggal_selesai = now();

            // SINKRONISASI KONDISI BARANG KE TABEL BARANGS
            if ($laporan->barang) {
                if ($laporan->jenis === 'Ganti Barang Rusak') {
                    // Tandai barang lama sebagai Afkir
                    $laporan->barang->update([
                        'kondisi' => 'Afkir',
                        'status_ketersediaan' => 'Afkir',
                        'keterangan' => 'Diganti unit baru/cadangan sarpras melalui ' . $laporan->kode_laporan,
                    ]);
                } elseif ($laporan->jenis === 'Barang Rusak' && str_contains($request->kondisi_barang, 'Baik')) {
                    // Servis tuntas
                    $laporan->barang->update([
                        'kondisi' => 'Baik',
                        'status_ketersediaan' => 'Tersedia',
                    ]);
                } elseif ($request->kondisi_barang) {
                    $cond = match ($request->kondisi_barang) {
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Rusak Berat' => 'Rusak Berat',
                        'Afkir / Hilang', 'Afkir' => 'Afkir',
                        default => 'Baik',
                    };
                    $laporan->barang->update(['kondisi' => $cond]);
                }
            }
        }

        $laporan->save();
        ActivityLog::log('VERIFIKASI_LAPORAN', "Memverifikasi laporan {$laporan->kode_laporan} dengan status: {$laporan->status}.");

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Laporan {$laporan->kode_laporan} berhasil diperbarui!",
                'status' => $laporan->status,
                'kondisi' => $laporan->kondisi_barang,
            ]);
        }

        return back()->with('success', "Laporan {$laporan->kode_laporan} berhasil ditindaklanjuti!");
    }

    public function laporanMasukDestroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $kode = $laporan->kode_laporan;
        $laporan->delete(); // Soft delete via SoftDeletes
        ActivityLog::log('DELETE_LAPORAN', "Menghapus riwayat laporan: {$kode} (Soft Delete).");

        return back()->with('success', "Riwayat laporan {$kode} berhasil dihapus ke tempat sampah (Soft Delete)!");
    }

    /**
     * Rekap Laporan Eksekutif & Cetak Dokumen Resmi
     */
    public function laporanIndex(Request $request)
    {
        // Export Excel / CSV
        if ($request->query('export') === 'excel') {
            $barangs = Barang::with(['kategori', 'ruangan'])->orderBy('nama')->get();
            $filename = 'Laporan-Inventaris-Sekolah-' . date('Ymd-His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ];
            $callback = function () use ($barangs) {
                $handle = fopen('php://output', 'w');
                fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM
                fputcsv($handle, ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Lokasi Ruangan', 'Jumlah', 'Satuan', 'Kondisi', 'Nilai Perolehan (Rp)', 'Tahun Pengadaan', 'Keterangan']);
                foreach ($barangs as $idx => $b) {
                    fputcsv($handle, [
                        $idx + 1,
                        $b->kode,
                        $b->nama,
                        $b->kategori?->nama ?? '-',
                        $b->ruangan?->nama ?? '-',
                        $b->jumlah,
                        $b->satuan,
                        $b->kondisi,
                        $b->nilai_perolehan,
                        $b->tahun_pengadaan,
                        $b->keterangan ?? '-',
                    ]);
                }
                fclose($handle);
            };
            return response()->stream($callback, 200, $headers);
        }

        $totalBarang = (int) Barang::sum('jumlah');
        $totalBaik = (int) Barang::where('kondisi', 'Baik')->sum('jumlah');
        $totalRingan = (int) Barang::where('kondisi', 'Rusak Ringan')->sum('jumlah');
        $totalBerat = (int) Barang::where('kondisi', 'Rusak Berat')->sum('jumlah');
        $totalAfkir = (int) Barang::where('kondisi', 'Afkir')->sum('jumlah');
        $nilaiAset = (float) Barang::selectRaw('SUM(jumlah * nilai_perolehan) as total')->value('total');

        $kategoris = Kategori::with(['barangs'])->get();
        $ruangans = Ruangan::all();

        $kategoriStats = $kategoris->map(function ($kat) {
            $bList = $kat->barangs;
            return [
                'nama' => $kat->nama,
                'icon' => $kat->icon ?? 'inventory_2',
                'total' => (int) $bList->sum('jumlah'),
                'baik' => (int) $bList->where('kondisi', 'Baik')->sum('jumlah'),
                'ringan' => (int) $bList->where('kondisi', 'Rusak Ringan')->sum('jumlah'),
                'berat' => (int) $bList->where('kondisi', 'Rusak Berat')->sum('jumlah'),
                'afkir' => (int) $bList->where('kondisi', 'Afkir')->sum('jumlah'),
            ];
        });

        $query = Laporan::with(['pelapor', 'ruangan', 'barang']);
        if ($kId = $request->input('kategori_id')) {
            $query->whereHas('barang', fn($b) => $b->where('kategori_id', $kId));
        }
        if ($rId = $request->input('ruangan_id')) {
            $query->where('ruangan_id', $rId);
        }
        if ($cond = $request->input('kondisi')) {
            $query->where('kondisi_barang', $cond);
        }

        $perPage = $this->resolvePerPage($request);
        $laporans = $query->latest('id')->paginate($perPage)->withQueryString();

        return view('admin.laporan', compact(
            'laporans', 'totalBarang', 'totalBaik', 'totalRingan', 'totalBerat', 'totalAfkir',
            'nilaiAset', 'kategoriStats', 'kategoris', 'ruangans'
        ));
    }

    /**
     * Resolusi dan persistensi pilihan jumlah baris per halaman (5, 10, 25, dst)
     */
    private function resolvePerPage(Request $request): int
    {
        if ($request->has('per_page') && (int)$request->input('per_page') > 0) {
            $perPage = (int) $request->input('per_page');
            session(['table_per_page' => $perPage]);
            return $perPage;
        }

        return (int) session('table_per_page', 10);
    }
}
