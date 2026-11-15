@extends('layouts.admin')

@section('title', 'Data Ruangan & Lokasi')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
  <div>
    <div class="page-breadcrumb">
      Home / <span class="active-crumb">Data Ruangan</span>
    </div>
    <h3 class="page-title">Data Ruangan &amp; Lokasi</h3>
    <p class="page-subtitle">
      Daftar ruangan sekolah beserta persebaran inventaris barang.
    </p>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-navy-slicing" data-bs-toggle="modal" data-bs-target="#modalTambahRuangan">
      <span class="material-symbols-outlined fs-5">add</span> Tambah Ruangan
    </button>
  </div>
</div>

<!-- 3 Stat Cards in Grid -->
<div class="row g-3">
  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL RUANGAN</div>
          <div class="stat-box-num">{{ count($ruangans) }}</div>
          <div class="mt-2">
            <span class="badge" style="background: #eef2fe; color: #002366; font-size: 11px; padding: 4px 8px;">
              {{ count($ruangans) }} Ruangan Aktif
            </span>
          </div>
        </div>
        <div class="stat-icon-sq" style="background: #eef2fe; color: #002366;">
          <span class="material-symbols-outlined fs-4">meeting_room</span>
        </div>
      </div>
      <div class="stat-box-footer mt-2" style="background: transparent; padding: 0;">
        <span class="text-muted" style="font-size: 11px;">Terdaftar di database</span>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">RUANGAN TERISI ASET</div>
          <div class="stat-box-num">{{ $ruangans->filter(fn($r) => $r->total_aset > 0)->count() }}</div>
          <div class="mt-2 d-flex align-items-center gap-2">
            <span class="badge-status badge-status-baik">● Aktif Digunakan</span>
          </div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #0284c7;">
          <span class="material-symbols-outlined fs-4">domain</span>
        </div>
      </div>
      <div class="stat-box-footer mt-2" style="background: transparent; padding: 0;">
        <span class="text-muted" style="font-size: 11px;">Optimalisasi fungsi ruangan</span>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="stat-box-title">TOTAL UNIT TERDATA</div>
          <div class="stat-box-num" style="font-size: 24px;">{{ number_format(\App\Models\Barang::sum('jumlah'), 0, ',', '.') }}</div>
          <div class="mt-2">
            <span class="badge" style="background: #eef2fe; color: #002366; font-size: 11px; padding: 4px 8px;">
              Aset Keseluruhan
            </span>
          </div>
        </div>
        <div class="stat-icon-sq" style="background: #eef2fe; color: #4338ca;">
          <span class="material-symbols-outlined fs-4">analytics</span>
        </div>
      </div>
      <div class="stat-box-footer mt-2" style="background: transparent; padding: 0;">
        <span class="text-muted" style="font-size: 11px;">SIM-Sarpras Sekolah</span>
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
          <th class="ps-4" style="width: 40px;">NO</th>
          <th>NAMA RUANGAN</th>
          <th>GEDUNG &amp; LANTAI</th>
          <th>PENANGGUNG JAWAB</th>
          <th style="width: 100px;">JUMLAH ASET</th>
          <th style="width: 130px;">STATUS KONDISI</th>
          <th class="pe-4 text-end col-actions-3">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @forelse($ruangans as $index => $r)
        <tr>
          <td class="ps-4 text-muted fw-semibold">{{ str_pad(($ruangans->currentPage() - 1) * $ruangans->perPage() + $index + 1, 2, '0', STR_PAD_LEFT) }}</td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="stat-icon-sq" style="width: 32px; height: 32px; background: #e0edff; color: #002366; border-radius: 6px;">
                <span class="material-symbols-outlined fs-5">{{ $r->icon ?: 'meeting_room' }}</span>
              </div>
              <div>
                <div class="fw-semibold text-dark">{{ $r->nama }}</div>
                <small class="text-muted" style="font-size: 10.5px;">{{ $r->sub ?: 'Ruangan Terdaftar' }}</small>
              </div>
            </div>
          </td>
          <td>
            <span class="badge" style="background: #eef2fe; color: #3730a3; font-size: 11px; padding: 4px 8px;">
              <span class="material-symbols-outlined fs-6 align-text-bottom">domain</span> {{ $r->gedung }} {{ $r->lantai ? '(' . $r->lantai . ')' : '' }}
            </span>
          </td>
          <td>
            @if($r->pj)
            <div class="d-flex align-items-center gap-2">
              <div class="rounded-circle d-grid place-items-center fw-bold text-white" style="width: 26px; height: 26px; background: #0284c7; font-size: 10px;">
                {{ $r->pj->initials }}
              </div>
              <span class="text-dark small fw-semibold">{{ $r->pj->name }}</span>
            </div>
            @else
            <span class="badge bg-light text-muted border">Belum Ditugaskan</span>
            @endif
          </td>
          <td><b class="text-dark">{{ $r->total_aset }}</b> <small class="text-muted">Unit</small></td>
          <td><span class="badge-status badge-status-baik">● {{ $r->persentase_baik }}% Baik</span></td>
          <td class="pe-4 text-end col-actions-3">
            <div class="table-actions">
              <button type="button" class="btn-action-icon btn-action-view" title="Lihat Rincian" onclick="openDetailRuanganModal('{{ $r->kode }}')">
                <span class="material-symbols-outlined fs-6">visibility</span>
              </button>
              <button type="button" class="btn-action-icon btn-action-edit" title="Ubah" onclick="openEditRuangan('{{ $r->id }}', '{{ $r->kode }}', '{{ addslashes($r->nama) }}', '{{ addslashes($r->sub) }}', '{{ addslashes($r->gedung) }}', '{{ addslashes($r->lantai) }}', '{{ $r->pj_id }}', '{{ addslashes($r->catatan) }}')">
                <span class="material-symbols-outlined fs-6">edit</span>
              </button>
              <form action="{{ route('admin.ruangan.destroy', $r->id) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus ruangan {{ $r->nama }}?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action-icon btn-action-del" title="Hapus"><span class="material-symbols-outlined fs-6">delete</span></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center py-4 text-muted small">Belum ada ruangan yang didaftarkan.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{ $ruangans->links() }}
</div>

<!-- Modal Tambah Ruangan -->
<div class="modal fade" id="modalTambahRuangan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Tambah Ruangan Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.ruangan.store') }}" method="POST">
        @csrf
        <div class="modal-body p-4">
          <input type="hidden" name="kode" value="">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">NAMA RUANGAN</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama ruangan atau laboratorium..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">SUB NAMA / FUNGSI</label>
            <input type="text" name="sub" class="form-control" placeholder="Contoh: Lab Komputer Software RPL">
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">LOKASI GEDUNG</label>
              <input type="text" name="gedung" class="form-control" placeholder="Contoh: Gedung Praktik Kejuruan" required>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold text-muted">LANTAI / ZONA</label>
              <input type="text" name="lantai" class="form-control" placeholder="Contoh: Lantai 2">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">PENANGGUNG JAWAB (PJ)</label>
            <select name="pj_id" class="form-select">
              <option value="">-- Pilih Guru / PJ --</option>
              @foreach($listPJ as $pj)
              <option value="{{ $pj->id }}">{{ $pj->name }} ({{ $pj->nip }})</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">CATATAN KHUSUS</label>
            <textarea name="catatan" class="form-control" rows="2" placeholder="Keterangan fasilitas atau peruntukan..."></textarea>
          </div>
        </div>
        <div class="modal-footer bg-light p-2 px-3 d-flex justify-content-between">
          <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing py-1 px-3">Simpan Ruangan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Ruangan -->
<div class="modal fade" id="modalEditRuangan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Ubah Data Ruangan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditRuangan" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body p-4">
          <input type="hidden" name="kode" id="editRuanganKode">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">NAMA RUANGAN</label>
            <input type="text" name="nama" id="editRuanganNama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">LOKASI GEDUNG</label>
            <input type="text" name="gedung" id="editRuanganGedung" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">PENANGGUNG JAWAB (PJ)</label>
            <select name="pj_id" id="editRuanganPJ" class="form-select">
              <option value="">-- Pilih Guru / PJ --</option>
              @foreach($listPJ as $pj)
              <option value="{{ $pj->id }}">{{ $pj->name }} ({{ $pj->nip }})</option>
              @endforeach
            </select>
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
  function openEditRuangan(id, kode, nama, sub, gedung, lantai, pjId, catatan) {
    document.getElementById('formEditRuangan').action = `/admin/ruangan/${id}`;
    document.getElementById('editRuanganKode').value = kode;
    document.getElementById('editRuanganNama').value = nama;
    document.getElementById('editRuanganGedung').value = gedung;
    document.getElementById('editRuanganPJ').value = pjId || '';

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditRuangan')).show();
  }
</script>

@include('partials.modal-detail-ruangan')
@endsection
