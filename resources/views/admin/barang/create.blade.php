@extends('layouts.admin')

@section('title', 'Form Tambah Barang')

@push('styles')
<style>
  /* Modal Overlay Background */
  .modal-overlay-bg {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(4px);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    overflow-y: auto;
  }
  .modal-custom-box {
    background: #ffffff;
    border-radius: 14px;
    width: 100%;
    max-width: 820px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 20, 60, 0.35);
  }
  .modal-custom-header {
    background: #002366;
    color: #ffffff;
    padding: 16px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .toggle-btn-pill {
    background: rgba(255, 255, 255, 0.14);
    padding: 3px;
    border-radius: 99px;
    display: flex;
  }
  .toggle-btn-pill button {
    border: none;
    background: transparent;
    color: #cbd5e1;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 14px;
    border-radius: 99px;
    cursor: pointer;
  }
  .toggle-btn-pill button.active {
    background: #ffffff;
    color: #002366;
    font-weight: 700;
  }
  .input-icon-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border: 1px solid #ebedf5;
    border-radius: 8px;
    padding: 0 12px;
    height: 40px;
    box-shadow: 0 1px 3px rgba(0, 32, 96, 0.05);
  }
  .input-icon-box input, .input-icon-box select {
    border: none;
    background: transparent;
    outline: none;
    width: 100%;
    font-size: 12.5px;
    color: #1a1c2c;
  }
  .condition-card {
    border-radius: 8px;
    padding: 10px 12px;
    display: flex;
    gap: 8px;
    align-items: flex-start;
    cursor: pointer;
    background: #f1f3fa;
    border: 1px solid transparent;
    transition: all 0.15s;
    height: 100%;
  }
  .condition-card.active {
    background: #e6fbf1;
    border-color: #0a7d5a;
  }
  .preview-asset-card {
    background: #eef2fe;
    border-radius: 10px;
    padding: 12px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
</style>
@endpush

@section('content')
<!-- Underlying Data Barang Preview for Background -->
<div style="filter: blur(2px); opacity: 0.85; pointer-events: none;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="fw-bold mb-1" style="font-size: 24px;">Data Inventaris Barang</h3>
      <p class="text-muted small mb-0">Manajemen aset sarana dan prasarana sekolah</p>
    </div>
    <a class="btn-navy-slicing" href="#"><span class="material-symbols-outlined fs-5">add_circle</span> Tambah Barang</a>
  </div>
  <div class="card-slicing p-5 text-center text-muted">Memuat daftar inventaris...</div>
</div>

<!-- Modal Form as Displayed in Mockup -->
<div class="modal-overlay-bg">
  <div class="modal-custom-box animate__animated animate__fadeInUp">
    <!-- Modal Header -->
    <div class="modal-custom-header">
      <div class="d-flex align-items-center gap-3">
        <div class="stat-icon-sq" style="width: 38px; height: 38px; background: rgba(255, 255, 255, 0.15); color: #fff; border-radius: 8px;">
          <span class="material-symbols-outlined fs-5">assignment_turned_in</span>
        </div>
        <div>
          <div class="d-flex align-items-center gap-2">
            <h5 class="fw-bold mb-0 text-white" style="font-size: 16px;">Tambah Barang Inventaris</h5>
            <span class="badge" style="background: #38bdf8; color: #002366; font-size: 9.5px; font-weight: 800; padding: 2px 7px;">FORM ASET</span>
          </div>
          <small class="opacity-75" style="font-size: 11px;">Penginputan sarana prasarana baru sekolah</small>
        </div>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="toggle-btn-pill d-none d-sm-flex">
          <button type="button" class="active">Tambah</button>
          <button type="button">Edit Demo</button>
        </div>
        <a href="{{ route('admin.barang') }}" class="text-white text-decoration-none" aria-label="Tutup">
          <span class="material-symbols-outlined fs-5">close</span>
        </a>
      </div>
    </div>

    <!-- Modal Body -->
    <form class="p-3 px-4" onsubmit="event.preventDefault(); location.href='{{ route('admin.barang') }}'">
      <div class="row g-3">
        <!-- Row 1: Kode & Nama -->
        <div class="col-12 col-md-5">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="fw-bold small mb-0 text-dark" style="font-size: 11.5px;">Kode Inventaris</label>
            <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 9.5px; font-weight: 700;">
              <span class="material-symbols-outlined fs-6 align-text-bottom">auto_awesome</span> Auto
            </span>
          </div>
          <div class="input-icon-box" style="background: #eef2fe;">
            <span class="material-symbols-outlined text-primary fs-5">barcode</span>
            <b class="font-monospace" style="color: #002366; font-size: 12.5px;">BRG-KOMP-015</b>
          </div>
          <small class="text-muted" style="font-size: 10.5px;">Nomor registrasi unik sistem inventaris</small>
        </div>

        <div class="col-12 col-md-7">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="fw-bold small mb-0 text-dark" style="font-size: 11.5px;">Nama Barang <span class="text-danger">*</span></label>
            <small class="text-muted" style="font-size: 10.5px;">Merk, seri &amp; model detail</small>
          </div>
          <div class="input-icon-box">
            <span class="material-symbols-outlined text-muted fs-5">devices</span>
            <input type="text" id="nm" value="Laptop ASUS ExpertBook B1400" required>
          </div>
        </div>

        <!-- Row 2: Kategori, Jumlah, Lokasi -->
        <div class="col-12 col-md-4">
          <label class="fw-bold small mb-1 text-dark" style="font-size: 11.5px;">Kategori Barang <span class="text-danger">*</span></label>
          <div class="input-icon-box">
            <span class="material-symbols-outlined text-muted fs-5">category</span>
            <select required>
              <option selected>Komputer</option>
              <option>Elektronik</option>
              <option>Furniture</option>
              <option>Peralatan Laboratorium</option>
            </select>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <label class="fw-bold small mb-1 text-dark" style="font-size: 11.5px;">Jumlah &amp; Satuan <span class="text-danger">*</span></label>
          <div class="d-flex gap-2">
            <div class="input-icon-box flex-grow-1">
              <span class="material-symbols-outlined text-muted fs-5">pin</span>
              <input type="number" id="qty" min="1" value="20" required>
            </div>
            <div class="input-icon-box" style="width: 85px;">
              <select>
                <option selected>Unit</option>
                <option>Set</option>
                <option>Buah</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <label class="fw-bold small mb-1 text-dark" style="font-size: 11.5px;">Lokasi / Ruangan Penempatan <span class="text-danger">*</span></label>
          <div class="input-icon-box">
            <span class="material-symbols-outlined text-muted fs-5">meeting_room</span>
            <select id="lk" required>
              <option selected>Lab RPL 1 (Lt. 2)</option>
              <option>Lab TKJ</option>
              <option>Ruang Guru</option>
            </select>
          </div>
        </div>

        <!-- Row 3: Kondisi Fisik Cards (Radio) -->
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="fw-bold small mb-0 text-dark" style="font-size: 11.5px;">Kondisi Fisik Saat Ini <span class="text-danger">*</span></label>
            <small class="text-muted" style="font-size: 10.5px;">Pilih status kelayakan barang inventaris</small>
          </div>
          <div class="row g-2">
            <div class="col-12 col-md-4">
              <label class="condition-card active">
                <input type="radio" class="form-check-input mt-1" name="cond" checked>
                <div>
                  <div class="fw-bold text-success" style="font-size: 12px;">Baik <span class="material-symbols-outlined fs-6 align-text-bottom">check_circle</span></div>
                  <small class="text-muted d-block" style="font-size: 10px; line-height: 1.3;">Siap digunakan secara normal dalam proses belajar</small>
                </div>
              </label>
            </div>
            <div class="col-12 col-md-4">
              <label class="condition-card">
                <input type="radio" class="form-check-input mt-1" name="cond">
                <div>
                  <div class="fw-bold text-warning" style="font-size: 12px;">Rusak Ringan <span class="material-symbols-outlined fs-6 align-text-bottom">build_circle</span></div>
                  <small class="text-muted d-block" style="font-size: 10px; line-height: 1.3;">Dapat beroperasi namun perlu perbaikan minor</small>
                </div>
              </label>
            </div>
            <div class="col-12 col-md-4">
              <label class="condition-card">
                <input type="radio" class="form-check-input mt-1" name="cond">
                <div>
                  <div class="fw-bold text-danger" style="font-size: 12px;">Rusak Berat <span class="material-symbols-outlined fs-6 align-text-bottom">cancel</span></div>
                  <small class="text-muted d-block" style="font-size: 10px; line-height: 1.3;">Tidak dapat menyala / tidak layak pakai</small>
                </div>
              </label>
            </div>
          </div>
        </div>

        <!-- Row 4: Catatan & Preview -->
        <div class="col-12 col-md-8">
          <label class="fw-bold small mb-1 text-dark" style="font-size: 11.5px;">Keterangan / Catatan Pengadaan</label>
          <textarea class="form-control" rows="3" style="font-size: 12px; border-color: #ebedf5; border-radius: 8px;">Pengadaan BOS TA 2024/2025, garansi resmi Asus Indonesia 2 tahun per November 2024</textarea>
          <div class="d-flex justify-content-between text-muted mt-1" style="font-size: 10.5px;">
            <span>Sertakan nomor referensi dokumen pengadaan jika tersedia.</span>
            <span>78 karakter</span>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="preview-asset-card p-2 rounded-3 border bg-light">
            <div>
              <div class="d-flex align-items-center gap-1 text-primary fw-bold" style="font-size: 11px;">
                <span class="material-symbols-outlined fs-6">image</span> PRATINJAU FOTO ASET
              </div>
              <div class="rounded-2 my-2 position-relative overflow-hidden" style="height: 75px;">
                <img src="{{ asset('images/laptop-preview.png') }}" alt="ASUS ExpertBook" class="w-100 h-100 object-fit-cover rounded-2" onerror="this.outerHTML='<div class=\'w-100 h-100 bg-primary text-white d-grid place-items-center\'><span class=\'material-symbols-outlined fs-2\'>laptop_mac</span></div>'">
                <span class="badge position-absolute" style="right: 6px; bottom: 6px; background: #002366; font-size: 10px;">20 Pcs</span>
              </div>
              <small class="fw-bold text-dark d-block text-truncate" style="font-size: 11px;">ASUS ExpertBook B1400 (Lab RPL 1)</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mt-3 pt-3 border-top">
        <div class="text-muted small d-flex align-items-center gap-1" style="font-size: 11px;">
          <span class="material-symbols-outlined text-primary fs-6">verified_user</span>
          Data akan langsung tersimpan ke database inventaris <b>sekolah</b>.
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.barang') }}" class="btn btn-sm btn-light border px-3" style="font-weight: 600; font-size: 12px;">Batal</a>
          <button type="submit" class="btn-navy-slicing">
            <span class="material-symbols-outlined fs-6">save</span> Simpan Data Barang
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
