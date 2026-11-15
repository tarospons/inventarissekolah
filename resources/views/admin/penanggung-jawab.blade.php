@extends('layouts.admin')

@section('title', 'Data Penanggung Jawab Lab & Ruangan')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
  <div>
    <div class="page-breadcrumb">
      <span>Home</span>
      <span>/</span>
      <span>Inventaris Sekolah</span>
      <span>/</span>
      <b class="active-crumb">Penanggung Jawab</b>
    </div>
    <h1 class="page-title">Data Penanggung Jawab Lab &amp; Ruangan</h1>
    <p class="page-subtitle">Daftar guru, kepala lab &amp; wali kelas penanggung jawab sarana dan prasarana sekolah.</p>
  </div>
  <div class="d-flex gap-2 align-items-center">
    <button type="button" class="btn-navy-slicing shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPJ">
      <span class="material-symbols-outlined fs-5">person_add</span>
      <span>Tambah Penanggung Jawab</span>
    </button>
  </div>
</div>

<!-- Flash Notifications -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show py-2 px-3 small d-flex align-items-center gap-2 mb-3" role="alert">
    <span class="material-symbols-outlined text-success fs-5">check_circle</span>
    <div class="flex-grow-1">{{ session('success') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(isset($errors) && $errors->any())
  <div class="alert alert-danger alert-dismissible fade show py-2 px-3 small mb-3" role="alert">
    <div class="fw-bold mb-1 d-flex align-items-center gap-1">
      <span class="material-symbols-outlined fs-6">error</span> Terdapat kesalahan input:
    </div>
    <ul class="mb-0 ps-3">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<!-- 3 Stat Mini Cards -->
<div class="row g-3 mb-3">
  <div class="col-12 col-sm-6 col-lg-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">TOTAL PENANGGUNG JAWAB</span>
          <div class="stat-box-num">{{ $listPJ->total() }} <small>Orang</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0edff; color: #002366;">
          <span class="material-symbols-outlined fs-4">badge</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span><span class="material-symbols-outlined fs-6 align-text-bottom text-primary">domain</span> Tersebar di Ruangan Sekolah</span>
        <b class="text-primary font-monospace">{{ $ruangans->count() }} Ruang</b>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-lg-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">JURUSAN KEJURUAN</span>
          <div class="stat-box-num">6 <small>Konsentrasi</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0f2fe; color: #0284c7;">
          <span class="material-symbols-outlined fs-4">school</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>TP, GP, RPL, KL, PH, ATR</span>
        <b class="text-info font-monospace">Terintegrasi</b>
      </div>
    </div>
  </div>

  @php
    $onlineCount = $listPJ->filter(fn($u) => $u->is_online)->count();
    $offlineCount = $listPJ->total() - $onlineCount;
  @endphp
  <div class="col-12 col-sm-6 col-lg-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">STATUS AKTIVITAS WEB</span>
          <div class="stat-box-num" style="color: {{ $onlineCount > 0 ? '#15803d' : '#64748b' }};">
            {{ $onlineCount }} <small>Online</small>
          </div>
        </div>
        <div class="stat-icon-sq" style="background: {{ $onlineCount > 0 ? '#dcfce7' : '#f1f5f9' }}; color: {{ $onlineCount > 0 ? '#15803d' : '#64748b' }};">
          <span class="material-symbols-outlined fs-4">{{ $onlineCount > 0 ? 'sensors' : 'sensors_off' }}</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>{{ $offlineCount }} Petugas Sedang Offline</span>
        <b class="{{ $onlineCount > 0 ? 'text-success' : 'text-secondary' }} font-monospace">Realtime</b>
      </div>
    </div>
  </div>
</div>

<!-- Search & Filter Form -->
<form method="GET" action="{{ route('admin.pj') }}" class="filter-card mb-3">
  <div class="row g-2 align-items-center">
    <div class="col-12 col-md-6 col-lg-6">
      <div class="position-relative">
        <span class="material-symbols-outlined position-absolute" style="left: 10px; top: 9px; color: #94a3b8; font-size: 19px;">search</span>
        <input type="text" name="search" value="{{ request('search') }}" class="filter-input w-100 ps-5" placeholder="Cari nama, NIP, jurusan, atau jabatan...">
      </div>
    </div>
    <div class="col-6 col-md-3 col-lg-3">
      <select name="jurusan" class="filter-select w-100">
        <option value="">Semua Jurusan / Unit</option>
        <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
        <option value="TP" {{ request('jurusan') == 'TP' ? 'selected' : '' }}>TP (Pengelasan)</option>
        <option value="GP" {{ request('jurusan') == 'GP' ? 'selected' : '' }}>GP (Geologi Pertambangan)</option>
        <option value="KL" {{ request('jurusan') == 'KL' ? 'selected' : '' }}>KL (Kuliner)</option>
        <option value="PH" {{ request('jurusan') == 'PH' ? 'selected' : '' }}>PH (Perhotelan)</option>
        <option value="ATR" {{ request('jurusan') == 'ATR' ? 'selected' : '' }}>ATR (Peternakan)</option>
        <option value="Umum" {{ request('jurusan') == 'Umum' ? 'selected' : '' }}>Umum / Non-Kejuruan</option>
      </select>
    </div>
    <div class="col-6 col-md-3 col-lg-3 d-flex gap-2">
      <button type="submit" class="btn btn-primary btn-sm flex-grow-1" style="background:#002366; border-color:#002366;">
        <span class="material-symbols-outlined fs-6 align-middle">filter_alt</span> Filter
      </button>
      <a href="{{ route('admin.pj') }}" class="btn btn-light btn-sm border" title="Reset">
        <span class="material-symbols-outlined fs-6 align-middle">restart_alt</span>
      </a>
    </div>
  </div>
</form>

<!-- Table Card -->
<div class="card-slicing overflow-hidden">
  <div class="table-responsive">
    <table class="table-slicing" id="tablePJ">
      <thead>
        <tr>
          <th class="ps-4" style="width: 45px;">NO</th>
          <th style="min-width: 260px;">PROFIL PENANGGUNG JAWAB</th>
          <th>JABATAN</th>
          <th>RUANGAN YANG DIKELOLA</th>
          <th>JURUSAN</th>
          <th>KONTAK &amp; EMAIL</th>
          <th class="text-center" style="width: 100px;">STATUS WEB</th>
          <th class="pe-4 text-end" style="width: 110px;">AKSI</th>
        </tr>
      </thead>
      <tbody>
        @forelse($listPJ as $index => $pj)
        <tr>
          <td class="ps-4 text-muted fw-semibold">{{ $listPJ->firstItem() + $index }}</td>
          <td>
            <div class="d-flex align-items-center gap-3">
              <img src="{{ $pj->foto_url }}" alt="{{ $pj->name }}" class="avatar-img" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 1.5px solid #002366;">
              <div>
                <b class="text-dark d-block" style="font-size: 13px;">{{ $pj->name }}</b>
                <div class="text-muted small font-monospace" style="font-size: 11px;">NIP. {{ $pj->nip }}</div>
              </div>
            </div>
          </td>
          <td><span class="fw-semibold text-dark">{{ $pj->jabatan }}</span></td>
          <td>
            @php $pjRooms = $pj->ruangans; @endphp
            @if($pjRooms->count() > 0)
              @foreach($pjRooms as $rm)
                <span class="badge mb-1 d-inline-flex align-items-center gap-1" style="background: #e0edff; color: #002366; font-size: 10.5px;">
                  <span class="material-symbols-outlined fs-6">{{ $rm->icon ?? 'meeting_room' }}</span>
                  <span>{{ $rm->nama }}</span>
                </span>
              @endforeach
            @else
              <span class="text-muted small fst-italic">Belum ditugaskan</span>
            @endif
          </td>
          <td><span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 10.5px; font-weight: 700;">{{ $pj->jurusan ?? 'Umum' }}</span></td>
          <td>
            <div class="small text-dark fw-semibold"><span class="material-symbols-outlined fs-6 text-success align-text-bottom">call</span> {{ $pj->kontak ?? '-' }}</div>
            <div class="text-muted small" style="font-size: 10.5px;">{{ $pj->email }}</div>
          </td>
          <td class="text-center">
            @if($pj->is_online)
              <span class="badge-status badge-status-baik">● Online</span>
            @else
              <span class="badge" style="background: #f1f5f9; color: #64748b; font-size: 10px; font-weight: 700; padding: 4px 8px; border-radius: 99px; border: 1px solid #cbd5e1;">○ Offline</span>
            @endif
          </td>
          <td class="pe-4 text-end">
            <div class="d-flex justify-content-end gap-1">
              <button type="button" class="btn btn-sm btn-light border p-1" title="Edit Data PJ" 
                      onclick="openEditPJModal({{ json_encode([
                        'id' => $pj->id,
                        'name' => $pj->name,
                        'nip' => $pj->nip,
                        'jabatan' => $pj->jabatan,
                        'jurusan' => $pj->jurusan,
                        'kontak' => $pj->kontak,
                        'email' => $pj->email,
                        'ruangan_id' => $pj->ruangans->first()?->id,
                        'foto_url' => $pj->foto_url,
                      ]) }})">
                <span class="material-symbols-outlined fs-6 align-middle text-primary">edit</span>
              </button>
              <button type="button" class="btn btn-sm btn-light border p-1" title="Hapus Akun PJ" 
                      onclick="openHapusPJModal({{ $pj->id }}, '{{ addslashes($pj->name) }}', '{{ $pj->nip }}')">
                <span class="material-symbols-outlined fs-6 align-middle text-danger">delete</span>
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center py-4 text-muted">Belum ada data penanggung jawab yang terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $listPJ->links() }}
</div>

<!-- Modal Tambah PJ Baru -->
<div class="modal fade" id="modalTambahPJ" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">person_add</span>
          <h5 class="modal-title fs-6 fw-bold mb-0">Tambah Penanggung Jawab Baru</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.pj.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4">
          <div class="row g-3">
            <div class="col-12 col-md-4 text-center border-end-md">
              <label class="form-label small fw-bold text-muted d-block text-start mb-2">FOTO PROFIL (MAKS 3 MB)</label>
              <div class="my-2">
                <img id="previewTambahFoto" src="https://ui-avatars.com/api/?name=PJ&background=002366&color=ffffff" alt="Avatar" class="avatar-pj-lg mb-2" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #002366;">
              </div>
              <input type="file" name="foto" class="form-control form-control-sm" accept="image/*" onchange="previewImg(this, 'previewTambahFoto')">
              <small class="text-muted d-block mt-1" style="font-size: 10.5px;">Maksimal 3 MB (JPG/PNG/WebP)</small>
            </div>
            <div class="col-12 col-md-8">
              <div class="row g-2">
                <div class="col-12">
                  <label class="form-label small fw-bold text-muted mb-1">NAMA LENGKAP & GELAR <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" placeholder="Contoh: Ahmad Fauzi, S.Kom." required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NIP (UNTUK LOGIN) <span class="text-danger">*</span></label>
                  <input type="text" name="nip" class="form-control font-monospace" placeholder="19840312 200902 1 004" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">SANDI / PASSWORD LOGIN <span class="text-danger">*</span></label>
                  <input type="password" name="password" class="form-control" placeholder="Sandi login PJ (min. 4 karakter)" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">RUANGAN YANG DIKELOLA</label>
                  <select name="ruangan_id" class="form-select">
                    <option value="">-- Pilih Ruangan / Lab --</option>
                    @foreach($ruangans as $r)
                      <option value="{{ $r->id }}">{{ $r->nama }} ({{ $r->gedung }})</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JURUSAN</label>
                  <select name="jurusan" class="form-select">
                    <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                    <option value="TP">TP (Teknik Pengelasan)</option>
                    <option value="GP">GP (Geologi Pertambangan)</option>
                    <option value="KL">KL (Kuliner)</option>
                    <option value="PH">PH (Perhotelan)</option>
                    <option value="ATR">ATR (Agribisnis Ternak Ruminansia)</option>
                    <option value="Umum">Umum / Sarana Pendukung</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JABATAN <span class="text-danger">*</span></label>
                  <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Kepala Lab RPL" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NO. WHATSAPP</label>
                  <input type="text" name="kontak" class="form-control" placeholder="0812-xxxx-xxxx">
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold text-muted mb-1">EMAIL RESMI (OPSIONAL)</label>
                  <input type="email" name="email" class="form-control" placeholder="Dibuat otomatis jika dikosongkan">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing">
            <span class="material-symbols-outlined fs-5">save</span> Simpan Penanggung Jawab
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit PJ (Single Unified Modal) -->
<div class="modal fade" id="modalEditPJ" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <h5 class="modal-title fs-6 fw-bold">Edit Penanggung Jawab</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditPJ" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body p-4">
          <div class="row g-3">
            <div class="col-12 col-md-4 text-center border-end-md">
              <label class="form-label small fw-bold text-muted d-block text-start mb-2">FOTO PROFIL (MAKS 3 MB)</label>
              <img id="editPJFotoPreview" src="" alt="Avatar" class="avatar-pj-lg mb-2" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #002366;">
              <input type="file" name="foto" class="form-control form-control-sm mt-2" accept="image/*" onchange="previewImg(this, 'editPJFotoPreview')">
              <small class="text-muted d-block mt-1" style="font-size: 10.5px;">JPG/PNG/WebP, Maksimal 3 MB.</small>
            </div>
            <div class="col-12 col-md-8">
              <div class="row g-2">
                <div class="col-12">
                  <label class="form-label small fw-bold text-muted mb-1">NAMA LENGKAP & GELAR <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="editPJName" class="form-control" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NIP (UNTUK LOGIN PJ) <span class="text-danger">*</span></label>
                  <input type="text" name="nip" id="editPJNip" class="form-control font-monospace" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JABATAN <span class="text-danger">*</span></label>
                  <input type="text" name="jabatan" id="editPJJabatan" class="form-control" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">RUANGAN YANG DIKELOLA</label>
                  <select name="ruangan_id" id="editPJRuangan" class="form-select">
                    <option value="">-- Tidak Ditugaskan --</option>
                    @foreach($ruangans as $r)
                      <option value="{{ $r->id }}">{{ $r->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JURUSAN</label>
                  <select name="jurusan" id="editPJJurusan" class="form-select">
                    <option value="RPL">RPL</option>
                    <option value="TP">TP (Pengelasan)</option>
                    <option value="GP">GP (Geologi Pertambangan)</option>
                    <option value="KL">KL (Kuliner)</option>
                    <option value="PH">PH (Perhotelan)</option>
                    <option value="ATR">ATR (Peternakan)</option>
                    <option value="Umum">Umum</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NOMOR WHATSAPP</label>
                  <input type="text" name="kontak" id="editPJKontak" class="form-control">
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">EMAIL RESMI <span class="text-danger">*</span></label>
                  <input type="email" name="email" id="editPJEmail" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label small fw-bold text-muted mb-1">UBAH SANDI / PASSWORD (OPSIONAL)</label>
                  <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Hapus PJ (Single Unified Modal) -->
<div class="modal fade" id="modalHapusPJ" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fs-6 fw-bold">Konfirmasi Hapus Akun PJ</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formHapusPJ" action="" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body p-4 text-center">
          <span class="material-symbols-outlined text-danger mb-2" style="font-size: 48px;">warning</span>
          <p class="mb-1 fw-bold text-dark fs-6" id="hapusPJNama">-</p>
          <small class="text-muted d-block" id="hapusPJNip">-</small>
          <p class="small text-danger mt-2 mb-0">Apakah Anda yakin ingin menghapus akun penanggung jawab ini?</p>
        </div>
        <div class="modal-footer bg-light justify-content-center">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus Permanen</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function previewImg(input, targetId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById(targetId).src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function openEditPJModal(data) {
    document.getElementById('formEditPJ').action = `/admin/penanggung-jawab/${data.id}`;
    document.getElementById('editPJName').value = data.name || '';
    document.getElementById('editPJNip').value = data.nip || '';
    document.getElementById('editPJJabatan').value = data.jabatan || '';
    document.getElementById('editPJJurusan').value = data.jurusan || 'Umum';
    document.getElementById('editPJKontak').value = data.kontak || '';
    document.getElementById('editPJEmail').value = data.email || '';
    document.getElementById('editPJRuangan').value = data.ruangan_id || '';
    document.getElementById('editPJFotoPreview').src = data.foto_url || '';

    const modal = new bootstrap.Modal(document.getElementById('modalEditPJ'));
    modal.show();
  }

  function openHapusPJModal(id, name, nip) {
    document.getElementById('formHapusPJ').action = `/admin/penanggung-jawab/${id}`;
    document.getElementById('hapusPJNama').innerText = name;
    document.getElementById('hapusPJNip').innerText = `NIP. ${nip}`;

    const modal = new bootstrap.Modal(document.getElementById('modalHapusPJ'));
    modal.show();
  }
</script>
@endpush
