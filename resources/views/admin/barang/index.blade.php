@extends('layouts.admin')

@section('title', 'Data Inventaris Barang')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
  <div>
    <div class="page-breadcrumb">
      INVENTARIS SEKOLAH • <span class="active-crumb">SARPRAS &amp; ASET</span>
    </div>
    <h3 class="page-title">Data Inventaris Barang</h3>
    <p class="page-subtitle">
      Kelola seluruh daftar aset dan sarana prasarana sekolah secara terpusat dan akurat.
    </p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <!-- Total Counter Pill Box -->
    <div class="d-none d-sm-flex align-items-center gap-2 px-3 py-2 bg-white rounded-3 border" style="box-shadow: 0 1px 4px rgba(0,32,96,0.04);">
      <div class="stat-icon-sq" style="width: 34px; height: 34px; background: #e0edff; color: #002366; border-radius: 8px;">
        <span class="material-symbols-outlined fs-5">layers</span>
      </div>
      <div>
        <small class="text-muted fw-bold d-block" style="font-size: 9.5px; letter-spacing: 0.04em;">TOTAL INVENTARIS</small>
        <span class="fw-extrabold font-serif" style="font-size: 16px; color: #002366;">{{ number_format(\App\Models\Barang::sum('jumlah'), 0, ',', '.') }}</span> <small class="text-muted" style="font-size: 11px;">Unit</small>
      </div>
    </div>

    <!-- Add Item Button -->
    <a class="btn-navy-slicing" href="{{ route('admin.barang.create') }}">
      <span class="material-symbols-outlined fs-5">add_circle</span> Tambah Barang
    </a>
  </div>
</div>

<!-- Filter Toolbar Card -->
<form method="GET" action="{{ route('admin.barang') }}" class="filter-card">
  <div class="row g-2 align-items-center">
    <div class="col-12 col-md-4 col-lg-5">
      <div class="position-relative">
        <span class="material-symbols-outlined position-absolute text-muted" style="left: 10px; top: 9px; font-size: 18px;">search</span>
        <input type="text" name="search" class="filter-input w-100 ps-5" placeholder="Cari nama atau spesifikasi barang..." value="{{ request('search') }}">
      </div>
    </div>
    <div class="col-6 col-md-2 col-lg-2">
      <select name="kategori_id" class="filter-select w-100" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        @foreach($kategoris as $k)
        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md-2 col-lg-2">
      <select name="kondisi" class="filter-select w-100" onchange="this.form.submit()">
        <option value="">Semua Kondisi</option>
        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
        <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
        <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        <option value="Afkir" {{ request('kondisi') == 'Afkir' ? 'selected' : '' }}>Afkir</option>
      </select>
    </div>
    <div class="col-6 col-md-2 col-lg-2">
      <select name="ruangan_id" class="filter-select w-100" onchange="this.form.submit()">
        <option value="">Semua Ruangan</option>
        @foreach($ruangans as $r)
        <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md-2 col-lg-1 text-end">
      <a href="{{ route('admin.barang') }}" class="btn btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-1" style="background: #eef2fe; color: #002366; height: 36px; border-radius: 6px; font-weight: 600; font-size: 11.5px; border: none; text-decoration: none;" title="Reset Filter">
        <span class="material-symbols-outlined fs-6">restart_alt</span> Reset
      </a>
    </div>
  </div>
</form>

<!-- Table Card -->
<div class="card-slicing overflow-hidden">
  <div class="table-responsive">
    <table class="table-slicing">
      <thead>
        <tr>
          <th class="ps-4" style="width: 45px;">NO.</th>
          <th>NAMA BARANG</th>
          <th>KATEGORI</th>
          <th style="width: 100px;">JUMLAH</th>
          <th style="width: 130px;">KONDISI</th>
          <th>LOKASI RUANGAN</th>
          <th class="pe-4 text-end col-actions-3">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @forelse($barangs as $index => $b)
        <tr>
          <td class="ps-4 text-muted fw-semibold">{{ ($barangs->currentPage() - 1) * $barangs->perPage() + $index + 1 }}</td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="stat-icon-sq" style="width: 32px; height: 32px; background: #e0edff; color: #002366; border-radius: 6px;">
                <span class="material-symbols-outlined fs-5">{{ $b->kategori?->icon ?? 'inventory_2' }}</span>
              </div>
              <span class="fw-semibold text-dark">{{ $b->nama }}</span>
            </div>
          </td>
          <td><span class="badge" style="background: #f1f3fa; color: #475569; font-size: 11px;">{{ $b->kategori?->nama ?? 'Umum' }}</span></td>
          <td><b class="text-dark">{{ $b->jumlah }} {{ $b->satuan }}</b></td>
          <td><span class="badge-status {{ $b->kondisi_badge_class }}">● {{ strtoupper($b->kondisi) }}</span></td>
          <td class="text-muted small">{{ $b->ruangan?->nama ?? '-' }}</td>
          <td class="pe-4 text-end col-actions-3">
            <div class="table-actions">
              <button type="button" class="btn-action-icon btn-action-view" title="Lihat Detail" onclick="openDetailBarangModal('{{ $b->kode }}')">
                <span class="material-symbols-outlined fs-6">visibility</span>
              </button>
              <button type="button" class="btn-action-icon btn-action-edit" title="Ubah Data" onclick="openEditBarangModal('{{ $b->id }}', '{{ addslashes($b->nama) }}', '{{ $b->kode }}', '{{ $b->kategori_id }}', '{{ $b->ruangan_id }}', '{{ $b->jumlah }}', '{{ $b->kondisi }}', '{{ $b->nilai_perolehan }}')">
                <span class="material-symbols-outlined fs-6">edit</span>
              </button>
              <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus barang {{ $b->nama }}?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action-icon btn-action-del" title="Hapus"><span class="material-symbols-outlined fs-6">delete</span></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center py-4 text-muted small">Tidak ada data inventaris yang cocok dengan kriteria filter.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $barangs->links() }}
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="modalEditBarang" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Ubah Data Inventaris</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditBarang" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body p-4">
          <input type="hidden" name="kode" id="editBarangKode">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">NAMA BARANG</label>
            <input type="text" name="nama" id="editBarangNama" class="form-control" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">KATEGORI</label>
              <select name="kategori_id" id="editBarangKategori" class="form-select" required>
                @foreach($kategoris as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">LOKASI RUANGAN</label>
              <select name="ruangan_id" id="editBarangRuangan" class="form-select" required>
                @foreach($ruangans as $r)
                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">JUMLAH (UNIT)</label>
              <input type="number" name="jumlah" id="editBarangJumlah" class="form-control" min="1" required>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">KONDISI</label>
              <select name="kondisi" id="editBarangKondisi" class="form-select" required>
                <option value="Baik">Baik</option>
                <option value="Rusak Ringan">Rusak Ringan</option>
                <option value="Rusak Berat">Rusak Berat</option>
                <option value="Afkir">Afkir</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">GANTI FOTO BARANG (OPSIONAL - MAKS 3 MB)</label>
            <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
          </div>
        </div>
        <div class="modal-footer bg-light p-2 px-3 d-flex justify-content-between">
          <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing py-1 px-3">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openEditBarangModal(id, nama, kode, katId, rngId, qty, cond, val) {
    const form = document.getElementById('formEditBarang');
    form.action = `/admin/barang/${id}`;
    document.getElementById('editBarangNama').value = nama;
    document.getElementById('editBarangKode').value = kode;
    document.getElementById('editBarangKategori').value = katId;
    document.getElementById('editBarangRuangan').value = rngId;
    document.getElementById('editBarangJumlah').value = qty;
    document.getElementById('editBarangKondisi').value = cond;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditBarang')).show();
  }
</script>

@include('partials.modal-detail-barang')
@endsection
