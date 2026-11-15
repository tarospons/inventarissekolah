@extends('layouts.admin')

@section('title', 'Kategori Inventaris')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
  <div>
    <div class="page-breadcrumb">
      Home / <span class="active-crumb">Kategori</span>
    </div>
    <h3 class="page-title">Kategori Inventaris</h3>
    <p class="page-subtitle">
      Kelola kategori klasifikasi inventaris sarana dan prasarana sekolah secara terpadu dan akurat.
    </p>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-navy-slicing" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
      <span class="material-symbols-outlined fs-5">add</span> Tambah Kategori
    </button>
  </div>
</div>

<!-- 3 Stat Cards in Grid -->
<div class="row g-3">
  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL KLASIFIKASI</div>
          <div class="stat-box-num">{{ count($kategoris) }} <small>Kategori Aktif</small></div>
          <div class="text-muted mt-2" style="font-size: 11px;">Tercatat dalam sistem Dapodik</div>
        </div>
        <div class="stat-icon-sq" style="background: #eef2fe; color: #002366;">
          <span class="material-symbols-outlined fs-4">category</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL ITEM TERDAFTAR</div>
          <div class="stat-box-num">{{ \App\Models\Barang::count() }} <small>Jenis Aset</small></div>
          <div class="mt-2">
            <span class="badge" style="background: #eef2fe; color: #0a58ca; font-size: 11px; padding: 4px 8px;">
              <span class="material-symbols-outlined fs-6 align-text-bottom">check_circle</span> Terinventarisasi
            </span>
          </div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #0284c7;">
          <span class="material-symbols-outlined fs-4">trending_up</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL KUANTITAS FISIK</div>
          <div class="stat-box-num">{{ number_format(\App\Models\Barang::sum('jumlah'), 0, ',', '.') }} <small>Unit</small></div>
          <div class="text-muted mt-2" style="font-size: 11px;">Tersebar di seluruh lab & bengkel</div>
        </div>
        <div class="stat-icon-sq" style="background: #eef2fe; color: #4338ca;">
          <span class="material-symbols-outlined fs-4">inventory_2</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="card-slicing overflow-hidden mt-3">
  <div class="table-responsive">
    <table class="table-slicing">
      <thead>
        <tr>
          <th class="ps-4" style="width: 45px;">NO</th>
          <th>NAMA KATEGORI</th>
          <th>DESKRIPSI / KETERANGAN</th>
          <th class="text-center" style="width: 120px;">JENIS BARANG</th>
          <th style="width: 110px;">TOTAL UNIT</th>
          <th class="pe-4 text-end col-actions-2">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kategoris as $index => $k)
        <tr>
          <td class="ps-4 text-muted fw-semibold">{{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $index + 1 }}</td>
          <td>
            <div class="d-flex align-items-center gap-2 fw-semibold text-dark">
              <span class="material-symbols-outlined text-primary fs-5">{{ $k->icon ?: 'category' }}</span>
              <span>{{ $k->nama }}</span>
            </div>
          </td>
          <td class="text-muted small">{{ $k->deskripsi ?: '-' }}</td>
          <td class="text-center">
            <span class="badge" style="background: #e0e7ff; color: #1e3a8a; font-size: 11px; padding: 4px 8px; border-radius: 99px;">
              {{ $k->barangs_count ?? $k->barangs()->count() }} Jenis
            </span>
          </td>
          <td><b class="text-dark">{{ $k->barangs()->sum('jumlah') }} Unit</b></td>
          <td class="pe-4 text-end col-actions-2">
            <div class="table-actions">
              <button class="btn-action-icon btn-action-edit" title="Ubah" onclick="openEditKategori('{{ $k->id }}', '{{ $k->kode }}', '{{ addslashes($k->nama) }}', '{{ addslashes($k->deskripsi) }}', '{{ $k->icon }}')">
                <span class="material-symbols-outlined fs-6">edit</span>
              </button>
              <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus kategori {{ $k->nama }}?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action-icon btn-action-del" title="Hapus"><span class="material-symbols-outlined fs-6">delete</span></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted small">Belum ada kategori yang terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $kategoris->links() }}
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Tambah Kategori Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="modal-body p-4">
          <input type="hidden" name="kode" value="">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">NAMA KATEGORI</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama kategori klasifikasi..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">ICON MATERIAL SYMBOLS</label>
            <input type="text" name="icon" class="form-control" value="category" placeholder="Contoh: desktop_windows, precision_manufacturing">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">DESKRIPSI / KETERANGAN</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi ringkas cakupan kategori..."></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light p-2 px-3 d-flex justify-content-between">
          <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing py-1 px-3">Simpan Kategori</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Ubah Kategori Inventaris</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditKategori" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body p-4">
          <input type="hidden" name="kode" id="editKategoriKode">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">NAMA KATEGORI</label>
            <input type="text" name="nama" id="editKategoriNama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">ICON MATERIAL SYMBOLS</label>
            <input type="text" name="icon" id="editKategoriIcon" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">DESKRIPSI / KETERANGAN</label>
            <textarea name="deskripsi" id="editKategoriDeskripsi" class="form-control" rows="3"></textarea>
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
  function openEditKategori(id, kode, nama, desk, icon) {
    document.getElementById('formEditKategori').action = `/admin/kategori/${id}`;
    document.getElementById('editKategoriKode').value = kode;
    document.getElementById('editKategoriNama').value = nama;
    document.getElementById('editKategoriDeskripsi').value = desk;
    document.getElementById('editKategoriIcon').value = icon;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditKategori')).show();
  }
</script>
@endsection
