<!-- Modal Ganti Foto Profil (Semua Role: Admin, Kepsek, PJ) -->
<div class="modal fade" id="modalGantiFotoProfil" tabindex="-1" aria-labelledby="modalGantiFotoProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">account_circle</span>
          <h5 class="modal-title fs-6 fw-bold mb-0" id="modalGantiFotoProfilLabel">Ubah Foto Profil</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('profile.foto') }}" method="POST" enctype="multipart/form-data" id="formGantiFoto">
        @csrf
        <div class="modal-body text-center p-4">
          <!-- Preview Foto -->
          <div class="position-relative d-inline-block mb-3" style="cursor: pointer;" onclick="document.getElementById('inputFotoProfil').click()" title="Klik untuk pilih foto">
            <img id="previewFotoProfil" src="{{ auth()->user()?->foto_url }}" 
                 alt="Foto Profil" class="rounded-circle shadow-sm border border-3 border-white" 
                 style="width: 100px; height: 100px; object-fit: cover;">
            <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-grid place-items-center shadow" 
                 style="width: 32px; height: 32px;" title="Pilih Foto Baru">
              <span class="material-symbols-outlined fs-6">photo_camera</span>
            </div>
          </div>

          <h6 class="fw-bold text-dark mb-0 fs-6">{{ auth()->user()?->name ?? 'Pengguna' }}</h6>
          <small class="text-muted d-block mb-2 font-monospace" style="font-size: 11px;">
            {{ auth()->user()?->nip ? 'NIP. ' . auth()->user()->nip : (auth()->user()?->email ?? '') }}
          </small>
          <span class="badge mb-3" style="background: #e0edff; color: #002366; font-size: 10px;">
            {{ auth()->user()?->jabatan ?? strtoupper(auth()->user()?->role ?? 'USER') }}
          </span>

          <!-- Visible File Input for 100% clarity -->
          <div class="text-start mb-2">
            <label class="form-label small fw-bold text-muted mb-1" style="font-size: 11px;">PILIH FILE FOTO BARU:</label>
            <input type="file" name="foto" id="inputFotoProfil" class="form-control form-control-sm" accept="image/jpeg,image/png,image/jpg,image/webp" required onchange="previewUploadFoto(this)">
          </div>

          <div class="p-2 bg-light rounded-2 border text-start">
            <small class="text-muted d-block" style="font-size: 10px; line-height: 1.45;">
              <span class="text-primary fw-bold">&bull; Format:</span> JPG, PNG, atau WebP.<br>
              <span class="text-primary fw-bold">&bull; Maksimal:</span> Ukuran file <b>3 MB</b>.<br>
              <span class="text-primary fw-bold">&bull; Preview:</span> Langsung terlihat sebelum disimpan.
            </small>
          </div>
        </div>
        <div class="modal-footer bg-light p-2 px-3 d-flex justify-content-between">
          <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-navy-slicing py-1 px-3" id="btnSimpanFoto">
            <span class="material-symbols-outlined fs-6">save</span> Simpan Foto
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function previewUploadFoto(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const maxMb = 3;
      if (file.size > maxMb * 1024 * 1024) {
        alert(`Ukuran foto (${(file.size / (1024*1024)).toFixed(2)} MB) melebihi batas maksimal ${maxMb} MB! Silakan pilih foto lain.`);
        input.value = '';
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewFotoProfil').src = e.target.result;
        const btn = document.getElementById('btnSimpanFoto');
        if (btn) btn.disabled = false;
      };
      reader.readAsDataURL(file);
    }
  }
</script>
