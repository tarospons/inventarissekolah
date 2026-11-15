@extends('layouts.admin')

@section('title', 'Laporan Inventaris Barang')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 no-print">
  <div>
    <div class="page-breadcrumb">
      Home / Laporan / <span class="active-crumb">Eksekutif Pelaporan</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <h3 class="page-title">Laporan Inventaris Barang</h3>
      <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 10px; font-weight: 700; border-radius: 99px; padding: 4px 10px;">DOKUMEN RESMI</span>
    </div>
    <p class="page-subtitle">
      Rekapitulasi data sarana prasarana sekolah untuk pelaporan kepala sekolah dan dinas pendidikan.
    </p>
  </div>
  <div class="d-flex flex-wrap gap-2">
    <button type="button" class="btn-navy-slicing" onclick="window.print()">
      <span class="material-symbols-outlined fs-5">print</span> Cetak Laporan
    </button>
    <button type="button" class="btn-soft-slicing" onclick="window.print()" title="Cetak atau Simpan ke format PDF">
      <span class="material-symbols-outlined fs-5" style="color: #dc2626;">picture_as_pdf</span> Export PDF
    </button>
    <a href="{{ route('admin.laporan', array_merge(request()->query(), ['export' => 'excel'])) }}" class="btn-soft-slicing text-decoration-none" title="Download Rekap Data Format Excel/CSV">
      <span class="material-symbols-outlined fs-5" style="color: #15803d;">table_view</span> Export Excel
    </a>
  </div>
</div>

<!-- Parameter & Filter Laporan Form -->
<form method="GET" action="{{ route('admin.laporan') }}" class="filter-card p-3 no-print mb-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <div class="d-flex align-items-center gap-2 fw-bold text-dark" style="font-size: 12.5px;">
      <span class="material-symbols-outlined text-primary fs-5">tune</span>
      <span>PARAMETER &amp; FILTER LAPORAN</span>
    </div>
    <span class="small text-muted" style="font-size: 11px;">Total Nilai Aset: <b class="text-primary font-monospace">Rp {{ number_format($nilaiAset ?? 0, 0, ',', '.') }}</b></span>
  </div>

  <div class="row g-2">
    <div class="col-12 col-sm-6 col-lg-4">
      <label class="form-label small fw-bold text-muted mb-1" style="font-size: 10.5px;">KATEGORI BARANG</label>
      <select name="kategori_id" class="filter-select w-100">
        <option value="">Semua Kategori</option>
        @foreach($kategoris as $k)
          <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12 col-sm-6 col-lg-4">
      <label class="form-label small fw-bold text-muted mb-1" style="font-size: 10.5px;">KONDISI FISIK</label>
      <select name="kondisi" class="filter-select w-100">
        <option value="">Semua Kondisi Fisik</option>
        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Kondisi Baik</option>
        <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
        <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        <option value="Afkir" {{ request('kondisi') == 'Afkir' ? 'selected' : '' }}>Afkir / Siap Lelang</option>
      </select>
    </div>
    <div class="col-12 col-sm-12 col-lg-4">
      <label class="form-label small fw-bold text-muted mb-1" style="font-size: 10.5px;">LOKASI / RUANGAN</label>
      <select name="ruangan_id" class="filter-select w-100">
        <option value="">Seluruh Ruangan (Global)</option>
        @foreach($ruangans as $r)
          <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama }} ({{ $r->gedung }})</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="d-flex justify-content-end gap-2 mt-2 pt-2 border-top">
    <a href="{{ route('admin.laporan') }}" class="btn btn-sm btn-light border text-muted d-inline-flex align-items-center gap-1 text-decoration-none" style="font-size: 11.5px; height: 34px;">
      <span class="material-symbols-outlined fs-6">restart_alt</span> Reset Filter
    </a>
    <button type="submit" class="btn-navy-slicing" style="height: 34px; padding: 4px 14px;">
      <span class="material-symbols-outlined fs-6">filter_alt</span> Terapkan Filter
    </button>
  </div>
</form>

@php
  $persenBaik = $totalBarang > 0 ? round(($totalBaik / $totalBarang) * 100, 1) : 0;
  $persenRingan = $totalBarang > 0 ? round(($totalRingan / $totalBarang) * 100, 1) : 0;
  $persenBerat = $totalBarang > 0 ? round(($totalBerat / $totalBarang) * 100, 1) : 0;
@endphp
<!-- 4 Stat Progress Cards in Grid -->
<div class="row g-3 no-print mb-3">
  <!-- Card 1 -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL SELURUH BARANG</div>
          <div class="stat-box-num">{{ number_format($totalBarang, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #0a58ca;">
          <span class="material-symbols-outlined fs-4">inventory_2</span>
        </div>
      </div>
      <div class="mt-2">
        <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 10.5px;">
          <b class="text-dark">100%</b>
          <span>tercatat di {{ $ruangans->count() }} ruangan</span>
        </div>
        <div class="progress" style="height: 4px;">
          <div class="progress-bar" style="width: 100%; background: #002366;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">BARANG KONDISI BAIK</div>
          <div class="stat-box-num">{{ number_format($totalBaik, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e6f9f0; color: #059669;">
          <span class="material-symbols-outlined fs-4">check_circle</span>
        </div>
      </div>
      <div class="mt-2">
        <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 10.5px;">
          <b class="text-success">{{ $persenBaik }}%</b>
          <span>Kesiapan operasional KBM</span>
        </div>
        <div class="progress" style="height: 4px;">
          <div class="progress-bar" style="width: {{ $persenBaik }}%; background: #059669;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title" style="color: #b45309;">BARANG RUSAK RINGAN</div>
          <div class="stat-box-num" style="color: #1a1c2c;">{{ number_format($totalRingan, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #fef3c7; color: #d97706;">
          <span class="material-symbols-outlined fs-4">warning</span>
        </div>
      </div>
      <div class="mt-2">
        <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 10.5px;">
          <b style="color: #d97706;">{{ $persenRingan }}%</b>
          <span>Jadwal pemeliharaan rutin</span>
        </div>
        <div class="progress" style="height: 4px;">
          <div class="progress-bar" style="width: {{ $persenRingan }}%; background: #d97706;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title" style="color: #dc2626;">BARANG RUSAK BERAT</div>
          <div class="stat-box-num" style="color: #1a1c2c;">{{ number_format($totalBerat, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #fee2e2; color: #dc2626;">
          <span class="material-symbols-outlined fs-4">cancel</span>
        </div>
      </div>
      <div class="mt-2">
        <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 10.5px;">
          <b class="text-danger">{{ $persenBerat }}%</b>
          <span>Rekomendasi perbaikan/lelang</span>
        </div>
        <div class="progress" style="height: 4px;">
          <div class="progress-bar bg-danger" style="width: {{ $persenBerat }}%;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Row: Distribusi Kondisi & Rekapitulasi Kategori -->
<div class="row g-3 no-print mb-4">
  <!-- Left: Distribusi Kondisi Fisik -->
  <div class="col-12 col-lg-5">
    <div class="card-slicing p-3 px-4 h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex justify-content-between align-items-center mb-1">
          <h6 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 14.5px;">Distribusi Kondisi Fisik</h6>
          <span class="material-symbols-outlined text-muted fs-5">pie_chart</span>
        </div>
        <small class="text-muted d-block mb-3" style="font-size: 11px;">Rasio kelayakan fungsional inventaris sekolah terkini.</small>

        <!-- Conic Donut Chart -->
        <div class="d-flex justify-content-center my-3">
          <div style="width: 140px; height: 140px; border-radius: 50%; background: conic-gradient(#059669 0 {{ $persenBaik }}%, #d97706 {{ $persenBaik }}% {{ $persenBaik + $persenRingan }}%, #dc2626 {{ $persenBaik + $persenRingan }}% 100%); display: grid; place-items: center;">
            <div style="width: 102px; height: 102px; border-radius: 50%; background: #ffffff; display: flex; flex-direction: column; align-items: center; justify-content: center;">
              <div class="fw-extrabold font-serif" style="color: #059669; font-size: 21px; line-height: 1;">{{ $persenBaik }}%</div>
              <small class="text-muted fw-bold" style="font-size: 8.5px; letter-spacing: 0.04em;">LAYAK PAKAI</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Legend List -->
      <div class="d-flex flex-column gap-2 mt-3 pt-2 border-top">
        <div class="d-flex justify-content-between align-items-center">
          <span class="d-flex align-items-center gap-2 fw-semibold text-dark small" style="font-size: 12px;">
            <span style="width: 10px; height: 10px; border-radius: 50%; background: #059669;"></span> Baik
          </span>
          <div class="d-flex align-items-center gap-2">
            <span class="text-dark fw-bold small">{{ number_format($totalBaik, 0, ',', '.') }} Unit</span>
            <span class="badge" style="background: #e6f9f0; color: #059669; font-size: 10.5px;">{{ $persenBaik }}%</span>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <span class="d-flex align-items-center gap-2 fw-semibold text-dark small" style="font-size: 12px;">
            <span style="width: 10px; height: 10px; border-radius: 50%; background: #d97706;"></span> Rusak Ringan
          </span>
          <div class="d-flex align-items-center gap-2">
            <span class="text-dark fw-bold small">{{ number_format($totalRingan, 0, ',', '.') }} Unit</span>
            <span class="badge" style="background: #fef3c7; color: #d97706; font-size: 10.5px;">{{ $persenRingan }}%</span>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <span class="d-flex align-items-center gap-2 fw-semibold text-dark small" style="font-size: 12px;">
            <span style="width: 10px; height: 10px; border-radius: 50%; background: #dc2626;"></span> Rusak Berat
          </span>
          <div class="d-flex align-items-center gap-2">
            <span class="text-dark fw-bold small">{{ number_format($totalBerat, 0, ',', '.') }} Unit</span>
            <span class="badge" style="background: #fee2e2; color: #dc2626; font-size: 10.5px;">{{ $persenBerat }}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Right: Rekapitulasi Menurut Kategori -->
  <div class="col-12 col-lg-7">
    <div class="card-slicing overflow-hidden h-100 d-flex flex-column">
      <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
          <h6 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 14.5px;">Rekapitulasi Menurut Kategori</h6>
          <small class="text-muted" style="font-size: 11px;">Distribusi jumlah dan status teknis per klasifikasi barang</small>
        </div>
        <span class="material-symbols-outlined text-primary fs-5">category</span>
      </div>

      <div class="table-responsive flex-grow-1">
        <table class="table-slicing">
          <thead>
            <tr>
              <th class="ps-4">KATEGORI BARANG</th>
              <th class="text-center">TOTAL</th>
              <th class="text-center text-success">BAIK</th>
              <th class="text-center" style="color: #d97706;">R. RINGAN</th>
              <th class="text-center text-danger">R. BERAT</th>
              <th class="pe-4 text-end">PERSENTASE</th>
            </tr>
          </thead>
          <tbody>
            @forelse($kategoriStats as $ks)
            @php
              $pKat = $totalBarang > 0 ? round(($ks['total'] / $totalBarang) * 100, 1) : 0;
            @endphp
            <tr>
              <td class="ps-4 fw-semibold text-dark">
                <div class="d-flex align-items-center gap-2">
                  <span class="material-symbols-outlined text-primary fs-5">{{ $ks['icon'] }}</span>
                  <span>{{ $ks['nama'] }}</span>
                </div>
              </td>
              <td class="text-center fw-bold">{{ number_format($ks['total'], 0, ',', '.') }}</td>
              <td class="text-center text-success fw-bold">{{ number_format($ks['baik'], 0, ',', '.') }}</td>
              <td class="text-center fw-semibold" style="color: #d97706;">{{ number_format($ks['ringan'], 0, ',', '.') }}</td>
              <td class="text-center text-danger fw-semibold">{{ number_format($ks['berat'], 0, ',', '.') }}</td>
              <td class="pe-4 text-end fw-bold">{{ $pKat }}%</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-3 text-muted">Belum ada data kategori terdaftar.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="p-2 px-4 border-top d-flex justify-content-between align-items-center" style="background: #f1f4fd; font-size: 12px;">
        <span class="fw-bold text-dark">AKUMULASI SELURUH KATEGORI</span>
        <b style="color: #002366; font-size: 13px;">{{ number_format($totalBarang, 0, ',', '.') }} Unit (100%)</b>
      </div>
    </div>
  </div>
</div>

<!-- Pratinjau Lembar Laporan Cetak Resmi -->
<div class="no-print mt-2">
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-2">
    <div>
      <h5 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 17px;">Pratinjau Lembar Laporan Cetak Resmi</h5>
      <small class="text-muted" style="font-size: 11px;">Dokumen formal bertanda tangan sesuai format Pedoman Pengelolaan Sarana Prasarana Sekolah</small>
    </div>
    <span class="badge align-self-start align-self-sm-center" style="background: #e0f2fe; color: #0284c7; font-size: 11px; padding: 5px 12px; border-radius: 99px;">
      <span class="material-symbols-outlined fs-6 align-text-bottom">verified</span> Standar Format A4 Formal
    </span>
  </div>
</div>

<!-- Formal Printable Paper Document -->
<div class="paper-doc">
  <!-- Kop Surat Formal Bersih Tanpa Logo Spesifik -->
  <div class="kop-header text-center" style="border-bottom: 2px solid #1a1c2c; padding-bottom: 12px; margin-bottom: 16px;">
    <div style="font-size: 14px; font-weight: bold; letter-spacing: 0.05em; text-transform: uppercase;">Sistem Inventarisasi Sarana &amp; Prasarana</div>
    <div style="font-size: 18px; font-weight: 900; letter-spacing: 0.04em; color: #001f54; margin-top: 2px;">LAPORAN REKAPITULASI BARANG INVENTARIS SEKOLAH</div>
    <div style="font-size: 11px; color: #475569; margin-top: 3px;">Dokumen Rekapitulasi Fisik dan Kelayakan Operasional Sarana Prasarana Pendidikan</div>
  </div>

  <!-- Judul & Nomor Laporan Formal -->
  <div class="text-center my-3">
    <div style="font-size: 13px; font-weight: bold; text-decoration: underline; letter-spacing: 0.04em;">
      BERITA ACARA REKAPITULASI ASET DAN LOGISTIK SEKOLAH
    </div>
    <div style="font-size: 11px; margin-top: 2px; color: #475569;">
      Nomor: 028/INV/SARPRAS/{{ date('Y') }}
    </div>
  </div>

  <p style="text-align: justify; line-height: 1.6; font-size: 12px; margin-bottom: 12px;">
    Berdasarkan hasil sensus dan verifikasi fisik sarana prasarana yang dilaksanakan per <b>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</b>, dilaporkan ringkasan posisi kepemilikan dan kelayakan aset operasional satuan pendidikan sebagai berikut:
  </p>

  <!-- Tabel Resmi A4 -->
  <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px; font-size: 11px;" border="1" cellpadding="5">
    <thead>
      <tr style="background-color: #e2e8f0; text-align: center;">
        <th style="width: 35px;">NO</th>
        <th>KLASIFIKASI / KELOMPOK ASET</th>
        <th style="width: 65px;">BAIK</th>
        <th style="width: 85px;">RUSAK RINGAN</th>
        <th style="width: 80px;">RUSAK BERAT</th>
        <th style="width: 75px;">TOTAL UNIT</th>
        <th style="width: 140px;">STATUS PENGELOLAAN</th>
      </tr>
    </thead>
    <tbody>
      @forelse($kategoriStats as $idx => $ks)
      <tr>
        <td style="text-align: center;">{{ $idx + 1 }}</td>
        <td>{{ $ks['nama'] }}</td>
        <td style="text-align: center; color: #15803d; font-weight: bold;">{{ number_format($ks['baik'], 0, ',', '.') }}</td>
        <td style="text-align: center; color: #d97706;">{{ number_format($ks['ringan'], 0, ',', '.') }}</td>
        <td style="text-align: center; color: #dc2626;">{{ number_format($ks['berat'], 0, ',', '.') }}</td>
        <td style="text-align: center; font-weight: bold;">{{ number_format($ks['total'], 0, ',', '.') }}</td>
        <td>{{ $ks['baik'] >= $ks['ringan'] ? 'Optimal KBM' : 'Perlu Pemeliharaan' }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align: center; padding: 10px;">Belum ada data aset tercatat.</td>
      </tr>
      @endforelse
      <tr style="background-color: #f1f5f9; font-weight: bold;">
        <td colspan="2" style="text-align: center;">TOTAL KESELURUHAN UNIT</td>
        <td style="text-align: center; color: #15803d;">{{ number_format($totalBaik, 0, ',', '.') }}</td>
        <td style="text-align: center; color: #d97706;">{{ number_format($totalRingan, 0, ',', '.') }}</td>
        <td style="text-align: center; color: #dc2626;">{{ number_format($totalBerat, 0, ',', '.') }}</td>
        <td style="text-align: center; color: #002366;">{{ number_format($totalBarang, 0, ',', '.') }}</td>
        <td style="text-align: center; color: #002366;">100% Tercatat</td>
      </tr>
    </tbody>
  </table>

  <!-- Catatan Khusus -->
  <p style="font-size: 10.5px; font-style: italic; color: #475569; margin-bottom: 24px; line-height: 1.4;">
    *Catatan Khusus: Terhadap sejumlah {{ number_format($totalBerat, 0, ',', '.') }} unit barang dalam kategori Rusak Berat sedang diproses pembuatan Berita Acara Pemeriksaan Fisik Barang (BAPF) sebagai prasyarat administratif permohonan pemeliharaan/penghapusan aset ke pihak terkait.
  </p>

  <!-- Tanda Tangan Dua Pihak -->
  <div class="row text-center mt-3" style="font-size: 12px;">
    <div class="col-6">
      <div>Mengetahui,</div>
      <div class="fw-bold">Pengelola Barang / Admin Inventaris</div>
      <div style="height: 60px; display: grid; place-items: center; color: #94a3b8; font-size: 11px;">
        [ Tanda Tangan &amp; Stempel Satuan ]
      </div>
      <div class="fw-bold" style="text-decoration: underline;">Admin</div>
      <div style="font-size: 11px; color: #64748b;">Administrator Sarpras</div>
    </div>
    <div class="col-6">
      <div>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
      <div class="fw-bold">Kepala Sekolah</div>
      <div style="height: 60px; display: grid; place-items: center; color: #94a3b8; font-size: 11px;">
        [ Tanda Tangan &amp; Stempel Satuan ]
      </div>
      <div class="fw-bold" style="text-decoration: underline;">Kepala Sekolah</div>
      <div style="font-size: 11px; color: #64748b;">Kepala Sekolah</div>
    </div>
  </div>

  <!-- Document Meta Footer -->
  <div class="d-flex justify-content-between text-muted border-top pt-2 mt-4" style="font-size: 9.5px;">
    <span>Dokumen Resmi Sistem Inventaris Sekolah</span>
    <span>Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}</span>
    <span>Halaman 1 dari 1</span>
  </div>
</div>
@endsection
