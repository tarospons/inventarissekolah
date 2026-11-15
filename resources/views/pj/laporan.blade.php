@extends('layouts.pj')

@section('title', 'Laporan & Pengaduan Barang')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-2">
  <div>
    <div class="page-breadcrumb">
      <span>Portal PJ</span>
      <span>/</span>
      <b>Laporan &amp; Pengaduan</b>
    </div>
    <h1 class="page-title">Laporan Barang &amp; Pengaduan Sarpras</h1>
    <p class="page-subtitle">Laporkan barang rusak, barang hilang, atau ajukan kebutuhan barang baru di <b>{{ $ruanganUtama?->nama ?? session('auth_user.lab', 'Lab / Ruangan') }}</b> langsung ke Admin.</p>
  </div>
  <div class="d-flex gap-2">
    <button type="button" class="btn-navy-slicing shadow-sm" data-bs-toggle="modal" data-bs-target="#modalBuatLaporan">
      <span class="material-symbols-outlined fs-5">campaign</span>
      <span>+ Buat Laporan Baru</span>
    </button>
  </div>
</div>

<!-- 3 Info Pills -->
<div class="row g-2 mb-3">
  <div class="col-12 col-sm-4">
    <div class="p-2 px-3 rounded-2 border bg-white d-flex align-items-center gap-2">
      <span class="material-symbols-outlined text-danger fs-5">build</span>
      <div><small class="text-muted d-block" style="font-size: 10px;">LAPORAN RUSAK</small><b class="text-dark">{{ $rusakCount ?? 0 }} Terdata</b></div>
    </div>
  </div>
  <div class="col-12 col-sm-4">
    <div class="p-2 px-3 rounded-2 border bg-white d-flex align-items-center gap-2">
      <span class="material-symbols-outlined text-danger fs-5">search_off</span>
      <div><small class="text-muted d-block" style="font-size: 10px;">LAPORAN HILANG</small><b class="text-dark">{{ $hilangCount ?? 0 }} Terdata</b></div>
    </div>
  </div>
  <div class="col-12 col-sm-4">
    <div class="p-2 px-3 rounded-2 border bg-white d-flex align-items-center gap-2">
      <span class="material-symbols-outlined text-primary fs-5">add_shopping_cart</span>
      <div><small class="text-muted d-block" style="font-size: 10px;">USULAN / GANTI BARANG</small><b class="text-dark">{{ $usulanCount ?? 0 }} Pengajuan</b></div>
    </div>
  </div>
</div>

<!-- Table Card: Riwayat Laporan -->
<div class="card-slicing overflow-hidden">
  <div class="p-3 px-4 border-bottom bg-white d-flex justify-content-between align-items-center">
    <h6 class="fw-bold mb-0 text-dark">Riwayat Laporan dari {{ $ruanganUtama?->nama ?? 'Ruangan Saya' }}</h6>
    <span class="badge" style="background: #eef2fe; color: #475569; font-size: 11px;">Sinkron Realtime</span>
  </div>

  <div class="table-responsive">
    <table class="table-slicing" id="tableRiwayatPJ">
      <thead>
        <tr>
          <th class="ps-4" style="width: 130px;">ID LAPORAN</th>
          <th style="width: 150px;">JENIS LAPORAN</th>
          <th>BARANG &amp; KETERANGAN MASALAH</th>
          <th style="width: 140px;">TANGGAL LAPOR</th>
          <th style="width: 100px;">URGENSI</th>
          <th style="width: 140px;">STATUS</th>
          <th class="pe-4" style="min-width: 200px;">TINDAK LANJUT ADMIN</th>
        </tr>
      </thead>
      <tbody id="tbodyRiwayatPJ">
        @forelse($laporans as $lap)
        <tr>
          <td class="ps-4 fw-bold font-monospace text-primary" style="font-size: 11px;">{{ $lap->kode_laporan }}</td>
          <td>
            <span class="badge d-inline-flex align-items-center gap-1" style="{{ $lap->jenis_badge_style }}; font-size: 11px; padding: 4px 8px;">
              <span class="material-symbols-outlined fs-6">{{ $lap->jenis_icon }}</span>
              <span>{{ $lap->jenis }}</span>
            </span>
          </td>
          <td>
            <b class="text-dark" style="font-size: 12.5px;">{{ $lap->nama_barang }}</b>
            <small class="text-muted d-block" style="font-size: 11px;">{{ Str::limit($lap->deskripsi, 90) }}</small>
            @if($lap->foto_bukti)
            <a href="{{ asset('storage/' . $lap->foto_bukti) }}" target="_blank" class="badge bg-light text-primary border mt-1" style="font-size: 10px;">
              <span class="material-symbols-outlined fs-6 align-text-bottom">image</span> Lihat Foto Bukti
            </a>
            @endif
          </td>
          <td class="text-muted small" style="font-size: 11px;">{{ $lap->tanggal_lapor?->format('d M Y, H:i') ?? '-' }} WIB</td>
          <td>
            <span class="badge" style="{{ $lap->urgensi === 'Darurat' ? 'background: #fee2e2; color: #dc2626;' : ($lap->urgensi === 'Penting' ? 'background: #fef3c7; color: #b45309;' : 'background: #f1f5f9; color: #475569;') }}; font-size: 10.5px;">
              {{ $lap->urgensi }}
            </span>
          </td>
          <td><span class="badge-status {{ $lap->status_badge_class }}">● {{ $lap->status }}</span></td>
          <td class="pe-4 small text-muted" style="font-size: 11px; line-height: 1.4;">
            @if($lap->respon_admin)
              <span class="text-dark fw-semibold">{{ $lap->respon_admin }}</span>
            @else
              <span class="text-muted fst-italic">Dalam antrean verifikasi tim sarpras.</span>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center py-4 text-muted small">
            Belum ada riwayat pengaduan yang diajukan. Gunakan tombol "+ Buat Laporan Baru" di atas.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $laporans->links() }}
</div>

<!-- Modal: Buat Laporan Barang Baru -->
<div class="modal fade" id="modalBuatLaporan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header text-white" style="background: #002366;">
        <div class="d-flex align-items-center gap-2">
          <span class="material-symbols-outlined fs-5">campaign</span>
          <h5 class="modal-title fs-6 fw-bold mb-0">Formulir Laporan / Pengaduan Barang Sarpras</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('pj.laporan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="ruangan_id" value="{{ $ruanganUtama?->id }}">

          <div class="row g-3">
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">JENIS LAPORAN <span class="text-danger">*</span></label>
              <select name="jenis" id="lapJenis" class="form-select" required>
                <option value="Ganti Barang Rusak">Ganti Barang Rusak / Afkir (Minta Unit Cadangan)</option>
                <option value="Kebutuhan Barang Baru">Kebutuhan Barang Baru (Usulan Pengadaan Baru)</option>
                <option value="Barang Rusak">Barang Rusak (Permohonan Servis/Perbaikan)</option>
                <option value="Barang Hilang">Barang Hilang (Tidak Ditemukan Saat KBM)</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">TINGKAT URGENSI <span class="text-danger">*</span></label>
              <select name="urgensi" class="form-select" required>
                <option value="Penting">Penting (Mengganggu KBM)</option>
                <option value="Darurat">Darurat (KBM Terhenti Total)</option>
                <option value="Biasa">Biasa (Bisa Dijadwalkan)</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label small fw-bold text-muted mb-1">NAMA BARANG / ASET <span class="text-danger">*</span></label>
              <input type="text" name="nama_barang" id="lapBarang" class="form-control" list="listBarangLab" value="{{ request('barang') ? request('barang') . ' (' . request('kode') . ')' : '' }}" placeholder="Pilih atau ketik nama barang..." required>
              <datalist id="listBarangLab">
                @if(isset($barangsLab))
                  @foreach($barangsLab as $b)
                  <option value="{{ $b->nama }} ({{ $b->kode }})">
                  @endforeach
                @endif
              </datalist>
            </div>
            <div class="col-12">
              <label class="form-label small fw-bold text-muted mb-1">KETERANGAN MASALAH / ALASAN KEBUTUHAN <span class="text-danger">*</span></label>
              <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail kerusakan, waktu kejadian, atau alasan pengajuan kebutuhan barang baru..." required></textarea>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">FOTO BUKTI FISIK (MAKS. 3 MB)</label>
              <input type="file" name="foto_bukti" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
              <small class="text-muted" style="font-size: 10.5px;">Unggah foto fisik barang (JPG/PNG maks. 3MB).</small>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-bold text-muted mb-1">DOKUMEN PENDUKUNG (MAKS. 5 MB)</label>
              <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.xls,.xlsx,.csv">
              <small class="text-muted" style="font-size: 10.5px;">Unggah Berita Acara / Excel usulan (maks. 5MB).</small>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn-navy-slicing">
              <span class="material-symbols-outlined fs-5">send</span>
              Kirim Laporan ke Admin
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('barang')) {
      const modal = new bootstrap.Modal(document.getElementById('modalBuatLaporan'));
      modal.show();
    }
  });
</script>
@endsection
