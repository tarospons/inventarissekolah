<!-- Modal Detail Barang / Inventaris -->
<style>
  #modalDetailBarang .card-slicing {
    background: #ffffff;
    border: 1px solid #e5e9f2;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 32, 96, 0.04);
  }
  #modalDetailBarang .badge-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 99px;
    white-space: nowrap;
  }
  #modalDetailBarang .badge-status-baik {
    background: #dcfce7;
    color: #15803d;
  }
  #modalDetailBarang .badge-status-ringan {
    background: #fef3c7;
    color: #b45309;
  }
  #modalDetailBarang .badge-status-berat {
    background: #fee2e2;
    color: #b91c1c;
  }
</style>
<div class="modal fade" id="modalDetailBarang" tabindex="-1" aria-labelledby="modalDetailBarangLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <!-- Modal Header -->
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <div class="stat-icon-sq" style="width: 34px; height: 34px; background: rgba(255, 255, 255, 0.15); color: #fff; border-radius: 6px;">
            <span class="material-symbols-outlined fs-5">inventory_2</span>
          </div>
          <div>
            <h5 class="modal-title fs-6 fw-bold mb-0" id="modalDetailBarangLabel">Rincian Detail Barang Inventaris</h5>
            <small class="opacity-75" style="font-size: 11px;">Sistem Inventaris Sarana &amp; Prasarana Sekolah</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span id="dtlBrgKodeBadge" class="badge font-monospace" style="background: #38bdf8; color: #002366; font-size: 11px; font-weight: 700; padding: 4px 8px;">BRG-KOMP-001</span>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-3 p-md-4">
        <!-- Top Asset Header Card -->
        <div class="card-slicing p-3 mb-3" style="background: #f8faff; border-color: #dbeafe;">
          <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
              <div class="stat-icon-sq" style="width: 52px; height: 52px; background: #e0edff; color: #002366; border-radius: 10px;">
                <span id="dtlBrgIcon" class="material-symbols-outlined fs-2">devices</span>
              </div>
              <div>
                <h6 id="dtlBrgNama" class="fw-bold mb-1 text-dark fs-6">PC All-in-One HP ProOne 440 G9</h6>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                  <span id="dtlBrgKategori" class="badge" style="background: #e0e7ff; color: #1e3a8a; font-size: 11px;">Komputer</span>
                  <span class="text-muted small">•</span>
                  <span id="dtlBrgLokasi" class="text-muted small fw-semibold">Lab RPL 1</span>
                </div>
              </div>
            </div>
            <div class="text-sm-end">
              <div class="mb-1">
                <span id="dtlBrgKondisiBadge" class="badge-status badge-status-baik">● BAIK</span>
              </div>
              <div>
                <span class="text-muted small">Total Aset: </span>
                <b id="dtlBrgJumlah" class="fw-bold text-dark fs-6">36 Unit</b>
              </div>
            </div>
          </div>
        </div>

        <!-- Detail Table Grid -->
        <div class="card-slicing p-0 overflow-hidden mb-3">
          <table class="table table-bordered mb-0" style="font-size: 12.5px;">
            <tbody>
              <tr>
                <td class="bg-light fw-bold text-muted" style="width: 25%;">Kode Registrasi</td>
                <td style="width: 25%;"><span id="dtlBrgKode" class="font-monospace fw-bold text-primary">BRG-KOMP-001</span></td>
                <td class="bg-light fw-bold text-muted" style="width: 25%;">Merk / Seri Detail</td>
                <td style="width: 25%;" id="dtlBrgMerk">HP ProOne 440 G9</td>
              </tr>
              <tr>
                <td class="bg-light fw-bold text-muted">Lokasi Penempatan</td>
                <td id="dtlBrgRuangan">Lab RPL 1 (Gedung Praktik Lt. 2)</td>
                <td class="bg-light fw-bold text-muted">Penanggung Jawab (PJ)</td>
                <td id="dtlBrgPJ">Ahmad Fauzi, S.Kom.</td>
              </tr>
              <tr>
                <td class="bg-light fw-bold text-muted">Spesifikasi Teknis</td>
                <td colspan="3" id="dtlBrgSpek" class="lh-base">Core i5-12500, RAM 16GB DDR4, SSD 512GB NVMe, Monitor 23.8" FHD IPS, Windows 11 Pro Edu</td>
              </tr>
              <tr>
                <td class="bg-light fw-bold text-muted">Tahun Pengadaan</td>
                <td id="dtlBrgTahun">TA 2024/2025</td>
                <td class="bg-light fw-bold text-muted">Sumber Dana</td>
                <td id="dtlBrgSumber">BOS Reguler / Anggaran Sekolah</td>
              </tr>
              <tr>
                <td class="bg-light fw-bold text-muted">Status Garansi</td>
                <td id="dtlBrgGaransi" class="text-success fw-semibold">Garansi Resmi Aktif s.d Nov 2026</td>
                <td class="bg-light fw-bold text-muted">Nilai Taksiran Aset</td>
                <td id="dtlBrgHarga">Rp 14.500.000 / Unit</td>
              </tr>
              <tr>
                <td class="bg-light fw-bold text-muted">Keterangan / Catatan</td>
                <td colspan="3" id="dtlBrgCatatan" class="text-muted small lh-base">
                  Kondisi operasional 100% prima, seluruh unit terhubung LAN Gigabit dan digunakan aktif untuk praktikum pemrograman perangkat lunak.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer bg-light d-flex justify-content-between py-2 px-3">
        <small class="text-muted d-flex align-items-center gap-1" style="font-size: 11px;">
          <span class="material-symbols-outlined fs-6 text-primary">verified</span>
          Data terverifikasi Buku Induk Inventaris Sekolah.
        </small>
        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Dynamic Data Store for Items
  const itemsDetailData = {
    'BRG-KOMP-001': {
      kode: 'BRG-KOMP-001',
      nama: 'PC All-in-One HP ProOne 440 G9',
      kategori: 'Komputer',
      kondisi: 'BAIK',
      kondisiClass: 'badge-status-baik',
      icon: 'desktop_windows',
      jumlah: '36 Unit',
      merk: 'HP ProOne 440 G9 AiO',
      ruangan: 'Lab RPL 1 (Gedung Praktik Kejuruan Lt. 2)',
      pj: 'Ahmad Fauzi, S.Kom.',
      spek: 'Intel Core i5-12500, RAM 16GB DDR4, SSD 512GB NVMe, Layar 23.8" FHD IPS Anti-Glare, WiFi 6 + Bluetooth 5.2, Keyboard & Mouse Original HP',
      tahun: 'TA 2024/2025 (Semester Genap)',
      sumber: 'BOS Kinerja / SMK Pusat Keunggulan',
      garansi: 'Garansi Resmi HP Indonesia s.d 2026',
      harga: 'Rp 14.500.000 / Unit (Total: Rp 522.000.000)',
      catatan: 'Seluruh 36 unit aktif beroperasi 100% untuk Uji Kompetensi Keahlian (UKK) dan LSP-P1 Rekayasa Perangkat Lunak.'
    },
    'BRG-ELEK-014': {
      kode: 'BRG-ELEK-014',
      nama: 'Mikrotik Routerboard RB750Gr3 (hEX)',
      kategori: 'Elektronik',
      kondisi: 'BAIK',
      kondisiClass: 'badge-status-baik',
      icon: 'router',
      jumlah: '15 Unit',
      merk: 'MikroTik RB750Gr3',
      ruangan: 'Lab TKJ (Gedung Praktik Kejuruan Lt. 1)',
      pj: 'Dedi Setiawan, S.T.',
      spek: 'Dual Core 880MHz CPU, 256MB RAM, 5x Gigabit Ethernet Ports, USB Port, MicroSD Slot, RouterOS L4 Licensed',
      tahun: 'TA 2023/2024',
      sumber: 'BOS Reguler',
      garansi: 'Garansi Resmi Distributor 1 Tahun',
      harga: 'Rp 950.000 / Unit (Total: Rp 14.250.000)',
      catatan: 'Digunakan untuk modul praktikum routing statis/dinamis, bandwidth management, dan firewall filtering siswa TKJ.'
    },
    'BRG-FURN-032': {
      kode: 'BRG-FURN-032',
      nama: 'Meja Praktik Komputer Dual Seat',
      kategori: 'Furniture',
      kondisi: 'RUSAK RINGAN',
      kondisiClass: 'badge-status-ringan',
      icon: 'table_restaurant',
      jumlah: '20 Unit',
      merk: 'Custom Workstation Kayu Jati & Rangka Besi',
      ruangan: 'Lab RPL 2 (Gedung Praktik Kejuruan Lt. 2)',
      pj: 'Ahmad Fauzi, S.Kom.',
      spek: 'Dimensi 160 x 60 x 75 cm, Multipleks tebal 18mm HPL Wood Grain, Rangka Besi Hollow 4x4 cm Finishing Powder Coating',
      tahun: 'TA 2022/2023',
      sumber: 'Komite Sekolah',
      garansi: 'Purna Jual Vendor',
      harga: 'Rp 1.250.000 / Unit (Total: Rp 25.000.000)',
      catatan: '3 meja mengalami baut engsel kendur dan sedang dijadwalkan pengencangan oleh teknisi sarpras sekolah.'
    },
    'BRG-LAB-008': {
      kode: 'BRG-LAB-008',
      nama: 'Multimeter Digital Sanwa CD800a',
      kategori: 'Peralatan Laboratorium',
      kondisi: 'BAIK',
      kondisiClass: 'badge-status-baik',
      icon: 'science',
      jumlah: '12 Unit',
      merk: 'Sanwa CD800a Original Japan',
      ruangan: 'Bengkel Elektronika (Gedung Bengkel Lt. 1)',
      pj: 'Hendra Wijaya, S.T.',
      spek: '3-3/4 Digits 4000 Count, 0.7% Best Accuracy, Capacitance Measurement, Continuity with Buzzer, Tough Body Cover',
      tahun: 'TA 2024/2025',
      sumber: 'DAK Fisik SMK',
      garansi: 'Garansi 2 Tahun Resmi Sanwa',
      harga: 'Rp 780.000 / Unit (Total: Rp 9.360.000)',
      catatan: 'Instrumen pengukuran terkalibrasi berkala setiap 6 bulan sekali sesuai SOP laboratorium teknik elektronika.'
    },
    'BRG-AJAR-021': {
      kode: 'BRG-AJAR-021',
      nama: 'Proyektor Epson EB-E500 3300 Lumens',
      kategori: 'Peralatan Pembelajaran',
      kondisi: 'RUSAK BERAT',
      kondisiClass: 'badge-status-berat',
      icon: 'co_present',
      jumlah: '8 Unit',
      merk: 'Epson EB-E500 3LCD',
      ruangan: 'Ruang Guru (Gedung Utama Lt. 1)',
      pj: 'Siti Rahmawati, S.Pd.',
      spek: '3300 Lumens, XGA Resolution, Contrast Ratio 15.000:1, HDMI & VGA Input, Lamp Life up to 12.000 Hours',
      tahun: 'TA 2021/2022',
      sumber: 'BOS Reguler',
      garansi: 'Masa Garansi Berakhir',
      harga: 'Rp 5.400.000 / Unit (Total: Rp 43.200.000)',
      catatan: '2 unit mengalami kerusakan panel optik ballast dan lampu utama putus. Sudah diajukan Berita Acara Rekomendasi Pemusnahan/Lelang.'
    },
    'BRG-FURN-045': {
      kode: 'BRG-FURN-045',
      nama: 'Lemari Arsip Besi 4 Pintu Lion',
      kategori: 'Furniture',
      kondisi: 'BAIK',
      kondisiClass: 'badge-status-baik',
      icon: 'folder_shared',
      jumlah: '4 Unit',
      merk: 'Lion Steel Cabinet L-33A',
      ruangan: 'Ruang TU (Gedung Utama Lt. 1)',
      pj: 'Bambang Nugroho, S.AP.',
      spek: 'Bahan Pelat Baja Cold Rolled 0.8mm, Cat Powder Coating Abu-Abu, Kunci Sentral Anti-Duplikat, 4 Rak Adjustable',
      tahun: 'TA 2023/2024',
      sumber: 'BOS Reguler',
      garansi: 'Garansi Mekanikal 1 Tahun',
      harga: 'Rp 3.100.000 / Unit (Total: Rp 12.400.000)',
      catatan: 'Digunakan aman untuk penyimpanan Buku Induk Register Siswa, Ijazah, dan Arsip BMD Sekolah.'
    },
    'BRG-KOMP-015': {
      kode: 'BRG-KOMP-015',
      nama: 'Laptop ASUS ExpertBook B1400CBA',
      kategori: 'Komputer',
      kondisi: 'BAIK',
      kondisiClass: 'badge-status-baik',
      icon: 'laptop_mac',
      jumlah: '25 Unit',
      merk: 'ASUS ExpertBook B1400',
      ruangan: 'Lab RPL 1 (Gedung Praktik Kejuruan Lt. 2)',
      pj: 'Ahmad Fauzi, S.Kom.',
      spek: 'Intel Core i7-1255U, RAM 16GB DDR4, SSD 512GB NVMe, Layar 14" FHD IPS NanoEdge, Military Grade MIL-STD-810H',
      tahun: 'TA 2024/2025',
      sumber: 'BOS Kinerja / SMK Pusat Keunggulan',
      garansi: 'Garansi Resmi Asus Indonesia 2 Tahun',
      harga: 'Rp 13.800.000 / Unit (Total: Rp 345.000.000)',
      catatan: 'Unit inventaris mobile untuk praktikum coding siswa RPL dan guru produktif.'
    }
  };

  function openDetailBarangModal(kode) {
    const data = itemsDetailData[kode] || itemsDetailData['BRG-KOMP-001'];
    
    document.getElementById('dtlBrgKodeBadge').innerText = data.kode;
    document.getElementById('dtlBrgKode').innerText = data.kode;
    document.getElementById('dtlBrgNama').innerText = data.nama;
    document.getElementById('dtlBrgKategori').innerText = data.kategori;
    document.getElementById('dtlBrgLokasi').innerText = data.ruangan.split('(')[0].trim();
    document.getElementById('dtlBrgRuangan').innerText = data.ruangan;
    document.getElementById('dtlBrgJumlah').innerText = data.jumlah;
    document.getElementById('dtlBrgMerk').innerText = data.merk;
    document.getElementById('dtlBrgPJ').innerText = data.pj;
    document.getElementById('dtlBrgSpek').innerText = data.spek;
    document.getElementById('dtlBrgTahun').innerText = data.tahun;
    document.getElementById('dtlBrgSumber').innerText = data.sumber;
    document.getElementById('dtlBrgGaransi').innerText = data.garansi;
    document.getElementById('dtlBrgHarga').innerText = data.harga;
    document.getElementById('dtlBrgCatatan').innerText = data.catatan;
    document.getElementById('dtlBrgIcon').innerText = data.icon;

    const badge = document.getElementById('dtlBrgKondisiBadge');
    badge.className = 'badge-status ' + data.kondisiClass;
    badge.innerText = '● ' + data.kondisi;

    const modalEl = document.getElementById('modalDetailBarang');
    if (modalEl) {
      const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
      modal.show();
    }
  }
</script>
