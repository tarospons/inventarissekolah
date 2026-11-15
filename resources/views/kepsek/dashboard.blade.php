@extends('layouts.kepsek')

@section('title', 'Dashboard Kepala Sekolah')

@push('styles')
<style>
  :root {
    --navy: #00236b;
    --blue: #1e3a8a;
    --teal: #0369a1;
    --sky: #5fb4ff;
    --red: #ba1a1a;
    --bg: #f9f9ff;
    --soft: #f1f2fd;
    --line: #ebecfa;
    --mut: #444654;
  }
  .hero {
    border-radius: 12px;
    padding: 24px;
    color: #fff;
    background: linear-gradient(110deg,#1e3a8a,#0369a1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
  }
  .chips {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
  }
  .chips span {
    background: rgba(255,255,255,.18);
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: 600;
  }
  .hero h1 {
    font-size: 22px;
    font-weight: 700;
    margin: 10px 0 4px;
  }
  .hero p {
    font-size: 12px;
    color: #dbe4ff;
    max-width: 440px;
    line-height: 1.5;
    margin-bottom: 0;
  }
  .act {
    display: grid;
    gap: 8px;
    min-width: 170px;
  }
  .b {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    height: 34px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
  }
  .b.w { background: #fff; color: var(--navy); }
  .b.g { background: rgba(255,255,255,.2); color: #fff; }
  .card-box {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,35,107,.07);
  }
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
    margin-bottom: 16px;
  }
  .stat-card {
    padding: 14px;
    min-height: 110px;
    display: flex;
    flex-direction: column;
  }
  .stat-card .t {
    display: flex;
    justify-content: space-between;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: .04em;
    color: var(--mut);
  }
  .stat-card .ic {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    display: grid;
    place-items: center;
    flex: none;
  }
  .stat-card .n {
    font-size: 22px;
    font-weight: 700;
    color: var(--navy);
    margin: 2px 0 auto;
  }
  .stat-card .f {
    display: flex;
    justify-content: space-between;
    font-size: 10px;
    color: var(--mut);
  }
  .stat-card .f b { color: var(--teal); }
  .two-col {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 16px;
    margin-bottom: 16px;
  }
  .panel-box { padding: 18px; }
  .panel-box h2 {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    font-size: 16px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 6px;
  }
  .panel-box h2 span.p {
    background: var(--soft);
    color: var(--mut);
    font-size: 9px;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 700;
  }
  .panel-box > p {
    font-size: 11px;
    color: var(--mut);
    margin-bottom: 16px;
    line-height: 1.45;
  }
  .dn-wrap {
    display: flex;
    gap: 16px;
    align-items: center;
  }
  .chart-container-donut {
    width: 120px;
    height: 120px;
    position: relative;
    flex: none;
  }
  .lg2 {
    flex: 1;
    display: grid;
    gap: 8px;
  }
  .it {
    background: var(--soft);
    border-radius: 6px;
    padding: 8px 10px;
    font-size: 10px;
    color: var(--mut);
    border-left: 3px solid;
  }
  .it .h {
    display: flex;
    justify-content: space-between;
    color: #1a1c2c;
    font-weight: 600;
  }
  .it .h b { color: var(--navy); }
  .it .h2 {
    display: flex;
    justify-content: space-between;
    margin-top: 3px;
  }
  .note-audit {
    display: flex;
    gap: 8px;
    background: var(--soft);
    border-radius: 8px;
    padding: 10px;
    font-size: 11px;
    margin-top: 14px;
    line-height: 1.45;
  }
  .note-audit .material-symbols-outlined { color: var(--teal); flex: none; }
  .kat-list { display: grid; gap: 12px; }
  .kat-list .h {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    margin-bottom: 4px;
    font-size: 11.5px;
  }
  .kat-list .bar {
    height: 6px;
    background: var(--line);
    border-radius: 6px;
    overflow: hidden;
  }
  .kat-list .bar b { display: block; height: 100%; border-radius: 6px; }
  table.tb-kepsek { width: 100%; border-collapse: collapse; }
  table.tb-kepsek th {
    background: var(--soft);
    font-size: 9.5px;
    letter-spacing: .05em;
    text-align: left;
    padding: 10px 12px;
    color: var(--mut);
  }
  table.tb-kepsek td {
    padding: 10px 12px;
    font-size: 11px;
    border-top: 1px solid var(--line);
    vertical-align: middle;
  }
  .badge-cond-baik { background: #dbeeff; color: #0284c7; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
  .badge-cond-ringan { background: #fef3c7; color: #b45309; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
  .badge-cond-berat { background: #fee2e2; color: #dc2626; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
  @media(max-width:1100px) {
    .stats-grid { grid-template-columns: repeat(3, 1fr); }
    .two-col { grid-template-columns: 1fr; }
  }
  @media(max-width:700px) {
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .hero { flex-direction: column; align-items: flex-start; }
    .dn-wrap { flex-direction: column; }
  }
</style>
@endpush

@section('content')
  <!-- Hero Section -->
  <section class="hero">
    <div>
      <div class="chips">
        <span>● {{ strtoupper(\Carbon\Carbon::now()->translatedFormat('l, d F Y')) }}</span>
        <span>Semester Genap TA 2024/2025</span>
        <span>✓ Mode Eksekutif</span>
      </div>
      <h1>Selamat Datang, Kepala Sekolah!</h1>
      <p>Monitoring Eksekutif &amp; Pengawasan Terpadu Sarana dan Prasarana Sekolah</p>
    </div>
    <div class="act">
      <a class="b w" href="javascript:window.print()"><span class="material-symbols-outlined fs-6">print</span>Cetak Ringkasan Eksekutif</a>
      <a class="b g" href="{{ route('kepsek.laporan') }}"><span class="material-symbols-outlined fs-6">assignment</span>Buka Lembar Laporan</a>
    </div>
  </section>

  <!-- 5 Stat Cards -->
  <section class="stats-grid">
    <div class="card-box stat-card">
      <div class="t"><span>TOTAL SELURUH<br>BARANG</span><span class="ic" style="background:var(--soft);color:var(--blue)"><span class="material-symbols-outlined fs-5">inventory_2</span></span></div>
      <div class="n">{{ number_format($totalUnit, 0, ',', '.') }}</div>
      <div class="f"><b>✓ 100% Tercatat</b><span>Unit Fisik</span></div>
    </div>
    <div class="card-box stat-card">
      <div class="t"><span>KONDISI BAIK</span><span class="ic" style="background:#dbeeff;color:var(--teal)"><span class="material-symbols-outlined fs-5">thumb_up</span></span></div>
      <div class="n">{{ number_format($baikUnit, 0, ',', '.') }}</div>
      <div class="f"><b>{{ $rasioKelaikan }}% Siap Pakai</b><span>Layak KBM</span></div>
    </div>
    <div class="card-box stat-card">
      <div class="t"><span>PERLU<br>PERBAIKAN</span><span class="ic" style="background:#cfe0ff;color:var(--navy)"><span class="material-symbols-outlined fs-5">build_circle</span></span></div>
      <div class="n">{{ number_format($rusakRinganUnit, 0, ',', '.') }}</div>
      <div class="f"><b>{{ $totalUnit > 0 ? round(($rusakRinganUnit / $totalUnit)*100, 1) : 0 }}% Pemeliharaan</b><span>Rusak Ringan</span></div>
    </div>
    <div class="card-box stat-card">
      <div class="t"><span>BARANG RUSAK</span><span class="ic" style="background:#ffdad6;color:var(--red)"><span class="material-symbols-outlined fs-5">cancel</span></span></div>
      <div class="n" style="color:var(--red)">{{ number_format($rusakBeratUnit + $afkirUnit, 0, ',', '.') }}</div>
      <div class="f"><b style="color:var(--red)">{{ $totalUnit > 0 ? round((($rusakBeratUnit + $afkirUnit) / $totalUnit)*100, 1) : 0 }}% Usulan Hapus</b><span>Rusak Berat/Afkir</span></div>
    </div>
    <div class="card-box stat-card">
      <div class="t"><span>RUANGAN AKTIF</span><span class="ic" style="background:#dbeeff;color:var(--teal)"><span class="material-symbols-outlined fs-5">apartment</span></span></div>
      <div class="n">{{ $totalRuangan }}</div>
      <div class="f"><b style="color:var(--navy)">{{ $ruanganTerisi }} Terisi Aset</b><span>Terpantau</span></div>
    </div>
  </section>

  <!-- Two Columns: Donut Chart & Category Composition -->
  <section class="two-col">
    <!-- Donut Condition Chart -->
    <div class="card-box panel-box">
      <h2>Distribusi Berdasarkan Kondisi <span class="p">Audit Live</span></h2>
      <p>Kondisi operasional sarana & prasarana untuk menjamin efektivitas kegiatan belajar mengajar.</p>
      <div class="dn-wrap">
        <div class="chart-container-donut">
          <canvas id="kepsekDonutChart"></canvas>
          <div class="position-absolute top-50 start-50 translate-middle text-center" style="pointer-events: none;">
            <b class="d-block" style="font-size: 15px; color: var(--navy); line-height: 1;">{{ $totalUnit }}</b>
            <span style="font-size: 8px; color: var(--mut);">Unit Valid</span>
          </div>
        </div>
        <div class="lg2">
          @php
            $pctBaik = $totalUnit > 0 ? round(($baikUnit / $totalUnit) * 100, 1) : 0;
            $pctRingan = $totalUnit > 0 ? round(($rusakRinganUnit / $totalUnit) * 100, 1) : 0;
            $pctBerat = $totalUnit > 0 ? round((($rusakBeratUnit + $afkirUnit) / $totalUnit) * 100, 1) : 0;
          @endphp
          <div class="it" style="border-color:var(--teal)">
            <div class="h"><span>Kondisi Baik</span><b>{{ number_format($baikUnit) }} Unit</b></div>
            <div class="h2"><span>Layak Pakai Penuh</span><span>{{ $pctBaik }}%</span></div>
          </div>
          <div class="it" style="border-color:var(--sky)">
            <div class="h"><span>Rusak Ringan</span><b>{{ number_format($rusakRinganUnit) }} Unit</b></div>
            <div class="h2"><span>Perlu Servis</span><span>{{ $pctRingan }}%</span></div>
          </div>
          <div class="it" style="border-color:var(--red)">
            <div class="h"><span>Rusak Berat & Afkir</span><b style="color:var(--red)">{{ number_format($rusakBeratUnit + $afkirUnit) }} Unit</b></div>
            <div class="h2"><span>Usul Lelang/Hapus</span><span>{{ $pctBerat }}%</span></div>
          </div>
        </div>
      </div>
      <div class="note-audit">
        <span class="material-symbols-outlined">fact_check</span>
        <span><b>Telaah Eksekutif:</b> Rasio kelaikan aset saat ini mencapai <b>{{ $rasioKelaikan }}%</b>. Total nilai perolehan seluruh aset tercatat Rp {{ number_format($totalAsetRupiah, 0, ',', '.') }}.</span>
      </div>
    </div>

    <!-- Category Composition -->
    <div class="card-box panel-box">
      <h2>Komposisi Barang Berdasarkan Kategori <span class="p">{{ $kategoriStats->count() }} Teratas</span></h2>
      <p>Proporsi volume inventaris penunjang operasional program keahlian dan administrasi sekolah.</p>
      <div class="kat-list">
        @forelse($kategoriStats as $kat)
          @php
            $katPct = $totalUnit > 0 ? round(($kat->total_unit / $totalUnit) * 100, 1) : 0;
          @endphp
          <div>
            <div class="h">
              <span><span class="material-symbols-outlined fs-6 align-middle text-primary me-1">{{ $kat->icon ?? 'inventory' }}</span>{{ $kat->nama }}</span>
              <span>{{ $kat->total_unit }} Unit ({{ $katPct }}%)</span>
            </div>
            <div class="bar">
              <b style="width: {{ $katPct }}%; background: var(--teal)"></b>
            </div>
          </div>
        @empty
          <div class="text-muted small">Belum ada kategori terisi.</div>
        @endforelse
      </div>
      <div class="d-flex justify-content-between mt-3 text-muted small" style="font-size: 11px;">
        <span>Total Kategori: <b class="text-dark">{{ $kategoriStats->count() }} Kategori</b></span>
        <span>Total Aset Terdaftar: <b class="text-dark">{{ number_format($totalUnit) }} Unit</b></span>
      </div>
    </div>
  </section>

  <!-- Log Pembaruan Terkini (Read-Only) -->
  <section class="card-box panel-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h2 class="mb-0">Log Pembaruan Aset Terkini <span class="p" style="background:#dbeeff;color:var(--teal);margin-left:8px">MODE PANTAU (READ-ONLY)</span></h2>
        <small class="text-muted" style="font-size: 11px;">Entri fisik inventaris sarpras sekolah</small>
      </div>
      <a href="{{ route('kepsek.inventaris') }}" class="small fw-bold text-decoration-none" style="color: var(--navy)">Lihat Seluruh Data Inventaris →</a>
    </div>
    <div class="table-responsive">
      <table class="tb-kepsek">
        <thead>
          <tr>
            <th style="width: 50px;">NO.</th>
            <th>NAMA BARANG</th>
            <th>KATEGORI</th>
            <th style="text-align:center; width: 110px;">JUMLAH</th>
            <th style="width: 120px;">KONDISI</th>
            <th>LOKASI RUANGAN</th>
          </tr>
        </thead>
        <tbody>
          @forelse($barangTerbaru as $idx => $b)
          <tr>
            <td class="font-monospace text-muted">{{ sprintf('%02d', $idx + 1) }}</td>
            <td>
              <div class="fw-semibold text-dark">{{ $b->nama }}</div>
              <small class="text-muted" style="font-size: 10.5px;">Tahun Pengadaan: {{ $b->tahun_pengadaan ?? '-' }}</small>
            </td>
            <td class="text-muted small">{{ $b->kategori->nama ?? '-' }}</td>
            <td style="text-align:center" class="font-monospace fw-bold">{{ $b->jumlah }} {{ $b->satuan }}</td>
            <td>
              @if($b->kondisi == 'Baik')
                <span class="badge-cond-baik">● Baik</span>
              @elseif($b->kondisi == 'Rusak Ringan')
                <span class="badge-cond-ringan">● Rusak Ringan</span>
              @else
                <span class="badge-cond-berat">● {{ $b->kondisi }}</span>
              @endif
            </td>
            <td>
              <div class="d-flex align-items-center gap-1 text-dark">
                <span class="material-symbols-outlined fs-6 text-primary">meeting_room</span>
                <span>{{ $b->ruangan->nama ?? '-' }}</span>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-3 text-muted">Belum ada data barang.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center p-2 px-3 mt-2 rounded-2" style="background: var(--soft); font-size: 11px; color: var(--mut);">
      <span><span class="material-symbols-outlined fs-6 align-middle text-primary">verified_user</span> <b>Catatan Kewenangan:</b> Kepala Sekolah memiliki wewenang pengawasan menyeluruh terhadap seluruh <b>{{ number_format($totalUnit) }} unit aset</b> di sekolah.</span>
      <a href="{{ route('kepsek.inventaris') }}" class="fw-bold text-decoration-none" style="color: var(--teal)">Buka Data Lengkap →</a>
    </div>
  </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('kepsekDonutChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Kondisi Baik', 'Rusak Ringan', 'Rusak Berat & Afkir'],
          datasets: [{
            data: [
              {{ (int) $baikUnit }},
              {{ (int) $rusakRinganUnit }},
              {{ (int) ($rusakBeratUnit + $afkirUnit) }}
            ],
            backgroundColor: ['#0369a1', '#5fb4ff', '#ba1a1a'],
            borderWidth: 2,
            borderColor: '#ffffff',
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '72%',
          plugins: {
            legend: { display: false },
            tooltip: {
              callbacks: {
                label: function(context) {
                  const val = context.raw || 0;
                  const total = {{ max(1, (int)$totalUnit) }};
                  const pct = ((val / total) * 100).toFixed(1);
                  return ' ' + context.label + ': ' + val + ' unit (' + pct + '%)';
                }
              }
            }
          }
        }
      });
    }
  });
</script>
@endpush
