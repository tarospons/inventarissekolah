<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Kepala Sekolah') - Inventaris Sekolah</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <!-- Bootstrap 5.3.3 CSS for Modals & Interactive Components -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
    }
    :root {
      --navy: #00236b;
      --blue: #1e3a8a;
      --teal: #0369a1;
      --red: #ba1a1a;
      --bg: #f9f9ff;
      --soft: #f1f2fd;
      --line: #ebecfa;
      --mut: #444654;
      --ok: #0a7d5a;
      --warn: #c2570c;
    }
    body {
      font-family: 'Plus Jakarta Sans',sans-serif;
      background: var(--bg);
      color: #1a1c2c;
      font-size: 13px;
    }
    .material-symbols-outlined {
      font-size: 18px;
      vertical-align: middle;
    }
    aside {
      position: fixed;
      inset: 0 auto 0 0;
      width: 200px;
      background: var(--navy);
      color: #b9c6ff;
      display: flex;
      flex-direction: column;
      padding: 18px 12px;
    }
    .brand {
      display: flex;
      gap: 10px;
      align-items: center;
      color: #fff;
      font-weight: 700;
      font-size: 12px;
      margin-bottom: 16px;
    }
    .brand small {
      display: block;
      color: #b9c6ff;
      font-size: 9.5px;
      font-weight: 400;
    }
    .role {
      font-size: 10px;
      color: #b9c6ff;
      text-transform: uppercase;
      letter-spacing: .05em;
      margin-bottom: 14px;
    }
    aside a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 8px;
      color: #b9c6ff;
      text-decoration: none;
      margin-bottom: 4px;
    }
    aside a.on {
      background: rgba(255,255,255,.14);
      color: #fff;
      font-weight: 600;
    }
    aside a:hover {
      background: rgba(255,255,255,.08);
    }
    .ro {
      margin-top: auto;
      background: rgba(255,255,255,.08);
      border-radius: 8px;
      padding: 10px;
      font-size: 10px;
      line-height: 1.5;
      margin-bottom: 16px;
    }
    .main {
      margin-left: 200px;
      padding: 0 16px 24px;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 48px;
      font-size: 12px;
      color: var(--mut);
    }
    header b {
      color: var(--navy);
    }
    header .r {
      display: flex;
      gap: 16px;
      align-items: center;
    }
    .ro-tag {
      background: #cfe5ff;
      color: var(--teal);
      font-size: 9px;
      font-weight: 700;
      padding: 2px 6px;
      border-radius: 4px;
      margin-left: 4px;
    }
  </style>
  @stack('styles')
</head>
<body>
  <aside>
    <div class="brand">
      <img src="{{ asset('images/logo-inventaris.svg') }}" alt="Logo" style="width: 34px; height: 34px; object-fit: contain; flex-shrink: 0;">
      <div>INVENTARIS SEKOLAH<small>Portal Eksekutif Sarpras</small></div>
    </div>
    <div class="role">Role: Kepala Sekolah (Pengawas)</div>
    <a href="{{ route('kepsek.dashboard') }}" class="{{ request()->routeIs('kepsek.dashboard') ? 'on' : '' }}">
      <span class="material-symbols-outlined">grid_view</span>Dashboard
    </a>
    <a href="{{ route('kepsek.inventaris') }}" class="{{ request()->routeIs('kepsek.inventaris*') ? 'on' : '' }}">
      <span class="material-symbols-outlined">inventory_2</span>Data Inventaris
    </a>
    <a href="{{ route('kepsek.ruangan') }}" class="{{ request()->routeIs('kepsek.ruangan*') ? 'on' : '' }}">
      <span class="material-symbols-outlined">meeting_room</span>Data Ruangan
    </a>
    <a href="{{ route('kepsek.laporan') }}" class="{{ request()->routeIs('kepsek.laporan*') ? 'on' : '' }}">
      <span class="material-symbols-outlined">description</span>Laporan
    </a>
    <div class="ro"><span class="material-symbols-outlined" style="font-size:14px">visibility</span> Mode Pemantauan Eksekutif • Tidak memiliki akses ubah/tambah data.</div>
    <a href="{{ route('logout') }}">
      <span class="material-symbols-outlined">logout</span>Keluar Sistem
    </a>
  </aside>

  <div class="main">
    <header>
      <span>Inventaris Sekolah &gt; <b>Portal Eksekutif</b></span>
      <div class="r">
        <div class="d-inline-flex align-items-center gap-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalGantiFotoProfil" title="Klik untuk ubah foto profil">
          <img src="{{ auth()->user()?->foto_url }}" alt="Kepsek" class="rounded-circle border" style="width: 34px; height: 34px; object-fit: cover; flex-shrink: 0;">
          <div class="text-start" style="line-height: 1.25;">
            <div style="font-weight: 700; color: #1a1c2c; font-size: 13px;">{{ auth()->user()?->name ?? 'Kepala Sekolah' }}</div>
            <small style="font-size: 11px; color: #0369a1; font-weight: 600;">{{ auth()->user()?->jabatan ?? 'Kepala Sekolah' }} <span class="ro-tag">READ-ONLY</span></small>
          </div>
        </div>
      </div>
    </header>

    @yield('content')
  </div>

  @include('partials.modal-profile-photo')
  @include('partials.realtime-notifier')
  @include('partials.swal-confirm')

  @stack('modal')
  <!-- Bootstrap 5.3.3 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
