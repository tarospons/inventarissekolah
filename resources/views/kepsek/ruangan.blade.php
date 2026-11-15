@extends('layouts.kepsek')

@section('title', 'Data Ruangan')

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
    max-width: 520px;
    line-height: 1.5;
    font-size: 12px;
    margin-bottom: 0;
  }
  .b-action {
    display: flex;
    align-items: center;
    gap: 8px;
    height: 36px;
    padding: 0 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 12px;
    text-decoration: none;
    border: 0;
    cursor: pointer;
    background: #fff;
    color: var(--navy);
    box-shadow: 0 1px 4px rgba(0,35,107,.12);
  }
  .stat-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 16px;
  }
  .room-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 16px;
  }
  .room-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,35,107,.07);
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-top: 3px solid var(--teal);
  }
  .room-icon-sq {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: var(--soft);
    color: var(--blue);
    display: grid;
    place-items: center;
    flex: none;
  }
  @media(max-width:768px) {
    .stat-grid-3 { grid-template-columns: 1fr; }
    .room-grid { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('content')
  <div class="ph">
    <div>
      <div class="bc">BERANDA &gt; <b>DATA RUANGAN</b> <span style="background:#e1e7ff;color:var(--navy);padding:2px 8px;border-radius:99px;margin-left:6px">AKREDITASI-A</span></div>
      <h1>Persebaran Inventaris per Ruangan</h1>
      <p>Monitoring jumlah unit aset, tingkat kelaikan fisik, serta penanggung jawab di setiap ruangan sekolah secara real-time.</p>
    </div>
    <div>
      <a class="b-action" href="javascript:window.print()"><span class="material-symbols-outlined fs-6">print</span> Cetak Rekap Ruangan</a>
    </div>
  </div>

  @php
    $totalRuang = $ruangans->count();
    $ruangTerisi = $ruangans->filter(fn($r) => $r->barangs->sum('jumlah') > 0)->count();
    $utilisasiPct = $totalRuang > 0 ? round(($ruangTerisi / $totalRuang) * 100, 1) : 0;
    $topRoom = $ruangans->sortByDesc(fn($r) => $r->barangs->sum('jumlah'))->first();
  @endphp

  <!-- 3 Summary Cards -->
  <div class="stat-grid-3">
    <div class="card-box p-3">
      <small style="font-size:10px;font-weight:700;letter-spacing:.04em;color:var(--mut)">TOTAL FASILITAS</small>
      <div style="font-size:28px;font-weight:700;color:var(--navy);margin:4px 0 2px">{{ $totalRuang }}</div>
      <b>Ruangan Terdata</b>
      <div style="font-size:11px;color:var(--mut);margin-top:10px"><span class="material-symbols-outlined fs-6 align-middle text-success">check_circle</span> <b>100%</b> terpantau dalam sistem</div>
    </div>
    <div class="card-box p-3">
      <small style="font-size:10px;font-weight:700;letter-spacing:.04em;color:var(--mut)">TINGKAT UTILISASI</small>
      <div style="font-size:28px;font-weight:700;color:var(--navy);margin:4px 0 2px">{{ $ruangTerisi }} <small style="font-size:12px;font-weight:400">/ {{ $totalRuang }} Ruang</small></div>
      <b>Ruangan Terisi Aset</b>
      <div style="font-size:11px;color:var(--mut);margin-top:10px">
        <div class="d-flex align-items-center gap-2">
          <div class="progress flex-grow-1" style="height: 6px;">
            <div class="progress-bar" style="width: {{ $utilisasiPct }}%; background-color: var(--teal);"></div>
          </div>
          <span class="font-monospace fw-bold">{{ $utilisasiPct }}%</span>
        </div>
      </div>
    </div>
    <div class="card-box p-3">
      <small style="font-size:10px;font-weight:700;letter-spacing:.04em;color:var(--mut)">ASET TERBANYAK</small>
      <div style="font-size:28px;font-weight:700;color:var(--navy);margin:4px 0 2px">{{ $topRoom ? $topRoom->barangs->sum('jumlah') : 0 }} <small style="font-size:12px;font-weight:400">Unit</small></div>
      <b style="color:var(--navy)">{{ $topRoom ? $topRoom->nama : '-' }}</b>
      <div style="font-size:11px;color:var(--mut);margin-top:10px">{{ $topRoom ? $topRoom->gedung : '' }}</div>
    </div>
  </div>

  <!-- Rooms Cards Grid -->
  <div class="room-grid">
    @forelse($ruangans as $r)
      @php
        $totalUnit = (int) $r->barangs->sum('jumlah');
        $baikUnit = (int) $r->barangs->where('kondisi', 'Baik')->sum('jumlah');
        $rusakUnit = $totalUnit - $baikUnit;
        $pctBaik = $totalUnit > 0 ? round(($baikUnit / $totalUnit) * 100, 1) : 100.0;
      @endphp
      <div class="room-card">
        <div>
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="d-flex align-items-center gap-2">
              <div class="room-icon-sq">
                <span class="material-symbols-outlined fs-5">{{ $r->icon ?? 'meeting_room' }}</span>
              </div>
              <div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 13.5px;">{{ $r->nama }}</h6>
                <small class="text-muted" style="font-size: 10.5px;">{{ $r->gedung }} {{ $r->lantai ? '(' . $r->lantai . ')' : '' }}</small>
              </div>
            </div>
            <span class="badge" style="background: #eef2fe; color: #0284c7; font-size: 10px;">
              {{ $totalUnit }} Unit
            </span>
          </div>

          <p class="text-muted small mb-2" style="font-size: 11.5px; line-height: 1.4;">
            {{ $r->sub ?? ($r->lantai ? 'Lokasi: ' . $r->lantai : 'Ruangan operasional aktif sekolah') }}
          </p>

          <!-- PJ Info -->
          <div class="p-2 rounded-2 mb-3" style="background: var(--soft); font-size: 11px;">
            <div class="d-flex align-items-center gap-2">
              <span class="material-symbols-outlined fs-6 text-primary">person</span>
              <div>
                <div class="fw-bold text-dark">{{ $r->pj?->name ?? 'Belum Ditugaskan' }}</div>
                <small class="text-muted font-monospace" style="font-size: 9.5px;">{{ $r->pj?->nip ? 'NIP. ' . $r->pj->nip : 'NIP: -' }}</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Condition Metrics -->
        <div>
          <div class="d-flex justify-content-between align-items-center small mb-1" style="font-size: 10.5px;">
            <span class="text-muted">Kondisi Fisik: <b>{{ $pctBaik }}% Baik</b></span>
            <span><b class="text-success">{{ $baikUnit }}</b> Baik / <b class="text-danger">{{ $rusakUnit }}</b> Rusak</span>
          </div>
          <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-success" style="width: {{ $pctBaik }}%;"></div>
            <div class="progress-bar bg-danger" style="width: {{ 100 - $pctBaik }}%;"></div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 card-box p-4 text-center text-muted">Belum ada data ruangan terdaftar.</div>
    @endforelse
  </div>

  <div class="mt-3 card-box overflow-hidden">
    {{ $ruangans->links() }}
  </div>
@endsection
