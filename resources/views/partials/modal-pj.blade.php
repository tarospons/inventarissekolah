<!-- ========================================================
     MODAL: TAMBAH PENANGGUNG JAWAB BARU
     ======================================================== -->
<div class="modal fade" id="modalTambahPJ" tabindex="-1" aria-labelledby="modalTambahPJLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">person_add</span>
          <h5 class="modal-title fs-6 fw-bold mb-0" id="modalTambahPJLabel">Tambah Penanggung Jawab Baru</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="formTambahPJ" onsubmit="event.preventDefault(); submitTambahPJ();">
          <div class="row g-3">
            <!-- Left: Foto Profil Upload & Preview -->
            <div class="col-12 col-md-4 text-center border-end-md pb-3 pb-md-0">
              <label class="form-label small fw-bold text-muted d-block text-start mb-2">FOTO PROFIL</label>
              <div class="position-relative d-inline-block my-2">
                <img id="previewFotoTambah" src="https://ui-avatars.com/api/?name=Baru&background=002060&color=fff&size=120" alt="Preview Foto" class="avatar-pj-lg">
                <label for="inputFotoTambahFile" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-1 d-grid place-items-center shadow" style="width: 32px; height: 32px; cursor: pointer;" title="Unggah Foto">
                  <span class="material-symbols-outlined fs-6">photo_camera</span>
                </label>
              </div>
              <input type="file" id="inputFotoTambahFile" class="d-none" accept="image/*" onchange="previewUploadFoto(this, 'previewFotoTambah')">
              <small class="text-muted d-block mt-2" style="font-size: 11px;">Format JPG/PNG, maks. 2MB. Preview tampil instan.</small>
            </div>

            <!-- Right: Field Data -->
            <div class="col-12 col-md-8">
              <div class="row g-2">
                <div class="col-12">
                  <label class="form-label small fw-bold text-muted mb-1">NAMA LENGKAP &amp; GELAR <span class="text-danger">*</span></label>
                  <input type="text" id="tambahNama" class="form-control" placeholder="Contoh: Ir. Muhammad Ridwan, S.Kom." required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NIP / NUPTK <span class="text-danger">*</span></label>
                  <input type="text" id="tambahNIP" class="form-control font-monospace" placeholder="19870101 201201 1 003" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JABATAN / PERAN <span class="text-danger">*</span></label>
                  <input type="text" id="tambahJabatan" class="form-control" placeholder="Kepala Lab / Teknisi..." required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">LAB / RUANGAN (1 PJ PER LAB) <span class="text-danger">*</span></label>
                  <select id="tambahLab" class="form-select" required>
                    <option value="">-- Pilih Laboratorium / Ruangan --</option>
                    <option value="Lab RPL 2">Lab RPL 2 (Gedung Praktik Lt. 2)</option>
                    <option value="Lab TKJ 2">Lab TKJ 2 (Gedung Praktik Lt. 1)</option>
                    <option value="Studio DKV 2">Studio DKV 2 (Gedung Praktik Lt. 2)</option>
                    <option value="Bengkel Pengelasan & Mesin">Bengkel Pengelasan &amp; Mesin</option>
                    <option value="Lab Bahasa Digital">Lab Bahasa Digital (Gedung Utama Lt. 2)</option>
                    <option value="Lab Komputer CBT">Lab Komputer CBT (Gedung Utama Lt. 2)</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">JURUSAN / KEAHLIAN <span class="text-danger">*</span></label>
                  <select id="tambahJurusan" class="form-select" required>
                    <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                    <option value="TKJ">TKJ (Teknik Komputer &amp; Jaringan)</option>
                    <option value="DKV">DKV (Desain Komunikasi Visual)</option>
                    <option value="TEI">TEI (Teknik Elektronika Industri)</option>
                    <option value="TKRO">TKRO (Teknik Otomotif)</option>
                    <option value="Umum">Umum / Sarana Pendukung</option>
                  </select>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">NOMOR WHATSAPP / HP <span class="text-danger">*</span></label>
                  <input type="text" id="tambahKontak" class="form-control" placeholder="0812-xxxx-xxxx" required>
                </div>
                <div class="col-12 col-sm-6">
                  <label class="form-label small fw-bold text-muted mb-1">EMAIL RESMI SEKOLAH</label>
                  <input type="email" id="tambahEmail" class="form-control" placeholder="nama@sekolah.sch.id">
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn-navy-slicing">
              <span class="material-symbols-outlined fs-5">save</span>
              Simpan Penanggung Jawab
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL: EDIT PENANGGUNG JAWAB
     ======================================================== -->
<div class="modal fade" id="modalEditPJ" tabindex="-1" aria-labelledby="modalEditPJLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">edit</span>
          <h5 class="modal-title fs-6 fw-bold mb-0" id="modalEditPJLabel">Edit Data Penanggung Jawab</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="formEditPJ" onsubmit="event.preventDefault(); submitEditPJ();">
          <input type="hidden" id="editPJId">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label small fw-bold text-muted mb-1">NAMA LENGKAP &amp; GELAR <span class="text-danger">*</span></label>
              <input type="text" id="editNama" class="form-control" required>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">NIP / NUPTK <span class="text-danger">*</span></label>
              <input type="text" id="editNIP" class="form-control font-monospace" required>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">JABATAN / PERAN <span class="text-danger">*</span></label>
              <input type="text" id="editJabatan" class="form-control" required>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">LAB / RUANGAN (1 PJ PER LAB) <span class="text-danger">*</span></label>
              <input type="text" id="editLab" class="form-control" required>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">JURUSAN <span class="text-danger">*</span></label>
              <select id="editJurusan" class="form-select" required>
                <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                <option value="TKJ">TKJ (Teknik Komputer &amp; Jaringan)</option>
                <option value="DKV">DKV (Desain Komunikasi Visual)</option>
                <option value="TEI">TEI (Teknik Elektronika)</option>
                <option value="TKRO">TKRO (Teknik Otomotif)</option>
                <option value="Umum">Umum / Non-Kejuruan</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">NOMOR KONTAK / WHATSAPP <span class="text-danger">*</span></label>
              <input type="text" id="editKontak" class="form-control" required>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">EMAIL RESMI</label>
              <input type="email" id="editEmail" class="form-control">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn-navy-slicing">
              <span class="material-symbols-outlined fs-5">check</span>
              Perbarui Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL: UBAH FOTO PROFIL PENANGGUNG JAWAB (KHUSUS)
     ======================================================== -->
<div class="modal fade" id="modalGantiFotoPJ" tabindex="-1" aria-labelledby="modalGantiFotoPJLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">photo_camera</span>
          <h5 class="modal-title fs-6 fw-bold mb-0" id="modalGantiFotoPJLabel">Ubah Foto Profil Penanggung Jawab</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <input type="hidden" id="gantiFotoPJId">
        <h6 id="gantiFotoPJNama" class="fw-bold mb-3 text-dark">Nama Penanggung Jawab</h6>

        <div class="position-relative d-inline-block mb-3">
          <img id="previewGantiFoto" src="https://ui-avatars.com/api/?name=User&background=002060&color=fff&size=120" alt="Preview" class="avatar-pj-lg">
        </div>

        <div class="mb-3">
          <label for="inputUploadFotoProfil" class="btn btn-sm btn-outline-primary px-3 py-2 d-inline-flex align-items-center gap-2">
            <span class="material-symbols-outlined fs-5">file_upload</span>
            <span>Pilih File Foto Baru...</span>
          </label>
          <input type="file" id="inputUploadFotoProfil" class="d-none" accept="image/*" onchange="previewUploadFoto(this, 'previewGantiFoto')">
        </div>

        <div class="p-2 px-3 rounded-2 bg-light border text-start mb-3">
          <small class="text-muted d-block fw-bold mb-1" style="font-size: 11px;">PILIHAN WARNA AVATAR INISIAL CEPAT:</small>
          <div class="d-flex gap-2">
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #1e3a8a;" onclick="pilihWarnaAvatar('#1e3a8a')" title="Biru Navy"></button>
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #0284c7;" onclick="pilihWarnaAvatar('#0284c7')" title="Biru Muda"></button>
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #0d9488;" onclick="pilihWarnaAvatar('#0d9488')" title="Teal"></button>
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #7c3aed;" onclick="pilihWarnaAvatar('#7c3aed')" title="Ungu"></button>
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #ea580c;" onclick="pilihWarnaAvatar('#ea580c')" title="Oranye"></button>
            <button type="button" class="btn btn-sm rounded-circle p-0" style="width: 26px; height: 26px; background: #16a34a;" onclick="pilihWarnaAvatar('#16a34a')" title="Hijau"></button>
          </div>
        </div>

        <small class="text-muted d-block" style="font-size: 11px;">Foto otomatis tersinkronisasi pada data ruangan dan laporan sarpras.</small>
      </div>
      <div class="modal-footer bg-light d-flex justify-content-end py-2 px-3">
        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-sm btn-navy-slicing px-3" onclick="submitGantiFotoPJ()">Simpan Foto Profil</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     MODAL: HAPUS PENANGGUNG JAWAB
     ======================================================== -->
<div class="modal fade" id="modalHapusPJ" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow">
      <div class="modal-body p-4 text-center">
        <input type="hidden" id="hapusPJId">
        <div class="stat-icon-sq mx-auto mb-3" style="width: 52px; height: 52px; background: #fee2e2; color: #dc2626; border-radius: 50%;">
          <span class="material-symbols-outlined fs-2">delete_forever</span>
        </div>
        <h6 class="fw-bold mb-1 text-dark">Hapus Penanggung Jawab?</h6>
        <p class="text-muted small mb-3">Data penanggung jawab <b id="hapusPJNama" class="text-danger">PJ</b> akan dihapus dari sistem inventaris.</p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-sm btn-danger px-3" onclick="submitHapusPJ()">Ya, Hapus</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast Success -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
  <div id="toastSuccess" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body d-flex align-items-center gap-2" id="toastMessage">
        <span class="material-symbols-outlined text-success">check_circle</span>
        <span>Aksi berhasil disimpan!</span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<!-- JavaScript Logic for Penanggung Jawab Module -->
<script>
  function showToast(message) {
    document.getElementById('toastMessage').innerHTML = `<span class="material-symbols-outlined text-success">check_circle</span><span>${message}</span>`;
    const toastEl = document.getElementById('toastSuccess');
    if (toastEl) bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 3500 }).show();
  }

  function filterPJTable() {
    const searchVal = document.getElementById('inputSearchPJ').value.toLowerCase().trim();
    const jurusanVal = document.getElementById('filterJurusanPJ').value;
    const rows = document.querySelectorAll('#tbodyPJ tr');
    let visibleCount = 0;

    rows.forEach(row => {
      const nama = (row.getAttribute('data-nama') || '').toLowerCase();
      const nip = (row.getAttribute('data-nip') || '').toLowerCase();
      const lab = (row.getAttribute('data-lab') || '').toLowerCase();
      const jabatan = (row.getAttribute('data-jabatan') || '').toLowerCase();
      const rowJur = row.getAttribute('data-jurusan') || '';

      const matchSearch = !searchVal || (nama.includes(searchVal) || nip.includes(searchVal) || lab.includes(searchVal) || jabatan.includes(searchVal));
      const matchJur = !jurusanVal || (rowJur === jurusanVal);

      if (matchSearch && matchJur) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    document.getElementById('countPJ').innerText = visibleCount;
    document.getElementById('emptySearchPJ').classList.toggle('d-none', visibleCount > 0);
  }

  function resetSearchPJ() {
    document.getElementById('inputSearchPJ').value = '';
    document.getElementById('filterJurusanPJ').value = '';
    document.getElementById('sortPJ').value = 'default';
    filterPJTable();
  }

  function sortPJTable() {
    const sortVal = document.getElementById('sortPJ').value;
    const tbody = document.getElementById('tbodyPJ');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    if (sortVal === 'nama-asc') {
      rows.sort((a, b) => a.getAttribute('data-nama').localeCompare(b.getAttribute('data-nama')));
    } else if (sortVal === 'nama-desc') {
      rows.sort((a, b) => b.getAttribute('data-nama').localeCompare(a.getAttribute('data-nama')));
    } else if (sortVal === 'lab') {
      rows.sort((a, b) => a.getAttribute('data-lab').localeCompare(b.getAttribute('data-lab')));
    } else {
      rows.sort((a, b) => parseInt(a.getAttribute('data-id')) - parseInt(b.getAttribute('data-id')));
    }
    rows.forEach(r => tbody.appendChild(r));
  }

  let currentCustomImageSrc = null;
  function previewUploadFoto(input, targetImgId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById(targetImgId).src = e.target.result;
        currentCustomImageSrc = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function pilihWarnaAvatar(colorHex) {
    const nama = encodeURIComponent(document.getElementById('gantiFotoPJNama').innerText);
    const bg = colorHex.replace('#', '');
    const url = `https://ui-avatars.com/api/?name=${nama}&background=${bg}&color=fff&size=120`;
    document.getElementById('previewGantiFoto').src = url;
    currentCustomImageSrc = url;
  }

  function openModalGantiFoto(id, nama) {
    document.getElementById('gantiFotoPJId').value = id;
    document.getElementById('gantiFotoPJNama').innerText = nama;
    const avatarContainer = document.getElementById('avatarImg-' + id);
    if (avatarContainer && avatarContainer.tagName === 'IMG') {
      document.getElementById('previewGantiFoto').src = avatarContainer.src;
      currentCustomImageSrc = avatarContainer.src;
    } else {
      const url = `https://ui-avatars.com/api/?name=${encodeURIComponent(nama)}&background=002060&color=fff&size=120`;
      document.getElementById('previewGantiFoto').src = url;
      currentCustomImageSrc = url;
    }
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalGantiFotoPJ')).show();
  }

  function submitGantiFotoPJ() {
    const id = document.getElementById('gantiFotoPJId').value;
    const avatarEl = document.getElementById('avatarImg-' + id);
    const nama = document.getElementById('gantiFotoPJNama').innerText;

    if (avatarEl && currentCustomImageSrc) {
      if (avatarEl.tagName === 'IMG') {
        avatarEl.src = currentCustomImageSrc;
      } else {
        const img = document.createElement('img');
        img.id = 'avatarImg-' + id;
        img.className = 'avatar-pj-sm';
        img.src = currentCustomImageSrc;
        img.alt = nama;
        avatarEl.parentNode.replaceChild(img, avatarEl);
      }
    }
    bootstrap.Modal.getInstance(document.getElementById('modalGantiFotoPJ')).hide();
    showToast(`Foto profil ${nama} berhasil diperbarui!`);
  }

  function openModalEditPJ(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) return;

    document.getElementById('editPJId').value = id;
    document.getElementById('editNama').value = row.getAttribute('data-nama');
    document.getElementById('editNIP').value = row.getAttribute('data-nip');
    document.getElementById('editJabatan').value = row.getAttribute('data-jabatan');
    document.getElementById('editLab').value = row.getAttribute('data-lab');
    document.getElementById('editJurusan').value = row.getAttribute('data-jurusan');
    document.getElementById('editKontak').value = row.getAttribute('data-kontak');
    document.getElementById('editEmail').value = row.getAttribute('data-email');
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditPJ')).show();
  }

  function submitEditPJ() {
    const id = document.getElementById('editPJId').value;
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) return;

    const fields = ['Nama', 'NIP', 'Jabatan', 'Lab', 'Jurusan', 'Kontak', 'Email'];
    fields.forEach(f => row.setAttribute('data-' + f.toLowerCase(), document.getElementById('edit' + f).value));

    row.querySelector('.pj-nama').innerText = document.getElementById('editNama').value;
    row.querySelector('.pj-nip').innerText = 'NIP. ' + document.getElementById('editNIP').value;
    row.querySelector('.pj-jabatan').innerText = document.getElementById('editJabatan').value;
    row.querySelector('.pj-lab').innerText = document.getElementById('editLab').value;
    row.querySelector('.pj-kontak').innerHTML = `<span class="material-symbols-outlined fs-6 text-success align-text-bottom">call</span> ${document.getElementById('editKontak').value}`;
    row.querySelector('.pj-email').innerText = document.getElementById('editEmail').value;

    bootstrap.Modal.getInstance(document.getElementById('modalEditPJ')).hide();
    showToast(`Data ${document.getElementById('editNama').value} berhasil diperbarui!`);
  }

  function openModalHapusPJ(id, nama) {
    document.getElementById('hapusPJId').value = id;
    document.getElementById('hapusPJNama').innerText = nama;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalHapusPJ')).show();
  }

  function submitHapusPJ() {
    const id = document.getElementById('hapusPJId').value;
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const nama = document.getElementById('hapusPJNama').innerText;
    if (row) {
      row.remove();
      filterPJTable();
    }
    bootstrap.Modal.getInstance(document.getElementById('modalHapusPJ')).hide();
    showToast(`Data penanggung jawab ${nama} telah dihapus.`);
  }

  function submitTambahPJ() {
    const nama = document.getElementById('tambahNama').value;
    const nip = document.getElementById('tambahNIP').value;
    const jabatan = document.getElementById('tambahJabatan').value;
    const lab = document.getElementById('tambahLab').value;
    const jurusan = document.getElementById('tambahJurusan').value;
    const kontak = document.getElementById('tambahKontak').value;
    const email = document.getElementById('tambahEmail').value || `${nama.toLowerCase().replace(/[^a-z]/g, '.')}@sekolah.sch.id`;
    const photoSrc = document.getElementById('previewFotoTambah').src;

    const tbody = document.getElementById('tbodyPJ');
    const newId = Date.now();
    const count = tbody.querySelectorAll('tr').length + 1;
    const noStr = count < 10 ? '0' + count : count;

    const tr = document.createElement('tr');
    tr.setAttribute('data-id', newId);
    tr.setAttribute('data-nama', nama);
    tr.setAttribute('data-nip', nip);
    tr.setAttribute('data-lab', lab);
    tr.setAttribute('data-jurusan', jurusan);
    tr.setAttribute('data-jabatan', jabatan);
    tr.setAttribute('data-kontak', kontak);
    tr.setAttribute('data-email', email);

    tr.innerHTML = `
      <td class="ps-4 text-muted fw-semibold">${noStr}</td>
      <td>
        <div class="d-flex align-items-center gap-3">
          <div class="position-relative">
            <img id="avatarImg-${newId}" src="${photoSrc}" alt="${nama}" class="avatar-pj-sm">
            <button type="button" class="btn-action-icon btn-action-photo position-absolute" style="width: 20px; height: 20px; bottom: -4px; right: -4px; border-radius: 50%; box-shadow: 0 1px 3px rgba(0,0,0,0.2);" title="Ganti Foto Profil" onclick="openModalGantiFoto(${newId}, '${nama}')">
              <span class="material-symbols-outlined" style="font-size: 11px;">photo_camera</span>
            </button>
          </div>
          <div>
            <b class="text-dark pj-nama" style="font-size: 13px;">${nama}</b>
            <div class="text-muted small font-monospace pj-nip" style="font-size: 11px;">NIP. ${nip}</div>
          </div>
        </div>
      </td>
      <td><span class="fw-semibold text-dark pj-jabatan">${jabatan}</span></td>
      <td>
        <span class="badge" style="background: #e0edff; color: #002366; font-size: 11px; padding: 4px 8px;">
          <span class="material-symbols-outlined fs-6 align-text-bottom">domain</span> <span class="pj-lab">${lab}</span>
        </span>
      </td>
      <td><span class="badge" style="background: #e0e7ff; color: #1e3a8a; font-size: 10.5px; font-weight: 700;">${jurusan}</span></td>
      <td>
        <div class="small text-dark fw-semibold pj-kontak"><span class="material-symbols-outlined fs-6 text-success align-text-bottom">call</span> ${kontak}</div>
        <div class="text-muted small pj-email" style="font-size: 10.5px;">${email}</div>
      </td>
      <td class="text-center"><span class="badge-status badge-status-baik">● Aktif</span></td>
      <td class="pe-4 text-end col-actions-3">
        <div class="table-actions">
          <button type="button" class="btn-action-icon btn-action-photo" title="Ubah Foto Profil" onclick="openModalGantiFoto(${newId}, '${nama}')"><span class="material-symbols-outlined fs-6">photo_camera</span></button>
          <button type="button" class="btn-action-icon btn-action-edit" title="Ubah Data PJ" onclick="openModalEditPJ(${newId})"><span class="material-symbols-outlined fs-6">edit</span></button>
          <button type="button" class="btn-action-icon btn-action-del" title="Hapus" onclick="openModalHapusPJ(${newId}, '${nama}')"><span class="material-symbols-outlined fs-6">delete</span></button>
        </div>
      </td>
    `;

    tbody.appendChild(tr);
    bootstrap.Modal.getInstance(document.getElementById('modalTambahPJ')).hide();
    document.getElementById('formTambahPJ').reset();
    document.getElementById('previewFotoTambah').src = 'https://ui-avatars.com/api/?name=Baru&background=002060&color=fff&size=120';
    filterPJTable();
    showToast(`Penanggung jawab baru ${nama} berhasil ditambahkan!`);
  }
</script>
