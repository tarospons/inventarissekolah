<!-- Searchable Penanggung Jawab Picker Component (Clean Code) -->
<div class="pj-picker-wrapper mb-3">
  <label class="form-label small fw-bold text-muted mb-2">PENANGGUNG JAWAB (PJ)</label>

  <!-- Outer Rounded Box matching screenshot -->
  <div class="pj-picker-card">
    <div class="d-flex justify-content-between align-items-center mb-2 px-1">
      <span class="fw-bold text-dark" style="font-size: 13px;">Pilih Penanggung Jawab</span>
      <a href="javascript:void(0)" class="text-primary text-decoration-none fw-semibold" style="font-size: 11.5px;" onclick="resetPJPicker()">Reset</a>
    </div>

    <!-- Search Input with Magnifier Icon -->
    <div class="position-relative mb-2">
      <span class="material-symbols-outlined position-absolute" style="left: 11px; top: 9px; color: #94a3b8; font-size: 18px;">search</span>
      <input type="text" id="searchPJPickerInput" class="form-control pj-search-input" placeholder="Cari penanggung jawab...." oninput="filterPJPickerList(this.value)">
    </div>

    <!-- Hidden Input for Form Submission -->
    <input type="hidden" name="penanggung_jawab" id="selectedPJValue" value="">

    <!-- Scrollable PJ List -->
    <div class="pj-picker-list" id="pjPickerList">
      @php
        $pickerList = [
          ['id' => 1, 'nama' => 'Ahmad Fauzi, S.Kom.', 'jabatan' => 'Kepala Lab RPL (Software)', 'nip' => '19840312 200902 1 004', 'bg' => '#1e3a8a', 'initial' => 'AF'],
          ['id' => 2, 'nama' => 'Joko Prasetyo, S.T.', 'jabatan' => 'Kepala Bengkel TP (Pengelasan)', 'nip' => '19820514 200801 1 010', 'bg' => '#ea580c', 'initial' => 'JP'],
          ['id' => 3, 'nama' => 'Ir. Wahyu Hidayat, S.T.', 'jabatan' => 'Kepala Bengkel GP (Geologi Pertambangan)', 'nip' => '19790822 200604 1 008', 'bg' => '#b45309', 'initial' => 'WH'],
          ['id' => 4, 'nama' => 'Chef Maya Anggraini, S.Pd.', 'jabatan' => 'Kepala Dapur KL (Kuliner / Tata Boga)', 'nip' => '19881115 201402 2 006', 'bg' => '#be185d', 'initial' => 'MA'],
          ['id' => 5, 'nama' => 'Rina Kusuma, S.ST.Par.', 'jabatan' => 'Manajer Hotel PH (Perhotelan / Edotel)', 'nip' => '19860410 201001 2 018', 'bg' => '#0284c7', 'initial' => 'RK'],
          ['id' => 6, 'nama' => 'Drh. Tri Wibowo, S.Pt.', 'jabatan' => 'Kepala Kandang ATR (Ternak Ruminansia)', 'nip' => '19810319 200701 1 011', 'bg' => '#15803d', 'initial' => 'TW'],
          ['id' => 7, 'nama' => 'Siti Rahmawati, S.Pd.', 'jabatan' => 'Koordinator Ruang Guru', 'nip' => '19790514 200501 2 008', 'bg' => '#4338ca', 'initial' => 'SR'],
          ['id' => 8, 'nama' => 'Lestari Wahyuni, S.I.Pust.', 'jabatan' => 'Kepala Perpustakaan Sekolah', 'nip' => '19861105 201101 2 015', 'bg' => '#ca8a04', 'initial' => 'LW'],
          ['id' => 9, 'nama' => 'Bambang Nugroho, S.AP.', 'jabatan' => 'Kepala Urusan Tata Usaha', 'nip' => '19820710 200801 1 011', 'bg' => '#475569', 'initial' => 'BN'],
          ['id' => 10, 'nama' => 'Budi Kurniawan, S.Pd.', 'jabatan' => 'Wali Kelas X RPL (Ruang Kelas)', 'nip' => '19900214 201701 1 005', 'bg' => '#2563eb', 'initial' => 'BK'],
          ['id' => 11, 'nama' => 'Anisa Dian, S.Kom.', 'jabatan' => 'Wali Kelas XI RPL (Ruang Kelas)', 'nip' => '19920820 201903 2 012', 'bg' => '#3b82f6', 'initial' => 'AD'],
          ['id' => 12, 'nama' => 'Hendro Sugiarto, M.Kom.', 'jabatan' => 'Wali Kelas XII RPL (Ruang Kelas)', 'nip' => '19850611 201001 1 019', 'bg' => '#1d4ed8', 'initial' => 'HS'],
          ['id' => 13, 'nama' => 'Danang Wijaya, S.Pd.', 'jabatan' => 'Wali Kelas X TP (Ruang Kelas)', 'nip' => '19880719 201502 1 007', 'bg' => '#c2410c', 'initial' => 'DW'],
          ['id' => 14, 'nama' => 'Eko Prasetya, S.T.', 'jabatan' => 'Wali Kelas X GP (Ruang Kelas)', 'nip' => '19870425 201401 1 008', 'bg' => '#9a3412', 'initial' => 'EP'],
          ['id' => 15, 'nama' => 'Dewi Sartika, S.Pd.', 'jabatan' => 'Wali Kelas X KL (Ruang Kelas)', 'nip' => '19910118 201802 2 004', 'bg' => '#9d174d', 'initial' => 'DS'],
          ['id' => 16, 'nama' => 'Dian Novita, S.Pd.', 'jabatan' => 'Wali Kelas X PH (Ruang Kelas)', 'nip' => '19901205 201601 2 009', 'bg' => '#0369a1', 'initial' => 'DN'],
          ['id' => 17, 'nama' => 'Agung Santoso, S.Pt.', 'jabatan' => 'Wali Kelas X ATR (Ruang Kelas)', 'nip' => '19890912 201503 1 003', 'bg' => '#166534', 'initial' => 'AS'],
        ];
      @endphp

      @foreach($pickerList as $p)
      <div class="pj-picker-item d-flex align-items-center gap-2 p-2 rounded-2" data-nama="{{ $p['nama'] }}" data-jabatan="{{ $p['jabatan'] }}" data-nip="{{ $p['nip'] }}" onclick="selectPJPickerItem(this, '{{ $p['nama'] }}')">
        <input type="radio" name="radioPJSelect" class="form-check-input mt-0 pj-checkbox" id="pjRadio{{ $p['id'] }}">
        <div class="avatar-placeholder-sm" style="background: {{ $p['bg'] }}; color: #fff; width: 32px; height: 32px; font-size: 11px; flex-shrink: 0;">{{ $p['initial'] }}</div>
        <div class="flex-grow-1 text-truncate">
          <div class="fw-bold text-dark pj-item-name" style="font-size: 12.5px;">{{ $p['nama'] }}</div>
          <small class="text-muted d-block pj-item-role" style="font-size: 10.5px;">{{ $p['jabatan'] }} &bull; NIP. {{ $p['nip'] }}</small>
        </div>
      </div>
      @endforeach

      <!-- Empty Search State -->
      <div id="pjPickerEmpty" class="text-center p-3 text-muted small d-none">
        <span class="material-symbols-outlined fs-5 d-block text-secondary mb-1">person_search</span>
        <span>Penanggung jawab tidak ditemukan</span>
      </div>
    </div>
  </div>
  <small class="text-muted d-block mt-1" style="font-size: 11px;">1 Penanggung Jawab untuk setiap laboratorium / ruangan kejuruan.</small>
</div>

<script>
  function filterPJPickerList(keyword) {
    const term = (keyword || '').toLowerCase().trim();
    const items = document.querySelectorAll('#pjPickerList .pj-picker-item');
    let visibleCount = 0;

    items.forEach(item => {
      const nama = (item.getAttribute('data-nama') || '').toLowerCase();
      const jabatan = (item.getAttribute('data-jabatan') || '').toLowerCase();
      const nip = (item.getAttribute('data-nip') || '').toLowerCase();

      if (!term || nama.includes(term) || jabatan.includes(term) || nip.includes(term)) {
        item.style.display = 'flex';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });

    const emptyEl = document.getElementById('pjPickerEmpty');
    if (emptyEl) {
      emptyEl.classList.toggle('d-none', visibleCount > 0);
    }
  }

  function selectPJPickerItem(element, nama) {
    document.querySelectorAll('#pjPickerList .pj-picker-item').forEach(it => {
      it.classList.remove('selected');
      const radio = it.querySelector('input[type="radio"]');
      if (radio) radio.checked = false;
    });

    element.classList.add('selected');
    const targetRadio = element.querySelector('input[type="radio"]');
    if (targetRadio) targetRadio.checked = true;

    const hiddenInput = document.getElementById('selectedPJValue');
    if (hiddenInput) hiddenInput.value = nama;
  }

  function resetPJPicker() {
    document.querySelectorAll('#pjPickerList .pj-picker-item').forEach(it => {
      it.classList.remove('selected');
      const radio = it.querySelector('input[type="radio"]');
      if (radio) radio.checked = false;
      it.style.display = 'flex';
    });
    const searchInput = document.getElementById('searchPJPickerInput');
    if (searchInput) searchInput.value = '';
    const hiddenInput = document.getElementById('selectedPJValue');
    if (hiddenInput) hiddenInput.value = '';
    const emptyEl = document.getElementById('pjPickerEmpty');
    if (emptyEl) emptyEl.classList.add('d-none');
  }
</script>
