@extends('layouts.kepsek')

@section('title', 'Data Inventaris')

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
  .mini {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }
  .mini .stat-item {
    display: flex;
    gap: 12px;
    align-items: center;
    padding: 10px 16px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 4px rgba(0,35,107,.08);
  }
  .mini .ic {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: var(--soft);
    color: var(--blue);
    display: grid;
    place-items: center;
  }
  .mini small {
    display: block;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: .03em;
    color: var(--mut);
  }
  .mini b {
    font-size: 18px;
    color: var(--navy);
  }
  .filters {
    display: flex;
    gap: 10px;
    padding: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }
  .filters input, .filters select {
    border: 1px solid var(--line);
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 12px;
    background: #fff;
    color: #1a1c2c;
  }
  .filters input { flex: 1; min-width: 220px; }
  .filters button.btn-filter {
    background: var(--navy);
    color: #fff;
    border: 0;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 600;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .filters a.rs {
    border: 1px solid var(--line);
    background: #fff;
    color: var(--mut);
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  table.tb-inv {
    width: 100%;
    border-collapse: collapse;
  }
  table.tb-inv th {
    background: var(--soft);
    font-size: 9.5px;
    letter-spacing: .04em;
    padding: 10px 12px;
    text-align: left;
    color: var(--mut);
  }
  table.tb-inv td {
    padding: 10px 12px;
    font-size: 11.5px;
    border-top: 1px solid var(--line);
    vertical-align: middle;
  }
  .badge-baik { background: #dbeeff; color: #0284c7; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
  .badge-ringan { background: #fef3c7; color: #b45309; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
  .badge-berat { background: #fee2e2; color: #dc2626; font-weight: 700; padding: 3px 8px; border-radius: 6px; font-size: 10px; }
</style>
@endpush

@section('content')
  <!-- Executive Banner -->
  <div class="card-box mb-3" style="background:#e1e7ff;padding:12px 16px;display:flex;gap:12px;align-items:center;justify-content:space-between;">
    <div style="display:flex;gap:12px;align-items:center">
      <span class="material-symbols-outlined fs-3" style="color:var(--navy)">admin_panel_settings</span>
      <div style="font-size:11.5px;line-height:1.5">
        <b style="color:var(--navy)">HAK AKSES EKSEKUTIF KEPALA SEKOLAH (READ-ONLY)</b><br>
        Seluruh data di bawah ini merupakan data inventaris aset fisik sekolah secara live dari sistem sarpras.
      </div>
    </div>
    <span class="font-monospace" style="background:#fff;padding:6px 12px;border-radius:6px;font-size:10px;font-weight:600;white-space:nowrap;color:var(--navy)">
      STATUS: AUDIT MONITORING
    </span>
  </div>

  <div class="ph">
    <div>
      <div class="bc">BERANDA &gt; <b>DATA INVENTARIS (EKSEKUTIF)</b></div>
      <h1>Data Inventaris Sarana &amp; Prasarana</h1>
      <p>Daftar menyeluruh aset sarana dan prasarana sekolah untuk pengawasan manajerial berkala.</p>
    </div>
    <div class="mini">
      <div class="stat-item">
        <span class="ic"><span class="material-symbols-outlined fs-5">inventory_2</span></span>
        <div><small>TOTAL INVENTARIS</small><b>{{ number_format(\App\Models\Barang::sum('jumlah')) }}</b> Unit</div>
      </div>
      <div class="stat-item">
        <span class="ic"><span class="material-symbols-outlined fs-5">category</span></span>
        <div><small>KATEGORI TERDAFTAR</small><b>{{ $kategoris->count() }}</b> Jenis</div>
      </div>
      <div class="stat-item">
        <span class="ic"><span class="material-symbols-outlined fs-5">meeting_room</span></span>
        <div><small>SEBARAN LOKASI</small><b>{{ $ruangans->count() }}</b> Ruangan</div>
      </div>
    </div>
  </div>

  <!-- Filter Form -->
  <form method="GET" action="{{ route('kepsek.inventaris') }}" class="card-box filters">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau spesifikasi barang...">
    <select name="kategori_id">
      <option value="">Semua Kategori</option>
      @foreach($kategoris as $k)
        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
      @endforeach
    </select>
    <select name="kondisi">
      <option value="">Semua Kondisi</option>
      <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
      <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
      <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
      <option value="Afkir" {{ request('kondisi') == 'Afkir' ? 'selected' : '' }}>Afkir</option>
    </select>
    <button type="submit" class="btn-filter">
      <span class="material-symbols-outlined fs-6">filter_alt</span> Filter Data
    </button>
    <a href="{{ route('kepsek.inventaris') }}" class="rs">
      <span class="material-symbols-outlined fs-6">restart_alt</span> Reset
    </a>
  </form>

  <!-- Table Card -->
  <div class="card-box overflow-hidden">
    <div class="table-responsive">
      <table class="tb-inv">
        <thead>
          <tr>
            <th style="width: 50px;">NO</th>
            <th>NAMA BARANG &amp; SPESIFIKASI</th>
            <th>KATEGORI</th>
            <th style="text-align: center; width: 100px;">JUMLAH</th>
            <th style="width: 110px;">KONDISI</th>
            <th>LOKASI RUANGAN</th>
            <th style="width: 110px;">THN PENGADAAN</th>
          </tr>
        </thead>
        <tbody>
          @forelse($barangs as $index => $b)
          <tr>
            <td class="font-monospace text-muted">{{ $barangs->firstItem() + $index }}</td>
            <td>
              <div class="fw-semibold text-dark">{{ $b->nama }}</div>
              @if($b->deskripsi)
                <small class="text-muted">{{ Str::limit($b->deskripsi, 60) }}</small>
              @endif
            </td>
            <td><span class="badge" style="background:#f1f3fa;color:#475569;font-size:10.5px">{{ $b->kategori->nama ?? '-' }}</span></td>
            <td style="text-align: center;" class="font-monospace fw-bold">{{ $b->jumlah }} {{ $b->satuan }}</td>
            <td>
              @if($b->kondisi == 'Baik')
                <span class="badge-baik">● Baik</span>
              @elseif($b->kondisi == 'Rusak Ringan')
                <span class="badge-ringan">● Rusak Ringan</span>
              @else
                <span class="badge-berat">● {{ $b->kondisi }}</span>
              @endif
            </td>
            <td>
              <div class="d-flex align-items-center gap-1 text-dark">
                <span class="material-symbols-outlined fs-6 text-primary">meeting_room</span>
                <span>{{ $b->ruangan->nama ?? '-' }}</span>
              </div>
            </td>
            <td class="font-monospace text-muted small">{{ $b->tahun_pengadaan ?? '-' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">Tidak ada data barang yang sesuai dengan filter.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{ $barangs->links() }}
  </div>
@endsection
