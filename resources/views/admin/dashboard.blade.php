@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Hero Welcome Banner -->
<div class="card-slicing p-3 px-4 text-white border-0" style="background: linear-gradient(130deg, #0b2f7a 0%, #034898 50%, #0260b0 100%);">
  <div class="row align-items-center g-3">
    <div class="col-12 col-lg-8">
      <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(255, 255, 255, 0.15); font-size: 11px; font-weight: 600;">
        <span class="material-symbols-outlined fs-6">calendar_today</span>
        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} | Inventaris Sekolah</span>
      </div>
      <h3 class="fw-bold mb-1 heading-serif text-white" style="font-size: 23px;">Selamat Datang, Admin!</h3>
      <p class="mb-0 opacity-75 small" style="max-width: 600px; font-size: 12.5px; line-height: 1.45;">
        Kelola dan pantau seluruh aset inventaris sarana dan prasarana sekolah secara terintegrasi, transparan, dan akurat.
      </p>
    </div>
    <div class="col-12 col-lg-4 text-lg-end">
      <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-lg-end">
        <a class="btn btn-light fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm rounded-3 py-2 px-3" href="{{ route('admin.barang.create') }}" style="color: #002366; font-size: 12.5px;">
          <span class="material-symbols-outlined fs-5">add_circle</span> Tambah Barang Baru
        </a>
        <a class="btn fw-semibold d-inline-flex align-items-center justify-content-center gap-2 rounded-3 py-2 px-3 text-white" href="{{ route('admin.laporan') }}" style="background: rgba(255, 255, 255, 0.18); font-size: 12.5px;">
          <span class="material-symbols-outlined fs-5">inbox</span> Laporan Masuk 
          @if($laporanBelumVerifikasi > 0)
            <span class="badge bg-danger ms-1">{{ $laporanBelumVerifikasi }}</span>
          @endif
        </a>
      </div>
    </div>
  </div>
</div>

<!-- 4 Stat Cards in Grid -->
<div class="row g-3">
  <!-- Card 1: Total Barang -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL UNIT BARANG</div>
          <div class="stat-box-num">{{ number_format($totalBarang, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #0a58ca;">
          <span class="material-symbols-outlined fs-4">inventory_2</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span class="d-flex align-items-center gap-1">
          <span class="material-symbols-outlined fs-6 text-primary">layers</span>
          Dari <b>{{ $totalAsetJenis }} jenis aset</b> terdaftar
        </span>
      </div>
    </div>
  </div>

  <!-- Card 2: Kondisi Baik -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">BARANG KONDISI BAIK</div>
          <div class="stat-box-num">{{ number_format($barangBaikCount, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #002060; color: #ffffff;">
          <span class="material-symbols-outlined fs-4">check_circle</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Rasio Kelayakan</span>
        <b style="color: #002060;">{{ $rasioKelayakan }}% Operasional</b>
      </div>
    </div>
  </div>

  <!-- Card 3: Barang Rusak -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">BARANG PERLU PERBAIKAN</div>
          <div class="stat-box-num" style="color: #1a1c2c;">{{ number_format($barangRusakCount, 0, ',', '.') }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #ffebee; color: #d32f2f;">
          <span class="material-symbols-outlined fs-4">warning</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span><b>{{ $rusakRinganCount }}</b> Ringan</span>
        <b class="text-danger">{{ $rusakBeratCount }} Rusak Berat</b>
      </div>
    </div>
  </div>

  <!-- Card 4: Total Kategori & Ruangan -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">KATEGORI & RUANGAN</div>
          <div class="stat-box-num">{{ $totalKategori }} <small>Kategori</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #0284c7;">
          <span class="material-symbols-outlined fs-4">folder_special</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span class="d-flex align-items-center gap-1">
          <span class="material-symbols-outlined fs-6 text-primary">apartment</span>
          Tersebar di <b>{{ $totalRuangan }} Ruangan</b>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Main Row: Table & Side Widgets -->
<div class="row g-3">
  <!-- Left: Recent Items Table (col-lg-8) -->
  <div class="col-12 col-lg-8">
    <div class="card-slicing overflow-hidden h-100 d-flex flex-column">
      <!-- Card Header -->
      <div class="p-3 px-4 d-flex justify-content-between align-items-center border-bottom bg-white">
        <div class="d-flex align-items-center gap-3">
          <div class="stat-icon-sq" style="width: 36px; height: 36px; background: #002366; color: #ffffff; border-radius: 8px;">
            <span class="material-symbols-outlined fs-5">grid_view</span>
          </div>
          <div>
            <h6 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 14px;">Barang Terbaru Ditambahkan</h6>
            <small class="text-muted" style="font-size: 11px;">Entri log inventaris terkini sarana prasarana sekolah</small>
          </div>
        </div>
        <span class="badge" style="background: #e0edff; color: #0a58ca; font-size: 11px; font-weight: 700; border-radius: 6px; padding: 5px 10px;">
          {{ $barangTerbaru->count() }} Terbaru
        </span>
      </div>

      <!-- Table Body -->
      <div class="table-responsive flex-grow-1">
        <table class="table-slicing">
          <thead>
            <tr>
              <th class="ps-4" style="width: 45px;">NO.</th>
              <th>NAMA BARANG</th>
              <th>KATEGORI</th>
              <th style="width: 110px;">KONDISI</th>
              <th>LOKASI RUANGAN</th>
              <th class="pe-4" style="width: 110px;">TANGGAL</th>
            </tr>
          </thead>
          <tbody>
            @forelse($barangTerbaru as $b)
            <tr>
              <td class="ps-4 text-muted fw-semibold">{{ $loop->iteration }}</td>
              <td>
                <div class="fw-semibold text-dark">{{ $b->nama }}</div>
                <small class="text-muted">{{ $b->jumlah }} {{ $b->satuan }}</small>
              </td>
              <td><span class="badge" style="background: #f1f3fa; color: #475569; font-size: 11px;">{{ $b->kategori->nama ?? '-' }}</span></td>
              <td>
                <span class="badge-status {{ $b->kondisi_badge_class }}">● {{ $b->kondisi }}</span>
              </td>
              <td class="text-muted small">{{ $b->ruangan->nama ?? '-' }}</td>
              <td class="pe-4 text-muted small">{{ $b->created_at ? $b->created_at->format('d M Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">Belum ada data barang inventaris.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Table Footer -->
      <div class="p-3 px-4 border-top d-flex justify-content-between align-items-center bg-white">
        <span class="text-muted small">Menampilkan {{ $barangTerbaru->count() }} entri terkini</span>
        <a class="small fw-bold text-decoration-none" href="{{ route('admin.barang') }}" style="color: #0a58ca;">
          Lihat Semua Data Barang ({{ $totalAsetJenis }}) →
        </a>
      </div>
    </div>
  </div>

  <!-- Right: 2 Side Widgets (col-lg-4) -->
  <div class="col-12 col-lg-4 d-flex flex-column gap-3">
    <!-- Condition Widget with Interactive Chart -->
    <div class="card-slicing p-3 px-4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined text-primary fs-5">pie_chart</span>
          <h6 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 14px;">Rekapitulasi Kondisi</h6>
        </div>
        <span class="badge" style="background: #eef2fe; color: #475569; font-size: 10px;">Real-time</span>
      </div>

      <!-- Chart.js Canvas Container -->
      <div class="position-relative d-flex justify-content-center align-items-center my-2" style="height: 150px;">
        <canvas id="adminKondisiChart"></canvas>
        <div class="position-absolute text-center" style="pointer-events: none;">
          <div class="fw-bold font-serif fs-5" style="color: #002366; line-height: 1;">{{ $rasioKelayakan }}%</div>
          <small class="text-muted fw-bold" style="font-size: 8.5px; letter-spacing: 0.05em;">PRIMA</small>
        </div>
      </div>

      <!-- Progress Indicators -->
      @php
        $pctBaik = $totalBarang > 0 ? round(($barangBaikCount / $totalBarang) * 100, 1) : 0;
        $pctRingan = $totalBarang > 0 ? round(($rusakRinganCount / $totalBarang) * 100, 1) : 0;
        $pctBerat = $totalBarang > 0 ? round(($rusakBeratCount / $totalBarang) * 100, 1) : 0;
      @endphp
      <div class="d-flex flex-column gap-2 mt-2">
        <div>
          <div class="d-flex justify-content-between small mb-1" style="font-size: 11px;">
            <span class="d-flex align-items-center gap-1 fw-semibold text-dark">
              <span style="width: 8px; height: 8px; border-radius: 50%; background: #002366;"></span> Kondisi Baik
            </span>
            <span><b>{{ number_format($barangBaikCount) }} Unit</b> ({{ $pctBaik }}%)</span>
          </div>
          <div class="progress" style="height: 5px;">
            <div class="progress-bar" style="width: {{ $pctBaik }}%; background-color: #002366;"></div>
          </div>
        </div>

        <div>
          <div class="d-flex justify-content-between small mb-1" style="font-size: 11px;">
            <span class="d-flex align-items-center gap-1 fw-semibold text-dark">
              <span style="width: 8px; height: 8px; border-radius: 50%; background: #0284c7;"></span> Rusak Ringan
            </span>
            <span><b>{{ number_format($rusakRinganCount) }} Unit</b> ({{ $pctRingan }}%)</span>
          </div>
          <div class="progress" style="height: 5px;">
            <div class="progress-bar" style="width: {{ $pctRingan }}%; background-color: #0284c7;"></div>
          </div>
        </div>

        <div>
          <div class="d-flex justify-content-between small mb-1" style="font-size: 11px;">
            <span class="d-flex align-items-center gap-1 fw-semibold text-dark">
              <span style="width: 8px; height: 8px; border-radius: 50%; background: #dc2626;"></span> Rusak Berat
            </span>
            <span><b>{{ number_format($rusakBeratCount) }} Unit</b> ({{ $pctBerat }}%)</span>
          </div>
          <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-danger" style="width: {{ $pctBerat }}%;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Rooms Widget -->
    <div class="card-slicing p-3 px-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined text-primary fs-5">apartment</span>
          <h6 class="fw-bold mb-0 text-dark heading-serif" style="font-size: 14px;">Ruangan Terbanyak Aset</h6>
        </div>
        <a href="{{ route('admin.ruangan') }}" class="text-decoration-none">
          <span class="material-symbols-outlined text-muted fs-6">open_in_new</span>
        </a>
      </div>

      <div class="d-flex flex-column gap-2 mb-3">
        @forelse($topRuangans as $idx => $r)
        <div class="p-2 px-3 rounded-2 d-flex justify-content-between align-items-center" style="background: #f1f4fd;">
          <div class="d-flex align-items-center gap-2">
            <span class="badge text-white" style="background: {{ $idx == 0 ? '#002366' : ($idx == 1 ? '#0284c7' : '#475569') }}; font-size: 11px; padding: 4px 7px;">#{{ $idx + 1 }}</span>
            <div>
              <div class="fw-bold text-dark" style="font-size: 12px;">{{ $r->nama }}</div>
              <small class="text-muted" style="font-size: 10px;">{{ $r->gedung }} {{ $r->lantai ? '• ' . $r->lantai : '' }}</small>
            </div>
          </div>
          <div class="text-end">
            <div class="fw-bold" style="color: #002366; font-size: 12.5px;">{{ $r->total_unit }}</div>
            <small class="text-muted" style="font-size: 10px;">Unit</small>
          </div>
        </div>
        @empty
        <div class="text-muted small py-2 text-center">Belum ada alokasi aset.</div>
        @endforelse
      </div>

      <a class="btn w-100 fw-bold py-2 text-center" href="{{ route('admin.ruangan') }}" style="background: #eef2fe; color: #002366; font-size: 12px; border-radius: 8px;">
        Lihat Semua Ruangan ({{ $totalRuangan }})
      </a>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js for Interactive Charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('adminKondisiChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Afkir'],
          datasets: [{
            data: [
              {{ (int) $barangBaikCount }},
              {{ (int) $rusakRinganCount }},
              {{ (int) $rusakBeratCount }},
              {{ (int) $afkirCount }}
            ],
            backgroundColor: ['#002366', '#0284c7', '#dc2626', '#64748b'],
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
                  const total = {{ max(1, (int)$totalBarang) }};
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
