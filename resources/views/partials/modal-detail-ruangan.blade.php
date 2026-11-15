<!-- Modal Detail Ruangan & Rincian Inventaris -->
<style>
  #modalDetailRuangan .card-slicing {
    background: #ffffff;
    border: 1px solid #e5e9f2;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 32, 96, 0.04);
  }
  #modalDetailRuangan .badge-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 99px;
    white-space: nowrap;
  }
  #modalDetailRuangan .badge-status-baik {
    background: #dcfce7;
    color: #15803d;
  }
  #modalDetailRuangan .badge-status-ringan {
    background: #fef3c7;
    color: #b45309;
  }
  #modalDetailRuangan .badge-status-berat {
    background: #fee2e2;
    color: #b91c1c;
  }
  #modalDetailRuangan .table-slicing {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
  }
  #modalDetailRuangan .table-slicing thead th {
    background: #e8ecfa;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.05em;
    color: #475569;
    padding: 9px 12px;
    border: none;
    white-space: nowrap;
  }
  #modalDetailRuangan .table-slicing tbody td {
    padding: 8px 12px;
    border-top: 1px solid #f1f3fa;
    font-size: 12px;
    vertical-align: middle;
    color: #1a1c2c;
  }
</style>
<div class="modal fade" id="modalDetailRuangan" tabindex="-1" aria-labelledby="modalDetailRuanganLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <!-- Modal Header -->
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <div class="stat-icon-sq" style="width: 34px; height: 34px; background: rgba(255, 255, 255, 0.15); color: #fff; border-radius: 6px;">
            <span class="material-symbols-outlined fs-5">meeting_room</span>
          </div>
          <div>
            <h5 class="modal-title fs-6 fw-bold mb-0" id="modalDetailRuanganLabel">Rincian &amp; Inventaris Ruangan</h5>
            <small class="opacity-75" style="font-size: 11px;">Data spasial sarana &amp; prasarana Sekolah</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span id="dtlRngKodeBadge" class="badge font-monospace" style="background: #38bdf8; color: #002366; font-size: 11px; font-weight: 700; padding: 4px 8px;">RNG-RPL1</span>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-3 p-md-4">
        <!-- Room Info Summary Card -->
        <div class="card-slicing p-3 mb-3" style="background: #f8faff; border-color: #dbeafe;">
          <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
            <div>
              <div class="d-flex align-items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-primary fs-5">apartment</span>
                <h6 id="dtlRngNama" class="fw-bold mb-0 text-dark fs-6">Laboratorium RPL 1</h6>
                <span id="dtlRngSub" class="badge" style="background: #e0edff; color: #002366; font-size: 10px;">Lab Komputer Software</span>
              </div>
              <div class="text-muted small">
                Lokasi: <b id="dtlRngGedung" class="text-dark">Gedung Praktik Kejuruan Lt. 2</b>
              </div>
              <div class="text-muted small mt-1">
                Penanggung Jawab: <span id="dtlRngPJ" class="fw-semibold text-primary">Ahmad Fauzi, S.Kom.</span>
              </div>
            </div>
            <div class="text-sm-end">
              <div class="text-muted small mb-1">Status Kelayakan:</div>
              <span id="dtlRngKondisiStatus" class="badge-status" style="background: #e0f2fe; color: #0284c7; font-size: 12px; padding: 5px 12px;">● 96% Baik</span>
            </div>
          </div>
        </div>

        <!-- 3 Stat Mini Cards for Room -->
        <div class="row g-2 mb-3">
          <div class="col-4">
            <div class="p-2 px-3 rounded-2 text-center border" style="background: #ffffff;">
              <small class="text-muted d-block" style="font-size: 10px;">TOTAL ASET TERDATA</small>
              <b id="dtlRngTotalAset" class="text-dark fs-6 font-serif">142 Unit</b>
            </div>
          </div>
          <div class="col-4">
            <div class="p-2 px-3 rounded-2 text-center border" style="background: #f0fdf4;">
              <small class="text-success d-block fw-bold" style="font-size: 10px;">KONDISI BAIK</small>
              <b id="dtlRngBaikAset" class="text-success fs-6 font-serif">136 Unit (95.8%)</b>
            </div>
          </div>
          <div class="col-4">
            <div class="p-2 px-3 rounded-2 text-center border" style="background: #fffbeb;">
              <small class="text-warning d-block fw-bold" style="font-size: 10px;">RUSAK RINGAN/BERAT</small>
              <b id="dtlRngRusakAset" class="text-warning fs-6 font-serif">6 Unit (4.2%)</b>
            </div>
          </div>
        </div>

        <!-- Table of Inventory Items in This Room -->
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="fw-bold text-dark small" style="font-size: 12px;">DAFTAR ASET DI DALAM RUANGAN</span>
          <span class="text-muted small" style="font-size: 11px;">Inventaris Terdaftar</span>
        </div>
        <div class="card-slicing p-0 overflow-hidden mb-3">
          <div class="table-responsive" style="max-height: 240px;">
            <table class="table-slicing mb-0">
              <thead>
                <tr>
                  <th class="ps-3" style="width: 35px;">NO</th>
                  <th style="width: 110px;">KODE ASET</th>
                  <th>NAMA BARANG</th>
                  <th>KATEGORI</th>
                  <th style="width: 80px;">JUMLAH</th>
                  <th class="pe-3 text-end" style="width: 100px;">KONDISI</th>
                </tr>
              </thead>
              <tbody id="dtlRngItemsTbody">
                <!-- Dynamically populated -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- Room Note -->
        <div class="p-2 px-3 rounded-2 bg-light border text-muted small" style="font-size: 11.5px; line-height: 1.4;">
          <span class="material-symbols-outlined fs-6 text-primary align-text-bottom">info</span>
          <span id="dtlRngCatatan">Ruangan aktif digunakan untuk KBM produktif dan Tempat Uji Kompetensi (TUK) sekolah.</span>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer bg-light d-flex justify-content-between py-2 px-3">
        <small class="text-muted d-flex align-items-center gap-1" style="font-size: 11px;">
          <span class="material-symbols-outlined fs-6 text-primary">schedule</span>
          Terakhir diverifikasi tim sarpras sekolah.
        </small>
        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Dynamic Data Store for Rooms
  const roomsDetailData = {
    'RNG-LAB-RPL': {
      kode: 'RNG-LAB-RPL',
      nama: 'Laboratorium RPL',
      sub: 'Lab Komputer Software Rekayasa Perangkat Lunak',
      gedung: 'Gedung Praktik Kejuruan Lt. 2',
      pj: 'Ahmad Fauzi, S.Kom. (NIP. 19840312 200902 1 004)',
      status: '● 96% Baik',
      total: '142 Unit',
      baik: '136 Unit (95.8%)',
      rusak: '6 Unit (4.2%)',
      catatan: 'Ruangan terakreditasi BNSP untuk Tempat Uji Kompetensi (TUK) RPL, ber-AC dan koneksi fiber optic 100 Mbps.',
      items: [
        { kode: 'BRG-KOMP-001', nama: 'PC All-in-One HP ProOne 440 G9', kategori: 'Komputer', qty: '36 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-FURN-004', nama: 'Meja Praktik Workstation Dual Seat', kategori: 'Furniture', qty: '18 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-FURN-007', nama: 'Kursi Siswa Hidrolik Ergonomis', kategori: 'Furniture', qty: '36 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-ELEK-002', nama: 'Switch Gigabit Cisco 24-Port', kategori: 'Elektronik', qty: '2 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-AJAR-003', nama: 'Smart Whiteboard Interaktif 75"', kategori: 'Pembelajaran', qty: '1 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-ELEK-009', nama: 'AC Split Daikin Inverter 2 PK', kategori: 'Elektronik', qty: '2 Unit', cond: 'Rusak Ringan', condClass: 'badge-status-ringan' }
      ]
    },
    'RNG-BKL-TP': {
      kode: 'RNG-BKL-TP',
      nama: 'Bengkel Pengelasan (TP)',
      sub: 'Bengkel & Fabrikasi Teknik Pengelasan',
      gedung: 'Gedung Bengkel TP Lt. 1',
      pj: 'Joko Prasetyo, S.T. (NIP. 19820516 200801 1 007)',
      status: '● 93% Baik',
      total: '115 Unit',
      baik: '107 Unit (93.0%)',
      rusak: '8 Unit (7.0%)',
      catatan: 'Bengkel praktik standar industri pengelasan SMAW, GMAW, GTAW, dan pemotongan plasma cutting berstandar K3.',
      items: [
        { kode: 'BRG-TP-001', nama: 'Mesin Trafo Las Inverter SMAW 200A', kategori: 'Mesin', qty: '16 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-TP-002', nama: 'Mesin Las TIG/Argon GTAW Miller', kategori: 'Mesin', qty: '6 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-TP-003', nama: 'Mesin Gerinda Tangan Makita 4"', kategori: 'Peralatan', qty: '12 Unit', cond: 'Rusak Ringan', condClass: 'badge-status-ringan' },
        { kode: 'BRG-TP-004', nama: 'Kedok Las Auto Darkening Helmet', kategori: 'Alat K3', qty: '24 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-BKL-GP': {
      kode: 'RNG-BKL-GP',
      nama: 'Bengkel & Lab GP',
      sub: 'Laboratorium & Workshop Geologi Pertambangan',
      gedung: 'Gedung Bengkel GP Lt. 1',
      pj: 'Ir. Wahyu Hidayat, S.T. (NIP. 19760921 200312 1 002)',
      status: '● 94% Baik',
      total: '98 Unit',
      baik: '92 Unit (93.9%)',
      rusak: '6 Unit (6.1%)',
      catatan: 'Pusat eksplorasi batuan dan mineral geologi, pemetaan topografi, dan preparasi batuan pertambangan.',
      items: [
        { kode: 'BRG-GP-001', nama: 'Kompas Geologi Brunton 5006LM', kategori: 'Instrumen', qty: '14 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-GP-002', nama: 'GPS Handheld Garmin Montana 700', kategori: 'Instrumen', qty: '8 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-GP-003', nama: 'Mikroskop Polarisasi Geologi Olympus', kategori: 'Laboratorium', qty: '6 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-GP-004', nama: 'Palu Geologi Estwing Pipih & Runcing', kategori: 'Peralatan', qty: '20 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-DPR-KL': {
      kode: 'RNG-DPR-KL',
      nama: 'Dapur Praktik Kuliner (KL)',
      sub: 'Kitchen Lab & Bakery Tata Boga',
      gedung: 'Gedung Kuliner & Boga Lt. 1',
      pj: 'Chef Maya Anggraini, S.Pd. (NIP. 19880715 201204 2 006)',
      status: '● 97% Baik',
      total: '130 Unit',
      baik: '126 Unit (96.9%)',
      rusak: '4 Unit (3.1%)',
      catatan: 'Dapur komersial standar industri kuliner dengan workstation stainless steel, exhaust hood, dan cold storage.',
      items: [
        { kode: 'BRG-KL-001', nama: 'Kompor 4 Burner Range Heavy Duty Gas', kategori: 'Kitchenware', qty: '8 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KL-002', nama: 'Oven Deck Gas Convection Sinmag', kategori: 'Kitchenware', qty: '3 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KL-003', nama: 'Planetary Mixer 20L Bakery Spiral', kategori: 'Peralatan', qty: '4 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KL-004', nama: 'Stainless Steel Prep Table 180cm', kategori: 'Furniture', qty: '12 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-HTL-PH': {
      kode: 'RNG-HTL-PH',
      nama: 'Edotel & Praktik PH',
      sub: 'Hotel Training Center & Mockup Room Perhotelan',
      gedung: 'Gedung Edotel Lt. 1-2',
      pj: 'Rina Kusuma, S.ST.Par. (NIP. 19861025 201001 2 018)',
      status: '● 98% Baik',
      total: '88 Unit',
      baik: '86 Unit (97.7%)',
      rusak: '2 Unit (2.3%)',
      catatan: 'Unit usaha dan laboratorium edotel perhotelan sekolah untuk simulasi front office dan housekeeping.',
      items: [
        { kode: 'BRG-PH-001', nama: 'Bed Set King Koil Deluxe Mockup Suite', kategori: 'Furniture', qty: '6 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-PH-002', nama: 'Troli Housekeeping Linen & Amenities', kategori: 'Housekeeping', qty: '4 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-PH-003', nama: 'POS Front Office Computer System', kategori: 'Komputer', qty: '2 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-KDG-ATR': {
      kode: 'RNG-KDG-ATR',
      nama: 'Kandang Teaching Farm ATR',
      sub: 'Instalasi Ternak Ruminansia Besar & Kecil',
      gedung: 'Area Edu-Farm Ruminansia Sekolah',
      pj: 'Drh. Tri Wibowo, S.Pt. (NIP. 19810419 200604 1 012)',
      status: '● 92% Baik',
      total: '64 Unit',
      baik: '59 Unit (92.2%)',
      rusak: '5 Unit (7.8%)',
      catatan: 'Laboratorium peternakan ruminansia sapi dan kambing perah/potong dengan mesin pengolah pakan silase dan biogas.',
      items: [
        { kode: 'BRG-ATR-001', nama: 'Mesin Chopper Pencacah Rumput 8.5 HP', kategori: 'Mesin', qty: '3 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-ATR-002', nama: 'Timbangan Sapi Digital Kapasitas 2 Ton', kategori: 'Instrumen', qty: '1 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-ATR-003', nama: 'Mesin Pemotong Silase Pakan Ternak', kategori: 'Mesin', qty: '2 Unit', cond: 'Rusak Ringan', condClass: 'badge-status-ringan' }
      ]
    },
    'RNG-GURU': {
      kode: 'RNG-GURU',
      nama: 'Ruang Guru',
      sub: 'Ruang Administrasi Pendidik',
      gedung: 'Gedung Utama Lt. 1',
      pj: 'Siti Rahmawati, S.Pd. (NIP. 19790514 200501 2 008)',
      status: '● 98% Baik',
      total: '65 Unit',
      baik: '64 Unit (98.5%)',
      rusak: '1 Unit (1.5%)',
      catatan: 'Fasilitas kerja dan administrasi seluruh dewan guru sekolah.',
      items: [
        { kode: 'BRG-FURN-012', nama: 'Meja Kerja Guru 1/2 Biro Modera', kategori: 'Furniture', qty: '45 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-FURN-015', nama: 'Kursi Putar Busa Rebonded Guru', kategori: 'Furniture', qty: '45 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-AJAR-021', nama: 'Proyektor Epson EB-E500 3300 Lumens', kategori: 'Pembelajaran', qty: '4 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-PERPUS': {
      kode: 'RNG-PERPUS',
      nama: 'Perpustakaan Sekolah',
      sub: 'Pusat Sumber Belajar & E-Library',
      gedung: 'Gedung Penunjang Lt. 1',
      pj: 'Lestari Wahyuni, S.I.Pust. (NIP. 19851104 201101 2 011)',
      status: '● 94% Baik',
      total: '96 Unit',
      baik: '90 Unit (93.8%)',
      rusak: '6 Unit (6.2%)',
      catatan: 'Perpustakaan berbasis digital (e-library) dengan ribuan koleksi buku referensi kejuruan.',
      items: [
        { kode: 'BRG-FURN-052', nama: 'Rak Buku Dua Sisi Besi 5 Tingkat', kategori: 'Furniture', qty: '16 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KOMP-026', nama: 'PC Terminal OPAC & Digital Library', kategori: 'Komputer', qty: '6 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-FURN-058', nama: 'Meja Baca Lesehan & Kelompok', kategori: 'Furniture', qty: '12 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-TU': {
      kode: 'RNG-TU',
      nama: 'Ruang Tata Usaha',
      sub: 'Layanan Administrasi Sekolah',
      gedung: 'Gedung Utama Lt. 1',
      pj: 'Bambang Nugroho, S.AP. (NIP. 19780622 200701 1 009)',
      status: '● 95% Baik',
      total: '54 Unit',
      baik: '51 Unit (94.4%)',
      rusak: '3 Unit (5.6%)',
      catatan: 'Pusat layanan administrasi kesiswaan, kepegawaian, dan persuratan sekolah.',
      items: [
        { kode: 'BRG-FURN-045', nama: 'Lemari Arsip Besi 4 Pintu Lion', kategori: 'Furniture', qty: '4 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KOMP-019', nama: 'PC Admin Tata Usaha Core i3', kategori: 'Komputer', qty: '8 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-ELEK-041', nama: 'Printer All-in-One Epson L3210', kategori: 'Elektronik', qty: '4 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-KLS-XRPL': {
      kode: 'RNG-KLS-XRPL',
      nama: 'Ruang Kelas X RPL',
      sub: 'Ruang Teori Kelas X Rekayasa Perangkat Lunak',
      gedung: 'Gedung Pembelajaran Teori Lt. 2',
      pj: 'Hendra Wijaya, S.Kom. (Wali Kelas X RPL)',
      status: '● 98% Baik',
      total: '74 Unit',
      baik: '72 Unit (97.3%)',
      rusak: '2 Unit (2.7%)',
      catatan: 'Ruang kelas teori reguler X RPL dilengkapi smart TV/proyektor dan sarana KBM lengkap.',
      items: [
        { kode: 'BRG-KLS-001', nama: 'Meja Siswa Single Wooden Top', kategori: 'Furniture', qty: '36 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KLS-002', nama: 'Kursi Siswa Besi Kayu', kategori: 'Furniture', qty: '36 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KLS-003', nama: 'Papan Tulis Whiteboard Magnetik 240x120', kategori: 'Pembelajaran', qty: '1 Unit', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KLS-004', nama: 'Kipas Angin Dinding KDK 16"', kategori: 'Elektronik', qty: '2 Unit', cond: 'Rusak Ringan', condClass: 'badge-status-ringan' }
      ]
    },
    'RNG-KLS-XTP': {
      kode: 'RNG-KLS-XTP',
      nama: 'Ruang Kelas X TP',
      sub: 'Ruang Teori Kelas X Teknik Pengelasan',
      gedung: 'Gedung Pembelajaran Teori Lt. 1',
      pj: 'Budi Santoso, S.Pd. (Wali Kelas X TP)',
      status: '● 95% Baik',
      total: '74 Unit',
      baik: '70 Unit (94.6%)',
      rusak: '4 Unit (5.4%)',
      catatan: 'Ruang kelas teori reguler X TP dengan penataan ergonomis.',
      items: [
        { kode: 'BRG-KLS-010', nama: 'Meja & Kursi Siswa Standar Kemdikbud', kategori: 'Furniture', qty: '36 Set', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KLS-011', nama: 'Proyektor BenQ Wallmount', kategori: 'Pembelajaran', qty: '1 Unit', cond: 'Rusak Ringan', condClass: 'badge-status-ringan' }
      ]
    },
    'RNG-KLS-XGP': {
      kode: 'RNG-KLS-XGP',
      nama: 'Ruang Kelas X GP',
      sub: 'Ruang Teori Kelas X Geologi Pertambangan',
      gedung: 'Gedung Pembelajaran Teori Lt. 1',
      pj: 'Dewi Lestari, S.T. (Wali Kelas X GP)',
      status: '● 97% Baik',
      total: '74 Unit',
      baik: '72 Unit (97.3%)',
      rusak: '2 Unit (2.7%)',
      catatan: 'Ruang kelas teori reguler X GP.',
      items: [
        { kode: 'BRG-KLS-020', nama: 'Meja & Kursi Siswa Standar Kemdikbud', kategori: 'Furniture', qty: '36 Set', cond: 'Baik', condClass: 'badge-status-baik' },
        { kode: 'BRG-KLS-021', nama: 'Whiteboard 240x120 cm', kategori: 'Pembelajaran', qty: '1 Unit', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-KLS-XKL': {
      kode: 'RNG-KLS-XKL',
      nama: 'Ruang Kelas X KL',
      sub: 'Ruang Teori Kelas X Kuliner',
      gedung: 'Gedung Pembelajaran Teori Lt. 2',
      pj: 'Anisa Putri, S.Pd. (Wali Kelas X KL)',
      status: '● 96% Baik',
      total: '74 Unit',
      baik: '71 Unit (95.9%)',
      rusak: '3 Unit (4.1%)',
      catatan: 'Ruang kelas teori reguler X KL.',
      items: [
        { kode: 'BRG-KLS-030', nama: 'Meja & Kursi Siswa Standar Kemdikbud', kategori: 'Furniture', qty: '36 Set', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-KLS-XPH': {
      kode: 'RNG-KLS-XPH',
      nama: 'Ruang Kelas X PH',
      sub: 'Ruang Teori Kelas X Perhotelan',
      gedung: 'Gedung Pembelajaran Teori Lt. 2',
      pj: 'Dimas Pratama, S.Pd. (Wali Kelas X PH)',
      status: '● 98% Baik',
      total: '74 Unit',
      baik: '73 Unit (98.6%)',
      rusak: '1 Unit (1.4%)',
      catatan: 'Ruang kelas teori reguler X PH.',
      items: [
        { kode: 'BRG-KLS-040', nama: 'Meja & Kursi Siswa Standar Kemdikbud', kategori: 'Furniture', qty: '36 Set', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    },
    'RNG-KLS-XATR': {
      kode: 'RNG-KLS-XATR',
      nama: 'Ruang Kelas X ATR',
      sub: 'Ruang Teori Kelas X Agribisnis Ternak Ruminansia',
      gedung: 'Gedung Pembelajaran Teori Lt. 1',
      pj: 'Agus Salim, S.Pt. (Wali Kelas X ATR)',
      status: '● 95% Baik',
      total: '74 Unit',
      baik: '70 Unit (94.6%)',
      rusak: '4 Unit (5.4%)',
      catatan: 'Ruang kelas teori reguler X ATR.',
      items: [
        { kode: 'BRG-KLS-050', nama: 'Meja & Kursi Siswa Standar Kemdikbud', kategori: 'Furniture', qty: '36 Set', cond: 'Baik', condClass: 'badge-status-baik' }
      ]
    }
  };

  // Cross-reference aliases
  const codeAliases = {
    'RNG-RPL1': 'RNG-LAB-RPL',
    'R-RPL-01': 'RNG-LAB-RPL',
    'R-TP-01': 'RNG-BKL-TP',
    'R-GP-01': 'RNG-BKL-GP',
    'R-KL-01': 'RNG-DPR-KL',
    'R-PH-01': 'RNG-HTL-PH',
    'R-ATR-01': 'RNG-KDG-ATR',
    'R-GUR-01': 'RNG-GURU',
    'R-TU-01': 'RNG-TU',
    'R-PUS-01': 'RNG-PERPUS'
  };

  function openDetailRuanganModal(kode) {
    const normalizedKode = codeAliases[kode] || kode;
    const data = roomsDetailData[normalizedKode] || roomsDetailData['RNG-RPL1'];

    document.getElementById('dtlRngKodeBadge').innerText = data.kode;
    document.getElementById('dtlRngNama').innerText = data.nama;
    document.getElementById('dtlRngSub').innerText = data.sub;
    document.getElementById('dtlRngGedung').innerText = data.gedung;
    document.getElementById('dtlRngPJ').innerText = data.pj;
    document.getElementById('dtlRngKondisiStatus').innerText = data.status;
    document.getElementById('dtlRngTotalAset').innerText = data.total;
    document.getElementById('dtlRngBaikAset').innerText = data.baik;
    document.getElementById('dtlRngRusakAset').innerText = data.rusak;
    document.getElementById('dtlRngCatatan').innerText = data.catatan;

    // Populate table of items inside room
    const tbody = document.getElementById('dtlRngItemsTbody');
    tbody.innerHTML = '';
    data.items.forEach((item, index) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="ps-3 text-muted fw-semibold">${index + 1}</td>
        <td><span class="font-monospace fw-bold text-primary" style="font-size: 11px;">${item.kode}</span></td>
        <td class="fw-semibold text-dark">${item.nama}</td>
        <td><span class="badge" style="background: #eef2fe; color: #475569; font-size: 10.5px;">${item.kategori}</span></td>
        <td><b class="text-dark">${item.qty}</b></td>
        <td class="pe-3 text-end"><span class="badge-status ${item.condClass}">● ${item.cond}</span></td>
      `;
      tbody.appendChild(tr);
    });

    const modalEl = document.getElementById('modalDetailRuangan');
    if (modalEl) {
      const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
      modal.show();
    }
  }
</script>
