@extends('layouts.kepsek')

@section('title', 'Laporan Inventaris')

@push('styles')
<style>
  .card-box {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,35,107,.07);
  }
  .bc {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .04em;
    color: var(--mut);
    margin: 6px 0;
  }
  .bc b { color: var(--teal); }
  .ph {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    margin: 8px 0 16px;
    flex-wrap: wrap;
  }
  .ph h1 {
    font-size: 24px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 4px;
  }
  .ph p {
    color: var(--mut);
    max-width: 540px;
    line-height: 1.5;
    font-size: 12px;
    margin-bottom: 0;
  }
  .b-action {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 36px;
    padding: 0 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 12px;
    text-decoration: none;
    border: 0;
    cursor: pointer;
  }
  .b-action.primary { background: var(--navy); color: #fff; }
  .b-action.outline { background: #fff; color: var(--navy); box-shadow: 0 1px 4px rgba(0,35,107,.12); }
  .filters-row {
    display: flex;
    gap: 10px;
    padding: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
    align-items: center;
  }
  .filters-row select, .filters-row input {
    border: 1px solid var(--line);
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 12px;
    background: #fff;
    color: #1a1c2c;
  }
  table.tb-laporan { width: 100%; border-collapse: collapse; }
  table.tb-laporan th {
    background: var(--soft);
    font-size: 9.5px;
    letter-spacing: .04em;
    padding: 10px 12px;
    text-align: left;
    color: var(--mut);
  }
  table.tb-laporan td {
    padding: 10px 12px;
    font-size: 11.5px;
    border-top: 1px solid var(--line);
    vertical-align: middle;
  }
  .paper-doc {
    background: #fff;
    padding: 36px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,35,107,.1);
    color: #1a1c2c;
    font-family: 'Times New Roman', Times, serif;
    margin-top: 24px;
  }
  .paper-kop {
    text-align: center;
    border-bottom: 3px double #000;
    padding-bottom: 12px;
    margin-bottom: 18px;
  }
  .paper-kop h5 { margin: 0; font-size: 15px; font-weight: bold; text-transform: uppercase; }
  .paper-kop h4 { margin: 2px 0; font-size: 17px; font-weight: bold; text-transform: uppercase; }
  .paper-kop p { margin: 0; font-size: 11px; font-family: sans-serif; color: #444; }
  .paper-sign-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 36px;
    text-align: center;
    font-family: sans-serif;
    font-size: 12px;
  }
  .paper-ttd-box { height: 60px; }
  @media print {
    aside, header, .noprint { display: none !important; }
    .main { margin: 0 !important; padding: 0 !important; }
    .paper-doc { box-shadow: none; border-radius: 0; padding: 0; }
  }
</style>
@endpush

@section('content')
  <div class="ph noprint">
    <div>
      <div class="bc">BERANDA &gt; <b>LAPORAN &amp; AUDIT EKSEKUTIF</b></div>
      <h1>Laporan Inventaris &amp; Pengaduan Sarpras</h1>
      <p>Rekapitulasi pengaduan kerusakan, penggantian barang, dan lembar berita acara audit inventaris fisik sekolah.</p>
    </div>
    <div class="d-flex gap-2">
      <a class="b-action outline" href="javascript:window.print()"><span class="material-symbols-outlined fs-6">print</span> Cetak Lembar Pengesahan</a>
      <a class="b-action primary" href="{{ route('kepsek.inventaris') }}"><span class="material-symbols-outlined fs-6">inventory_2</span> Lihat Inventaris</a>
    </div>
  </div>

  @php
    $totalLap = \App\Models\Laporan::count();
    $lapMenunggu = \App\Models\Laporan::where('status', 'Menunggu Verifikasi')->count();
    $lapProses = \App\Models\Laporan::where('status', 'Sedang Diproses')->count();
    $lapSelesai = \App\Models\Laporan::where('status', 'Selesai')->count();
  @endphp

  <!-- 4 Stat Counters (Noprint) -->
  <div class="row g-3 mb-3 noprint">
    <div class="col-6 col-md-3">
      <div class="card-box p-3">
        <small class="text-muted fw-bold d-block" style="font-size: 10px;">TOTAL LAPORAN MASUK</small>
        <div class="fs-4 fw-bold text-navy my-1">{{ $totalLap }}</div>
        <small class="text-muted" style="font-size: 11px;">Dari Seluruh PJ Ruangan</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card-box p-3">
        <small class="text-muted fw-bold d-block" style="font-size: 10px;">MENUNGGU VERIFIKASI</small>
        <div class="fs-4 fw-bold text-warning my-1">{{ $lapMenunggu }}</div>
        <small class="text-muted" style="font-size: 11px;">Perlu Tindak Lanjut Admin</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card-box p-3">
        <small class="text-muted fw-bold d-block" style="font-size: 10px;">SEDANG DIPROSES</small>
        <div class="fs-4 fw-bold text-primary my-1">{{ $lapProses }}</div>
        <small class="text-muted" style="font-size: 11px;">Tindakan Teknis Sarpras</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card-box p-3">
        <small class="text-muted fw-bold d-block" style="font-size: 10px;">LAPORAN SELESAI</small>
        <div class="fs-4 fw-bold text-success my-1">{{ $lapSelesai }}</div>
        <small class="text-muted" style="font-size: 11px;">Perbaikan / Penggantian Tuntas</small>
      </div>
    </div>
  </div>

  <!-- Filter Form (Noprint) -->
  <form method="GET" action="{{ route('kepsek.laporan') }}" class="card-box filters-row noprint">
    <span class="fw-bold small text-dark"><span class="material-symbols-outlined fs-6 align-middle">filter_list</span> Filter Laporan:</span>
    <select name="status">
      <option value="">Semua Status</option>
      <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
      <option value="Sedang Diproses" {{ request('status') == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
      <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
      <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    <select name="jenis">
      <option value="">Semua Jenis Pengajuan</option>
      <option value="Barang Rusak" {{ request('jenis') == 'Barang Rusak' ? 'selected' : '' }}>Barang Rusak</option>
      <option value="Ganti Barang Rusak" {{ request('jenis') == 'Ganti Barang Rusak' ? 'selected' : '' }}>Ganti Barang Rusak</option>
      <option value="Kebutuhan Barang Baru" {{ request('jenis') == 'Kebutuhan Barang Baru' ? 'selected' : '' }}>Kebutuhan Barang Baru</option>
      <option value="Barang Hilang" {{ request('jenis') == 'Barang Hilang' ? 'selected' : '' }}>Barang Hilang</option>
    </select>
    <button type="submit" class="b-action primary">Terapkan Filter</button>
    <a href="{{ route('kepsek.laporan') }}" class="b-action outline">Reset</a>
  </form>

  <!-- Laporan Table Card (Noprint) -->
  <div class="card-box overflow-hidden mb-4 noprint">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white">
      <h6 class="fw-bold mb-0 text-dark heading-serif">Daftar Pengaduan Sarpras Masuk</h6>
      <span class="badge" style="background:#e0edff;color:#0a58ca;font-size:11px;">Total {{ $laporans->total() }} Data</span>
    </div>
    <div class="table-responsive">
      <table class="tb-laporan">
        <thead>
          <tr>
            <th style="width: 130px;">KODE & TANGGAL</th>
            <th>PELAPOR / RUANGAN</th>
            <th>JENIS PENGAJUAN</th>
            <th>NAMA BARANG & DESKRIPSI</th>
            <th>URGENSI</th>
            <th>STATUS</th>
            <th>RESPON SARPRAS</th>
          </tr>
        </thead>
        <tbody>
          @forelse($laporans as $lp)
          <tr>
            <td>
              <div class="fw-bold font-monospace" style="color:var(--navy)">{{ $lp->kode_laporan }}</div>
              <small class="text-muted">{{ $lp->created_at ? $lp->created_at->format('d/m/Y') : '-' }}</small>
            </td>
            <td>
              <div class="fw-semibold text-dark">{{ $lp->pelapor->name ?? 'PJ Ruangan' }}</div>
              <small class="text-muted">{{ $lp->ruangan->nama ?? '-' }}</small>
            </td>
            <td><span class="badge" style="background:#f1f3fa;color:#475569;font-size:10.5px">{{ $lp->jenis }}</span></td>
            <td>
              <div class="fw-semibold text-dark">{{ $lp->nama_barang }}</div>
              <small class="text-muted">{{ Str::limit($lp->deskripsi, 65) }}</small>
            </td>
            <td>
              @if($lp->urgensi == 'Darurat')
                <span class="badge bg-danger">Darurat</span>
              @elseif($lp->urgensi == 'Penting')
                <span class="badge bg-warning text-dark">Penting</span>
              @else
                <span class="badge bg-secondary">Biasa</span>
              @endif
            </td>
            <td>
              <span class="badge {{ $lp->status_badge_class }}">● {{ $lp->status }}</span>
            </td>
            <td>
              <small class="text-muted">{{ $lp->respon_admin ? Str::limit($lp->respon_admin, 50) : 'Belum ada tanggapan' }}</small>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">Belum ada pengaduan laporan sarpras.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    {{ $laporans->links() }}
  </div>

  <!-- Official Paper Document for Print / Audit -->
  <div class="paper-doc">
    <div class="paper-kop text-center" style="border-bottom: 2px solid #000; padding-bottom: 12px; margin-bottom: 18px;">
      <h5 style="font-size: 14px; font-weight: bold; letter-spacing: 0.05em; margin: 0; text-transform: uppercase;">Sistem Inventarisasi Sarana &amp; Prasarana</h5>
      <h4 style="font-size: 18px; font-weight: 900; letter-spacing: 0.04em; color: #001f54; margin: 4px 0;">LAPORAN HASIL AUDIT ASET INVENTARIS SEKOLAH</h4>
      <p style="font-size: 11px; color: #475569; margin: 0;">Dokumen Verifikasi dan Resume Kelayakan Operasional Sarana Prasarana Satuan Pendidikan</p>
    </div>

    <div style="text-align: center; margin: 18px 0;">
      <h5 style="text-decoration: underline; font-weight: bold; margin-bottom: 2px;">BERITA ACARA AUDIT SARANA DAN PRASARANA SEKOLAH</h5>
      <small style="font-family: sans-serif; color: #555;">Nomor: 028/INV/AUDIT/{{ date('Y') }}</small>
    </div>

    <p style="font-size: 13px; line-height: 1.6; text-align: justify;">
      Pada hari ini <b>{{ \Carbon\Carbon::now()->translatedFormat('l') }}</b> tanggal <b>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</b>, telah dilaksanakan verifikasi dan audit fisik aset sarana prasarana satuan pendidikan. Berdasarkan rekaman sistem inventaris terintegrasi, dilaporkan resume aset sebagai berikut:
    </p>

    @php
      $totalAset = \App\Models\Barang::sum('jumlah');
      $baik = \App\Models\Barang::where('kondisi', 'Baik')->sum('jumlah');
      $ringan = \App\Models\Barang::where('kondisi', 'Rusak Ringan')->sum('jumlah');
      $berat = \App\Models\Barang::whereIn('kondisi', ['Rusak Berat', 'Afkir'])->sum('jumlah');
      $nilaiAset = (float) \App\Models\Barang::selectRaw('SUM(jumlah * nilai_perolehan) as total')->value('total') ?? 0;
    @endphp

    <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 11px; margin: 16px 0;" border="1" cellpadding="6">
      <thead style="background: #f1f3fa;">
        <tr>
          <th style="text-align: center; width: 40px;">No</th>
          <th>Parameter Audit</th>
          <th style="text-align: center; width: 140px;">Hasil Rekapitulasi</th>
          <th>Keterangan Operasional</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align: center;">1</td>
          <td><b>Total Volume Aset Terdaftar</b></td>
          <td style="text-align: center; font-weight: bold;">{{ number_format($totalAset) }} Unit</td>
          <td>Tercatat dalam Buku Induk Inventaris Sekolah</td>
        </tr>
        <tr>
          <td style="text-align: center;">2</td>
          <td><b>Aset Kondisi Baik (Siap Pakai KBM)</b></td>
          <td style="text-align: center; font-weight: bold; color: green;">{{ number_format($baik) }} Unit</td>
          <td>Tingkat Kelaikan: {{ $totalAset > 0 ? round(($baik / $totalAset) * 100, 1) : 100 }}% Layak Praktik</td>
        </tr>
        <tr>
          <td style="text-align: center;">3</td>
          <td><b>Aset Perlu Pemeliharaan (Rusak Ringan)</b></td>
          <td style="text-align: center; font-weight: bold; color: #b45309;">{{ number_format($ringan) }} Unit</td>
          <td>Dalam penanganan tim teknisi sarpras sekolah</td>
        </tr>
        <tr>
          <td style="text-align: center;">4</td>
          <td><b>Aset Rusak Berat / Rencana Hapus</b></td>
          <td style="text-align: center; font-weight: bold; color: red;">{{ number_format($berat) }} Unit</td>
          <td>Diusulkan masuk Berita Acara Penghapusan BMN</td>
        </tr>
        <tr>
          <td style="text-align: center;">5</td>
          <td><b>Valuasi Nilai Perolehan Aset</b></td>
          <td style="text-align: center; font-weight: bold;">Rp {{ number_format($nilaiAset, 0, ',', '.') }}</td>
          <td>Akumulasi perolehan APBD / BOS / BPOPP</td>
        </tr>
      </tbody>
    </table>

    <div class="paper-sign-grid">
      <div>
        Mengetahui &amp; Memverifikasi,<br>
        <b>Admin Sarana Prasarana</b>
        <div class="paper-ttd-box"></div>
        <u><b>Admin</b></u><br>
        <span class="text-muted" style="font-size: 11px;">Administrator Sarpras</span>
      </div>
      <div>
        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
        <b>Kepala Sekolah</b>
        <div class="paper-ttd-box"></div>
        <u><b>Kepala Sekolah</b></u><br>
        <span class="text-muted" style="font-size: 11px;">Kepala Sekolah</span>
      </div>
    </div>
  </div>
@endsection
