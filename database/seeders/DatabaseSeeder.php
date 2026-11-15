<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\Laporan;
use App\Models\ActivityLog;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN UTAMA (Admin & Kepala Sekolah)
        $admin = User::updateOrCreate(
            ['email' => 'admin@adminsvc.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
                'nip' => null,
                'jabatan' => 'Administrator Sarpras',
                'jurusan' => 'Sarpras Sekolah',
                'kontak' => '0812-3344-5566',
                'is_active' => true,
            ]
        );

        $kepsek = User::updateOrCreate(
            ['email' => 'kepalasekolah@kepseksvc.com'],
            [
                'name' => 'Kepala Sekolah',
                'password' => Hash::make('kepsek1234'),
                'role' => 'kepsek',
                'nip' => null,
                'jabatan' => 'Kepala SMKN 4 Bojonegoro',
                'jurusan' => 'Manajemen Sekolah',
                'kontak' => '0811-2233-4455',
                'is_active' => true,
            ]
        );

        // Akun Penanggung Jawab (PJ) Lab / Bengkel & Wali Kelas
        $pjList = [
            ['name' => 'Ahmad Fauzi, S.Kom.', 'nip' => '19840312 200902 1 004', 'email' => 'ahmad.fauzi@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Lab RPL', 'jurusan' => 'RPL', 'kontak' => '0812-3456-7890'],
            ['name' => 'Joko Prasetyo, S.T.', 'nip' => '19820516 200801 1 007', 'email' => 'joko.prasetyo@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Bengkel TP', 'jurusan' => 'TP', 'kontak' => '0813-2345-6789'],
            ['name' => 'Ir. Wahyu Hidayat, S.T.', 'nip' => '19760921 200312 1 002', 'email' => 'wahyu.hidayat@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Bengkel GP', 'jurusan' => 'GP', 'kontak' => '0812-9876-5432'],
            ['name' => 'Chef Maya Anggraini, S.Pd.', 'nip' => '19880715 201204 2 006', 'email' => 'maya.anggraini@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Dapur Kuliner', 'jurusan' => 'KL', 'kontak' => '0821-4567-8901'],
            ['name' => 'Rina Kusuma, S.ST.Par.', 'nip' => '19861025 201001 2 018', 'email' => 'rina.kusuma@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Edotel PH', 'jurusan' => 'PH', 'kontak' => '0857-1234-5678'],
            ['name' => 'Drh. Tri Wibowo, S.Pt.', 'nip' => '19810419 200604 1 012', 'email' => 'tri.wibowo@smkn4bojonegoro.sch.id', 'jabatan' => 'Kepala Kandang ATR', 'jurusan' => 'ATR', 'kontak' => '0812-7890-1234'],
            ['name' => 'Siti Rahmawati, S.Pd.', 'nip' => '19790514 200501 2 008', 'email' => 'siti.rahmawati@smkn4bojonegoro.sch.id', 'jabatan' => 'PJ Ruang Guru', 'jurusan' => 'Umum', 'kontak' => '0856-7890-2345'],
            ['name' => 'Lestari Wahyuni, S.I.Pust.', 'nip' => '19851104 201101 2 011', 'email' => 'lestari.wahyuni@smkn4bojonegoro.sch.id', 'jabatan' => 'PJ Perpustakaan', 'jurusan' => 'Umum', 'kontak' => '0813-8901-2345'],
            ['name' => 'Bambang Nugroho, S.AP.', 'nip' => '19780622 200701 1 009', 'email' => 'bambang.nugroho@smkn4bojonegoro.sch.id', 'jabatan' => 'PJ Tata Usaha', 'jurusan' => 'Umum', 'kontak' => '0822-9012-3456'],
            ['name' => 'Hendra Wijaya, S.Kom.', 'nip' => '19850214 201001 1 015', 'email' => 'hendra.wijaya@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X RPL', 'jurusan' => 'RPL', 'kontak' => '0812-1122-3344'],
            ['name' => 'Budi Santoso, S.Pd.', 'nip' => '19830820 200901 1 011', 'email' => 'budi.santoso.tp@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X TP', 'jurusan' => 'TP', 'kontak' => '0813-4455-6677'],
            ['name' => 'Dewi Lestari, S.T.', 'nip' => '19890412 201402 2 007', 'email' => 'dewi.lestari@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X GP', 'jurusan' => 'GP', 'kontak' => '0821-5566-7788'],
            ['name' => 'Anisa Putri, S.Pd.', 'nip' => '19920115 201903 2 010', 'email' => 'anisa.putri@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X KL', 'jurusan' => 'KL', 'kontak' => '0857-6677-8899'],
            ['name' => 'Dimas Pratama, S.Pd.', 'nip' => '19901103 201504 1 008', 'email' => 'dimas.pratama@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X PH', 'jurusan' => 'PH', 'kontak' => '0812-7788-9900'],
            ['name' => 'Agus Salim, S.Pt.', 'nip' => '19870529 201101 1 016', 'email' => 'agus.salim@smkn4bojonegoro.sch.id', 'jabatan' => 'Wali Kelas X ATR', 'jurusan' => 'ATR', 'kontak' => '0813-8899-0011'],
        ];

        $pjMap = [];
        foreach ($pjList as $pj) {
            $u = User::updateOrCreate(
                ['nip' => $pj['nip']],
                array_merge($pj, [
                    'password' => Hash::make('pj123456'),
                    'role' => 'pj',
                    'is_active' => true,
                ])
            );
            $pjMap[$pj['nip']] = $u->id;
        }

        // 2. KATEGORI
        $katData = [
            ['kode' => 'KAT-KOMP', 'nama' => 'Komputer & IT', 'deskripsi' => 'PC All-in-One, Laptop, Server, Switch, Router', 'icon' => 'desktop_windows'],
            ['kode' => 'KAT-MESIN', 'nama' => 'Mesin & Bengkel', 'deskripsi' => 'Trafo Las, Gerinda, Plasma Cutting, Bubut', 'icon' => 'precision_manufacturing'],
            ['kode' => 'KAT-GEO', 'nama' => 'Instrumen Geologi', 'deskripsi' => 'Kompas Geologi, GPS Garmin, Mikroskop Polarisasi', 'icon' => 'terrain'],
            ['kode' => 'KAT-BOGA', 'nama' => 'Peralatan Kuliner', 'deskripsi' => 'Kompor Heavy Duty, Oven Convection, Mixer Spiral', 'icon' => 'skillet'],
            ['kode' => 'KAT-HOTEL', 'nama' => 'Fasilitas Edotel', 'deskripsi' => 'Mockup Suite Bed, Troli Housekeeping, Linen', 'icon' => 'hotel'],
            ['kode' => 'KAT-TERNAK', 'nama' => 'Peralatan Peternakan', 'deskripsi' => 'Mesin Chopper Pakan, Timbangan Hewan Digital', 'icon' => 'agriculture'],
            ['kode' => 'KAT-FURN', 'nama' => 'Furniture & Mebel', 'deskripsi' => 'Meja Kursi Siswa, Lemari Arsip, Rak Buku', 'icon' => 'table_restaurant'],
            ['kode' => 'KAT-ELEK', 'nama' => 'Elektronik & Media', 'deskripsi' => 'AC Split, Proyektor, Smart TV, Audio Sound', 'icon' => 'devices_other'],
        ];
        $katMap = [];
        foreach ($katData as $k) {
            $kat = Kategori::updateOrCreate(['kode' => $k['kode']], $k);
            $katMap[$k['kode']] = $kat->id;
        }

        // 3. RUANGAN
        $rngData = [
            ['kode' => 'RNG-LAB-RPL', 'nama' => 'Laboratorium RPL', 'sub' => 'Lab Software Rekayasa Perangkat Lunak', 'icon' => 'desktop_windows', 'gedung' => 'Gedung Praktik Kejuruan', 'lantai' => 'Lantai 2', 'pj_nip' => '19840312 200902 1 004'],
            ['kode' => 'RNG-BKL-TP', 'nama' => 'Bengkel Pengelasan (TP)', 'sub' => 'Bengkel Fabrikasi Las SMAW/GMAW', 'icon' => 'precision_manufacturing', 'gedung' => 'Gedung Bengkel TP', 'lantai' => 'Lantai 1', 'pj_nip' => '19820516 200801 1 007'],
            ['kode' => 'RNG-BKL-GP', 'nama' => 'Bengkel & Lab GP', 'sub' => 'Workshop Geologi Pertambangan', 'icon' => 'terrain', 'gedung' => 'Gedung Bengkel GP', 'lantai' => 'Lantai 1', 'pj_nip' => '19760921 200312 1 002'],
            ['kode' => 'RNG-DPR-KL', 'nama' => 'Dapur Praktik Kuliner (KL)', 'sub' => 'Kitchen Lab & Bakery Tata Boga', 'icon' => 'skillet', 'gedung' => 'Gedung Kuliner & Boga', 'lantai' => 'Lantai 1', 'pj_nip' => '19880715 201204 2 006'],
            ['kode' => 'RNG-HTL-PH', 'nama' => 'Edotel & Praktik PH', 'sub' => 'Mockup Suite Hotel Training Center', 'icon' => 'hotel', 'gedung' => 'Gedung Edotel SMKN 4', 'lantai' => 'Lantai 1-2', 'pj_nip' => '19861025 201001 2 018'],
            ['kode' => 'RNG-KDG-ATR', 'nama' => 'Kandang Teaching Farm ATR', 'sub' => 'Instalasi Ternak Ruminansia', 'icon' => 'agriculture', 'gedung' => 'Area Edu-Farm SMKN 4', 'lantai' => 'Zona Lapangan', 'pj_nip' => '19810419 200604 1 012'],
            ['kode' => 'RNG-GURU', 'nama' => 'Ruang Guru', 'sub' => 'Ruang Administrasi Pendidik', 'icon' => 'groups', 'gedung' => 'Gedung Utama', 'lantai' => 'Lantai 1', 'pj_nip' => '19790514 200501 2 008'],
            ['kode' => 'RNG-PERPUS', 'nama' => 'Perpustakaan Sekolah', 'sub' => 'Pusat Sumber Belajar & E-Library', 'icon' => 'local_library', 'gedung' => 'Gedung Penunjang', 'lantai' => 'Lantai 1', 'pj_nip' => '19851104 201101 2 011'],
            ['kode' => 'RNG-TU', 'nama' => 'Ruang Tata Usaha', 'sub' => 'Layanan Administrasi Sekolah', 'icon' => 'badge', 'gedung' => 'Gedung Utama', 'lantai' => 'Lantai 1', 'pj_nip' => '19780622 200701 1 009'],
            ['kode' => 'RNG-KLS-XRPL', 'nama' => 'Ruang Kelas X RPL', 'sub' => 'Ruang Teori X RPL', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 2', 'pj_nip' => '19850214 201001 1 015'],
            ['kode' => 'RNG-KLS-XTP', 'nama' => 'Ruang Kelas X TP', 'sub' => 'Ruang Teori X TP', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 1', 'pj_nip' => '19830820 200901 1 011'],
            ['kode' => 'RNG-KLS-XGP', 'nama' => 'Ruang Kelas X GP', 'sub' => 'Ruang Teori X GP', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 1', 'pj_nip' => '19890412 201402 2 007'],
            ['kode' => 'RNG-KLS-XKL', 'nama' => 'Ruang Kelas X KL', 'sub' => 'Ruang Teori X KL', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 2', 'pj_nip' => '19920115 201903 2 010'],
            ['kode' => 'RNG-KLS-XPH', 'nama' => 'Ruang Kelas X PH', 'sub' => 'Ruang Teori X PH', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 2', 'pj_nip' => '19901103 201504 1 008'],
            ['kode' => 'RNG-KLS-XATR', 'nama' => 'Ruang Kelas X ATR', 'sub' => 'Ruang Teori X ATR', 'icon' => 'school', 'gedung' => 'Gedung Teori', 'lantai' => 'Lantai 1', 'pj_nip' => '19870529 201101 1 016'],
        ];
        $rngMap = [];
        foreach ($rngData as $r) {
            $nip = $r['pj_nip'] ?? null;
            $pjId = $nip ? ($pjMap[$nip] ?? null) : null;
            $rCopy = $r;
            unset($rCopy['pj_nip']);
            $rCopy['pj_id'] = $pjId;
            $rng = Ruangan::updateOrCreate(
                ['kode' => $rCopy['kode']],
                $rCopy
            );
            $rngMap[$rCopy['kode']] = $rng->id;
        }

        // 4. INVENTARIS BARANG
        $brgData = [
            // Lab RPL
            ['kode' => 'BRG-KOMP-001', 'nama' => 'PC All-in-One HP ProOne 440 G9', 'kat' => 'KAT-KOMP', 'rng' => 'RNG-LAB-RPL', 'jumlah' => 36, 'kondisi' => 'Baik', 'nilai' => 12500000, 'tahun' => 2023],
            ['kode' => 'BRG-FURN-004', 'nama' => 'Meja Workstation Dual Seat', 'kat' => 'KAT-FURN', 'rng' => 'RNG-LAB-RPL', 'jumlah' => 18, 'kondisi' => 'Baik', 'nilai' => 1850000, 'tahun' => 2022],
            ['kode' => 'BRG-FURN-007', 'nama' => 'Kursi Siswa Hidrolik Ergonomis', 'kat' => 'KAT-FURN', 'rng' => 'RNG-LAB-RPL', 'jumlah' => 36, 'kondisi' => 'Baik', 'nilai' => 650000, 'tahun' => 2022],
            ['kode' => 'BRG-ELEK-002', 'nama' => 'Switch Gigabit Cisco 24-Port', 'kat' => 'KAT-KOMP', 'rng' => 'RNG-LAB-RPL', 'jumlah' => 2, 'kondisi' => 'Baik', 'nilai' => 7500000, 'tahun' => 2023],
            ['kode' => 'BRG-ELEK-009', 'nama' => 'AC Split Daikin Inverter 2 PK', 'kat' => 'KAT-ELEK', 'rng' => 'RNG-LAB-RPL', 'jumlah' => 2, 'kondisi' => 'Rusak Ringan', 'nilai' => 9200000, 'tahun' => 2021],

            // Bengkel TP
            ['kode' => 'BRG-TP-001', 'nama' => 'Mesin Trafo Las Inverter SMAW 200A', 'kat' => 'KAT-MESIN', 'rng' => 'RNG-BKL-TP', 'jumlah' => 16, 'kondisi' => 'Baik', 'nilai' => 3800000, 'tahun' => 2023],
            ['kode' => 'BRG-TP-002', 'nama' => 'Mesin Las TIG/Argon GTAW Miller', 'kat' => 'KAT-MESIN', 'rng' => 'RNG-BKL-TP', 'jumlah' => 6, 'kondisi' => 'Baik', 'nilai' => 18500000, 'tahun' => 2023],
            ['kode' => 'BRG-TP-003', 'nama' => 'Mesin Gerinda Tangan 4" Makita', 'kat' => 'KAT-MESIN', 'rng' => 'RNG-BKL-TP', 'jumlah' => 12, 'kondisi' => 'Rusak Ringan', 'nilai' => 850000, 'tahun' => 2022],
            ['kode' => 'BRG-TP-004', 'nama' => 'Kedok Las Auto Darkening Helmet', 'kat' => 'KAT-MESIN', 'rng' => 'RNG-BKL-TP', 'jumlah' => 24, 'kondisi' => 'Baik', 'nilai' => 450000, 'tahun' => 2023],

            // Bengkel GP
            ['kode' => 'BRG-GP-001', 'nama' => 'Kompas Geologi Brunton 5006LM', 'kat' => 'KAT-GEO', 'rng' => 'RNG-BKL-GP', 'jumlah' => 14, 'kondisi' => 'Baik', 'nilai' => 6200000, 'tahun' => 2022],
            ['kode' => 'BRG-GP-002', 'nama' => 'GPS Handheld Garmin Montana 700', 'kat' => 'KAT-GEO', 'rng' => 'RNG-BKL-GP', 'jumlah' => 8, 'kondisi' => 'Baik', 'nilai' => 11500000, 'tahun' => 2023],
            ['kode' => 'BRG-GP-003', 'nama' => 'Mikroskop Polarisasi Geologi Olympus', 'kat' => 'KAT-GEO', 'rng' => 'RNG-BKL-GP', 'jumlah' => 6, 'kondisi' => 'Baik', 'nilai' => 32000000, 'tahun' => 2021],

            // Dapur KL
            ['kode' => 'BRG-KL-001', 'nama' => 'Kompor 4 Burner Range Heavy Duty Gas', 'kat' => 'KAT-BOGA', 'rng' => 'RNG-DPR-KL', 'jumlah' => 8, 'kondisi' => 'Baik', 'nilai' => 16500000, 'tahun' => 2022],
            ['kode' => 'BRG-KL-002', 'nama' => 'Oven Deck Gas Convection Sinmag', 'kat' => 'KAT-BOGA', 'rng' => 'RNG-DPR-KL', 'jumlah' => 3, 'kondisi' => 'Baik', 'nilai' => 28000000, 'tahun' => 2021],
            ['kode' => 'BRG-KL-003', 'nama' => 'Planetary Mixer 20L Bakery Spiral', 'kat' => 'KAT-BOGA', 'rng' => 'RNG-DPR-KL', 'jumlah' => 4, 'kondisi' => 'Baik', 'nilai' => 12500000, 'tahun' => 2023],
            ['kode' => 'BRG-KL-005', 'nama' => 'Blender Commercial Heavy Duty', 'kat' => 'KAT-BOGA', 'rng' => 'RNG-DPR-KL', 'jumlah' => 6, 'kondisi' => 'Rusak Ringan', 'nilai' => 2200000, 'tahun' => 2022],

            // Edotel PH
            ['kode' => 'BRG-PH-001', 'nama' => 'Bed Set King Koil Deluxe Mockup Suite', 'kat' => 'KAT-HOTEL', 'rng' => 'RNG-HTL-PH', 'jumlah' => 6, 'kondisi' => 'Baik', 'nilai' => 14000000, 'tahun' => 2022],
            ['kode' => 'BRG-PH-002', 'nama' => 'Troli Housekeeping Linen & Amenities', 'kat' => 'KAT-HOTEL', 'rng' => 'RNG-HTL-PH', 'jumlah' => 4, 'kondisi' => 'Baik', 'nilai' => 6500000, 'tahun' => 2023],

            // Kandang ATR
            ['kode' => 'BRG-ATR-001', 'nama' => 'Mesin Chopper Pencacah Rumput 8.5 HP', 'kat' => 'KAT-TERNAK', 'rng' => 'RNG-KDG-ATR', 'jumlah' => 3, 'kondisi' => 'Rusak Ringan', 'nilai' => 9800000, 'tahun' => 2021],
            ['kode' => 'BRG-ATR-002', 'nama' => 'Timbangan Sapi Digital Kapasitas 2 Ton', 'kat' => 'KAT-TERNAK', 'rng' => 'RNG-KDG-ATR', 'jumlah' => 1, 'kondisi' => 'Baik', 'nilai' => 19500000, 'tahun' => 2023],

            // Ruang Guru & Kelas
            ['kode' => 'BRG-FURN-012', 'nama' => 'Meja Kerja Guru 1/2 Biro Modera', 'kat' => 'KAT-FURN', 'rng' => 'RNG-GURU', 'jumlah' => 45, 'kondisi' => 'Baik', 'nilai' => 1250000, 'tahun' => 2022],
            ['kode' => 'BRG-FURN-052', 'nama' => 'Rak Buku Dua Sisi Besi 5 Tingkat', 'kat' => 'KAT-FURN', 'rng' => 'RNG-PERPUS', 'jumlah' => 16, 'kondisi' => 'Baik', 'nilai' => 2400000, 'tahun' => 2021],
            ['kode' => 'BRG-KLS-001', 'nama' => 'Meja & Kursi Siswa Standar Kemdikbud', 'kat' => 'KAT-FURN', 'rng' => 'RNG-KLS-XRPL', 'jumlah' => 36, 'kondisi' => 'Baik', 'nilai' => 650000, 'tahun' => 2023],
            ['kode' => 'BRG-KLS-004', 'nama' => 'Kipas Angin Dinding KDK 16"', 'kat' => 'KAT-ELEK', 'rng' => 'RNG-KLS-XRPL', 'jumlah' => 2, 'kondisi' => 'Baik', 'nilai' => 480000, 'tahun' => 2023],
        ];

        $brgMap = [];
        foreach ($brgData as $b) {
            $katId = $katMap[$b['kat']] ?? null;
            $rngId = $rngMap[$b['rng']] ?? null;
            $brg = Barang::updateOrCreate(
                ['kode' => $b['kode']],
                [
                    'nama' => $b['nama'],
                    'kategori_id' => $katId,
                    'ruangan_id' => $rngId,
                    'jumlah' => $b['jumlah'],
                    'satuan' => 'Unit',
                    'kondisi' => $b['kondisi'],
                    'nilai_perolehan' => $b['nilai'],
                    'tahun_pengadaan' => $b['tahun'],
                ]
            );
            $brgMap[$b['kode']] = $brg->id;
        }

        // 5. LAPORAN MASUK DARI PJ
        $lapData = [
            [
                'kode_laporan' => 'LAP-2025-001',
                'pj_nip' => '19820516 200801 1 007',
                'rng_kode' => 'RNG-BKL-TP',
                'brg_kode' => 'BRG-TP-003',
                'jenis' => 'Ganti Barang Rusak',
                'nama_barang' => 'Mesin Gerinda Tangan 4" Makita (BRG-TP-003)',
                'deskripsi' => 'Armature rotor terbakar konsleting saat praktik pengelasan kelas XI TP, minta penggantian unit baru.',
                'urgensi' => 'Darurat',
                'status' => 'Sedang Diproses',
                'kondisi_barang' => 'Afkir / Diganti',
                'respon_admin' => 'Disetujui penggantian. Unit cadangan disiapkan dari gudang sarpras untuk Bengkel TP.',
            ],
            [
                'kode_laporan' => 'LAP-2025-002',
                'pj_nip' => '19840312 200902 1 004',
                'rng_kode' => 'RNG-LAB-RPL',
                'brg_kode' => null,
                'jenis' => 'Kebutuhan Barang Baru',
                'nama_barang' => 'Crimping Tool & Kabel Tester RJ-45 (5 Set)',
                'deskripsi' => 'Pengajuan tambahan alat praktik instalasi LAN untuk uji kompetensi UKK siswa RPL.',
                'urgensi' => 'Penting',
                'status' => 'Menunggu Verifikasi',
                'kondisi_barang' => 'Rencana Pengadaan Baru',
                'respon_admin' => 'Menunggu review anggaran pengadaan sarana praktik semester genap.',
            ],
            [
                'kode_laporan' => 'LAP-2025-003',
                'pj_nip' => '19880715 201204 2 006',
                'rng_kode' => 'RNG-DPR-KL',
                'brg_kode' => 'BRG-KL-005',
                'jenis' => 'Ganti Barang Rusak',
                'nama_barang' => 'Blender Commercial Heavy Duty',
                'deskripsi' => 'Gear penggerak aus dan motor overheat, minta penggantian unit operasional dapur.',
                'urgensi' => 'Penting',
                'status' => 'Sedang Diproses',
                'kondisi_barang' => 'Rusak Berat',
                'respon_admin' => 'Alokasi penggantian disetujui, dalam verifikasi stok gudang tata boga.',
            ],
            [
                'kode_laporan' => 'LAP-2025-004',
                'pj_nip' => '19810419 200604 1 012',
                'rng_kode' => 'RNG-KDG-ATR',
                'brg_kode' => 'BRG-ATR-001',
                'jenis' => 'Barang Rusak',
                'nama_barang' => 'Mesin Chopper Pencacah Rumput 8.5 HP',
                'deskripsi' => 'V-Belt putus dan pisau perajang tumpul setelah pencacahan rumput gajah harian.',
                'urgensi' => 'Penting',
                'status' => 'Sedang Diproses',
                'kondisi_barang' => 'Rusak Ringan',
                'respon_admin' => 'Mekanik sarpras dijadwalkan memasang V-Belt baru dan pengasahan pisau chopper.',
            ],
        ];

        foreach ($lapData as $lp) {
            $uId = $pjMap[$lp['pj_nip']] ?? $admin->id;
            $rId = $rngMap[$lp['rng_kode']] ?? null;
            $bId = $brgMap[$lp['brg_kode'] ?? ''] ?? null;
            Laporan::updateOrCreate(
                ['kode_laporan' => $lp['kode_laporan']],
                [
                    'user_id' => $uId,
                    'ruangan_id' => $rId,
                    'barang_id' => $bId,
                    'jenis' => $lp['jenis'],
                    'nama_barang' => $lp['nama_barang'],
                    'deskripsi' => $lp['deskripsi'],
                    'urgensi' => $lp['urgensi'],
                    'status' => $lp['status'],
                    'kondisi_barang' => $lp['kondisi_barang'],
                    'respon_admin' => $lp['respon_admin'],
                    'admin_id' => $admin->id,
                    'tanggal_lapor' => now()->subDays(rand(1, 4)),
                ]
            );
        }

        ActivityLog::log('MIGRATE_SEED', 'Database berhasil diinisialisasi.', $admin);
    }
}
