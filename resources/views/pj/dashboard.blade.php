@extends('layouts.pj')

@section('title', 'Cek Barang Lab Saya')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-2">
  <div>
    <div class="page-breadcrumb">
      <span>Portal PJ</span>
      <span>/</span>
      <b>Cek Barang Lab</b>
    </div>
    <h1 class="page-title">{{ auth()->user()?->name ?? session('auth_user.name', 'Penanggung Jawab') }}</h1>
    <p class="page-subtitle">Penanggung Jawab <b>{{ $ruanganUtama?->nama ?? session('auth_user.lab', 'Lab / Ruangan') }}</b> &bull; {{ $ruanganUtama?->gedung ?? 'Inventaris Sekolah' }}</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('pj.laporan') }}" class="btn-navy-slicing shadow-sm">
      <span class="material-symbols-outlined fs-5">campaign</span>
      <span>Buat Laporan / Pengaduan Barang</span>
    </a>
  </div>
</div>

<!-- 3 Mini Stats for PJ Room -->
<div class="row g-3">
  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">TOTAL ASET DI RUANGAN</span>
          <div class="stat-box-num">{{ $totalAset ?? 0 }} <small>Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #002366;">
          <span class="material-symbols-outlined fs-4">inventory_2</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>{{ count($barangs ?? []) }} Jenis Barang</span>
        <b class="text-primary font-monospace">{{ $ruanganUtama?->kode ?? 'RNG' }}</b>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">KONDISI BAIK</span>
          <div class="stat-box-num" style="color: #15803d;">{{ $baikCount ?? 0 }} <small style="color: #15803d;">Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #dcfce7; color: #15803d;">
          <span class="material-symbols-outlined fs-4">check_circle</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Tingkat Kelaikan</span>
        <b class="text-success font-monospace">{{ ($totalAset ?? 0) > 0 ? round(($baikCount / $totalAset) * 100, 1) : 100 }}% Baik</b>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">RUSAK / BUTUH GANTI</span>
          <div class="stat-box-num" style="color: #b45309;">{{ $rusakCount ?? 0 }} <small style="color: #b45309;">Unit</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #fef3c7; color: #b45309;">
          <span class="material-symbols-outlined fs-4">warning</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Perlu Tindak Lanjut</span>
        <b class="text-warning font-monospace">{{ $rusakCount > 0 ? 'Bisa Dilaporkan' : 'Kondisi Aman' }}</b>
      </div>
    </div>
  </div>
</div>

<!-- Table: Barang di Lab Saya -->
<div class="card-slicing overflow-hidden mt-3">
  <div class="p-3 px-4 border-bottom bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
    <div>
      <h6 class="fw-bold mb-0 text-dark">Daftar Barang Inventaris di {{ $ruanganUtama?->nama ?? 'Ruangan Saya' }}</h6>
      <small class="text-muted" style="font-size: 11.5px;">Gunakan tombol aksi untuk cek spesifikasi atau langsung laporkan kerusakan/kehilangan ke Admin.</small>
    </div>
    <span class="badge" style="background: #e0edff; color: #002366; font-size: 11px;">Tanggung Jawab Anda</span>
  </div>

  <div class="table-responsive">
    <table class="table-slicing">
      <thead>
        <tr>
          <th class="ps-4" style="width: 45px;">NO</th>
          <th>NAMA BARANG &amp; KETERANGAN</th>
          <th>KATEGORI</th>
          <th style="width: 90px;">JUMLAH</th>
          <th style="width: 130px;">KONDISI</th>
          <th class="pe-4 text-end" style="min-width: 160px;">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @forelse($barangs as $index => $item)
        <tr>
          <td class="ps-4 text-muted fw-semibold">{{ str_pad(($barangs->currentPage() - 1) * $barangs->perPage() + $index + 1, 2, '0', STR_PAD_LEFT) }}</td>
          <td>
            <b class="text-dark" style="font-size: 12.5px;">{{ $item->nama }}</b>
            <small class="text-muted d-block" style="font-size: 11px;">{{ $item->keterangan ?: 'Inventaris aktif terdaftar pada data sarpras.' }}</small>
          </td>
          <td><span class="badge" style="background: #f1f3fa; color: #475569; font-size: 11px;">{{ $item->kategori?->nama ?? 'Umum' }}</span></td>
          <td><b class="text-dark">{{ $item->jumlah }} {{ $item->satuan }}</b></td>
          <td><span class="badge-status {{ $item->kondisi_badge_class }}">● {{ $item->kondisi }}</span></td>
          <td class="pe-4 text-end">
            <div class="table-actions">
              <button type="button" class="btn-action-icon btn-action-view" title="Lihat Detail Barang" onclick="openDetailBarangModal('{{ $item->kode }}')">
                <span class="material-symbols-outlined fs-6">visibility</span>
              </button>
              <a href="{{ route('pj.laporan', ['barang' => $item->nama, 'kode' => $item->kode]) }}" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 11px; font-weight: 600; text-decoration: none;" title="Laporkan Masalah / Ganti Barang Ini">
                <span class="material-symbols-outlined fs-6">campaign</span>
                <span>Laporkan</span>
              </a>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted small">
            Belum ada barang yang didaftarkan pada ruangan ini.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $barangs->links() }}
</div>

@include('partials.modal-detail-barang')
@endsection
