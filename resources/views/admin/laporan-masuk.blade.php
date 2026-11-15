@extends('layouts.admin')

@section('title', 'Laporan Masuk dari Penanggung Jawab')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
  <div>
    <div class="page-breadcrumb">
      <span>Home</span>
      <span>/</span>
      <span>Inventaris Sekolah</span>
      <span>/</span>
      <b class="active-crumb">Laporan Masuk</b>
    </div>
    <h1 class="page-title">Laporan Masuk dari Penanggung Jawab</h1>
    <p class="page-subtitle">Verifikasi dan tindak lanjuti laporan kerusakan, kehilangan, dan usulan barang dari seluruh PJ Lab &amp; Ruangan.</p>
  </div>
  <div class="d-flex gap-2">
    <span class="badge d-flex align-items-center gap-1" style="background: #e0edff; color: #002366; font-size: 12px; font-weight: 700; padding: 6px 14px;">
      <span class="material-symbols-outlined fs-6 text-primary">mark_email_unread</span>
      <span>{{ $totalLaporan ?? count($laporans ?? []) }} Total Pengaduan Masuk</span>
    </span>
  </div>
</div>

<!-- 3 Stat Mini Cards -->
<div class="row g-3">
  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">MENUNGGU VERIFIKASI</span>
          <div class="stat-box-num" style="color: #b45309;">{{ $menungguCount ?? 0 }} <small style="color: #b45309;">Laporan</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #fef3c7; color: #b45309;">
          <span class="material-symbols-outlined fs-4">pending</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Perlu Segera Direview</span>
        <b class="text-warning font-monospace">Prioritas</b>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">SEDANG DITINDAKLANJUTI</span>
          <div class="stat-box-num" style="color: #0284c7;">{{ $prosesCount ?? 0 }} <small style="color: #0284c7;">Laporan</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #e0f2fe; color: #0284c7;">
          <span class="material-symbols-outlined fs-4">engineering</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Dalam Pengerjaan Teknisi</span>
        <b class="text-info font-monospace">Diproses</b>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-4">
    <div class="card-slicing stat-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <span class="stat-box-title">SELESAI / DISETUJUI</span>
          <div class="stat-box-num" style="color: #15803d;">{{ $selesaiCount ?? 0 }} <small style="color: #15803d;">Laporan</small></div>
        </div>
        <div class="stat-icon-sq" style="background: #dcfce7; color: #15803d;">
          <span class="material-symbols-outlined fs-4">task_alt</span>
        </div>
      </div>
      <div class="stat-box-footer">
        <span>Telah Tuntas Ditangani</span>
        <b class="text-success font-monospace">Selesai</b>
      </div>
    </div>
  </div>
</div>

<!-- Search & Filter Card -->
<div class="filter-card">
  <div class="row g-2 align-items-center">
    <div class="col-12 col-md-5">
      <div class="position-relative">
        <span class="material-symbols-outlined position-absolute" style="left: 10px; top: 9px; color: #94a3b8; font-size: 19px;">search</span>
        <input type="text" id="inputSearchLap" class="filter-input w-100 ps-5" placeholder="Cari pelapor, ruangan, nama barang, atau status..." oninput="filterLaporanTable()">
      </div>
    </div>
    <div class="col-6 col-md-3">
      <select id="filterStatusLap" class="filter-select w-100" onchange="filterLaporanTable()">
        <option value="">Semua Status</option>
        <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
        <option value="Sedang Diproses">Sedang Diproses</option>
        <option value="Selesai Disetujui">Selesai Disetujui</option>
        <option value="Ditolak">Ditolak</option>
      </select>
    </div>
    <div class="col-6 col-md-4 text-md-end text-muted small">
      <span style="font-size: 11.5px;">Menampilkan <b id="countLap" class="text-dark">{{ count($laporans ?? []) }}</b> laporan terdaftar</span>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="card-slicing overflow-hidden">
  <div class="table-responsive">
    <table class="table-slicing" id="tableLaporanMasuk">
      <thead>
        <tr>
          <th class="ps-4" style="width: 45px;">NO.</th>
          <th style="min-width: 180px;">PELAPOR &amp; RUANGAN</th>
          <th>JENIS &amp; NAMA BARANG</th>
          <th style="width: 130px;">TANGGAL</th>
          <th style="width: 90px;">URGENSI</th>
          <th style="width: 130px;">KONDISI BARANG</th>
          <th style="width: 140px;">STATUS</th>
          <th class="pe-4 text-end col-actions-2">AKSI</th>
        </tr>
      </thead>
      <tbody id="tbodyLaporanMasuk">
        @forelse($laporans as $idx => $lap)
        <tr data-id="{{ $lap->id }}" data-kode="{{ $lap->kode_laporan }}" data-pelapor="{{ $lap->pelapor?->name ?? 'PJ Ruangan' }}" data-lab="{{ $lap->ruangan?->nama ?? 'Umum' }}" data-barang="{{ $lap->nama_barang }}" data-jenis="{{ $lap->jenis }}" data-status="{{ $lap->status }}" data-deskripsi="{{ $lap->deskripsi }}" data-respon="{{ $lap->respon_admin ?? '' }}" data-kondisi="{{ $lap->kondisi_barang ?? '-' }}">
          <td class="ps-4 text-muted fw-semibold">{{ ($laporans instanceof \Illuminate\Pagination\LengthAwarePaginator ? ($laporans->currentPage() - 1) * $laporans->perPage() : 0) + $loop->iteration }}</td>
          <td>
            <b class="text-dark d-block" style="font-size: 12.5px;">{{ $lap->pelapor?->name ?? 'PJ Ruangan' }}</b>
            <span class="badge" style="background: #e0edff; color: #002366; font-size: 10px;">{{ $lap->ruangan?->nama ?? 'Ruangan' }}</span>
          </td>
          <td>
            <span class="badge d-inline-flex align-items-center gap-1 mb-1" style="{{ $lap->jenis_badge_style }}; font-size: 10px; padding: 2px 6px;">
              <span class="material-symbols-outlined fs-6">{{ $lap->jenis_icon }}</span>
              <span>{{ $lap->jenis }}</span>
            </span>
            <div class="fw-bold text-dark" style="font-size: 12.5px;">{{ $lap->nama_barang }}</div>
            <small class="text-muted d-block" style="font-size: 11px;">{{ Str::limit($lap->deskripsi, 85) }}</small>
            @if($lap->foto_bukti)
            <a href="{{ asset('storage/' . $lap->foto_bukti) }}" target="_blank" class="badge bg-light text-primary border mt-1" style="font-size: 10px;">
              <span class="material-symbols-outlined fs-6 align-text-bottom">image</span> Foto Bukti
            </a>
            @endif
          </td>
          <td class="text-muted small" style="font-size: 11px;">{{ $lap->tanggal_lapor?->format('d M Y, H:i') ?? '-' }}</td>
          <td>
            <span class="badge" style="{{ $lap->urgensi === 'Darurat' ? 'background: #fee2e2; color: #dc2626;' : ($lap->urgensi === 'Penting' ? 'background: #fef3c7; color: #b45309;' : 'background: #f1f5f9; color: #475569;') }}; font-size: 10.5px;">
              {{ $lap->urgensi }}
            </span>
          </td>
          <td><span class="badge bg-light text-dark border font-monospace" style="font-size: 10.5px;">{{ $lap->kondisi_barang ?: ($lap->barang?->kondisi ?? '-') }}</span></td>
          <td><span class="badge-status {{ $lap->status_badge_class }}">● {{ $lap->status }}</span></td>
          <td class="pe-4 text-end col-actions-2">
            <div class="table-actions">
              <button type="button" class="btn btn-sm btn-navy-slicing py-1 px-2" style="font-size: 11px;" title="Tindak Lanjut & Update Status" onclick="openModalTindakLanjut('{{ $lap->id }}')">
                <span class="material-symbols-outlined fs-6">fact_check</span>
                <span>Proses</span>
              </button>
              <form action="{{ route('admin.laporan-masuk.destroy', $lap->id) }}" method="POST" class="d-inline" data-confirm="Apakah Anda yakin ingin menghapus riwayat laporan {{ $lap->nama_barang }} (Soft Delete)?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-light border text-danger py-1 px-2" style="font-size: 11px;" title="Hapus Riwayat Laporan (Soft Delete)">
                  <span class="material-symbols-outlined fs-6">delete</span>
                  <span>Hapus</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center py-4 text-muted small">Belum ada pengaduan masuk dari penanggung jawab.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $laporans->links() }}
</div>

<!-- Modal: Tindak Lanjut & Ubah Status Laporan/Barang -->
<div class="modal fade" id="modalTindakLanjut" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">fact_check</span>
          <h5 class="modal-title fs-6 fw-bold mb-0">Verifikasi &amp; Tindak Lanjut Laporan Sarpras</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <!-- Report Info Header -->
        <div class="card-slicing p-3 mb-3" style="background: #f8faff; border-color: #dbeafe;">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <span id="mdlLaporanId" class="badge font-monospace mb-1" style="background: #002366; color: #fff;">LAP</span>
              <h6 id="mdlLaporanBarang" class="fw-bold text-dark mb-1 fs-6">-</h6>
              <div class="text-muted small">Pelapor: <b id="mdlLaporanPelapor" class="text-dark">-</b> &bull; Unit: <span id="mdlLaporanLab" class="text-primary fw-semibold">-</span></div>
            </div>
            <span id="mdlLaporanJenis" class="badge" style="background: #fee2e2; color: #b91c1c; font-size: 11px;">-</span>
          </div>
          <div class="mt-2 p-2 bg-white rounded-2 border text-muted small" style="font-size: 11.5px;">
            <b>Keterangan Pengaduan:</b> <span id="mdlLaporanDeskripsi">-</span>
          </div>
        </div>

        <!-- Form Update Status & Kondisi Barang -->
        <form onsubmit="event.preventDefault(); submitUpdateLaporanAdmin();">
          <input type="hidden" id="mdlInputLapId">
          <div class="row g-3">
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">STATUS LAPORAN PENGADUAN <span class="text-danger">*</span></label>
              <select id="mdlStatusLaporan" class="form-select" required>
                <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                <option value="Sedang Diproses">Sedang Diproses (Teknisi Ditugaskan)</option>
                <option value="Selesai Disetujui">Selesai Disetujui (Tuntas Ditangani)</option>
                <option value="Ditolak">Ditolak / Tidak Memenuhi Syarat</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">UPDATE STATUS KONDISI BARANG <span class="text-danger">*</span></label>
              <select id="mdlKondisiBarang" class="form-select" required>
                <option value="Rusak Ringan">Ubah Kondisi Jadi: Rusak Ringan</option>
                <option value="Rusak Berat">Ubah Kondisi Jadi: Rusak Berat</option>
                <option value="Afkir">Tandai Kondisi: Afkir / Diganti</option>
                <option value="Baik (Sudah Diservis)">Kembalikan Kondisi Jadi: Baik</option>
                <option value="Rencana Pengadaan Baru">Masukkan ke: Rencana Pengadaan Baru</option>
              </select>
              <small class="text-muted" style="font-size: 11px;">Status barang di data inventaris akan langsung diselaraskan secara otomatis di database.</small>
            </div>

            <div class="col-12">
              <label class="form-label small fw-bold text-muted mb-1">CATATAN &amp; TINDAK LANJUT ADMIN UNTUK PJ <span class="text-danger">*</span></label>
              <textarea id="mdlCatatanAdmin" class="form-control" rows="3" placeholder="Tulis instruksi atau konfirmasi untuk penanggung jawab lab..." required></textarea>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn-navy-slicing">
              <span class="material-symbols-outlined fs-5">save</span>
              Simpan &amp; Perbarui Status Barang
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function filterLaporanTable() {
    const s = document.getElementById('inputSearchLap').value.toLowerCase().trim();
    const st = document.getElementById('filterStatusLap').value;
    const rows = document.querySelectorAll('#tbodyLaporanMasuk tr');
    let cnt = 0;

    rows.forEach(r => {
      const txt = (r.getAttribute('data-kode') + ' ' + r.getAttribute('data-pelapor') + ' ' + r.getAttribute('data-lab') + ' ' + r.getAttribute('data-barang')).toLowerCase();
      const rowSt = r.getAttribute('data-status');

      const matchS = !s || txt.includes(s);
      const matchSt = !st || rowSt === st;

      if (matchS && matchSt) {
        r.style.display = '';
        cnt++;
      } else {
        r.style.display = 'none';
      }
    });

    document.getElementById('countLap').innerText = cnt;
  }

  function openModalTindakLanjut(id) {
    const r = document.querySelector(`tr[data-id="${id}"]`);
    if (!r) return;

    document.getElementById('mdlInputLapId').value = id;
    document.getElementById('mdlLaporanId').innerText = r.getAttribute('data-kode');
    document.getElementById('mdlLaporanBarang').innerText = r.getAttribute('data-barang');
    document.getElementById('mdlLaporanPelapor').innerText = r.getAttribute('data-pelapor');
    document.getElementById('mdlLaporanLab').innerText = r.getAttribute('data-lab');
    document.getElementById('mdlLaporanJenis').innerText = r.getAttribute('data-jenis');
    document.getElementById('mdlLaporanDeskripsi').innerText = r.getAttribute('data-deskripsi');
    document.getElementById('mdlStatusLaporan').value = r.getAttribute('data-status');
    document.getElementById('mdlCatatanAdmin').value = r.getAttribute('data-respon') || '';
    document.getElementById('mdlKondisiBarang').value = r.getAttribute('data-kondisi') || 'Rusak Ringan';

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalTindakLanjut')).show();
  }

  async function submitUpdateLaporanAdmin() {
    const id = document.getElementById('mdlInputLapId').value;
    const r = document.querySelector(`tr[data-id="${id}"]`);
    if (!r) return;

    const newStatus = document.getElementById('mdlStatusLaporan').value;
    const newKondisi = document.getElementById('mdlKondisiBarang').value;
    const newRespon = document.getElementById('mdlCatatanAdmin').value;

    try {
      const res = await fetch(`/admin/laporan-masuk/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          status: newStatus,
          kondisi_barang: newKondisi,
          respon_admin: newRespon
        })
      });

      const data = await res.json();
      if (data.success) {
        r.setAttribute('data-status', newStatus);
        r.setAttribute('data-kondisi', newKondisi);
        r.setAttribute('data-respon', newRespon);

        let badgeClass = 'badge-status-ringan';
        if (newStatus === 'Selesai Disetujui') badgeClass = 'badge-status-baik';
        if (newStatus === 'Ditolak') badgeClass = 'badge-status-berat';

        r.children[6].innerHTML = `<span class="badge-status ${badgeClass}">● ${newStatus}</span>`;
        r.children[5].innerHTML = `<span class="badge bg-light text-dark border font-monospace" style="font-size: 10.5px;">${newKondisi}</span>`;

        bootstrap.Modal.getInstance(document.getElementById('modalTindakLanjut')).hide();
        alert(`Sukses! Laporan telah diperbarui di database dan status barang telah disinkronkan.`);
      }
    } catch (err) {
      alert('Gagal memperbarui status ke database. Periksa koneksi.');
    }
  }
</script>
@endsection
