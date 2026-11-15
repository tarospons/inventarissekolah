<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Penanggung Jawab') - Inventaris Sekolah</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">
</head>
<body>
  <div class="sidebar-overlay" id="sidebarBackdrop" onclick="toggleSidebarMenu()"></div>

  <!-- Sidebar Penanggung Jawab -->
  <aside id="adminSidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2 p-3 pb-2" style="border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 10px;">
      <img src="{{ asset('images/logo-inventaris.svg') }}" alt="Logo" style="width: 36px; height: 36px; object-fit: contain; flex-shrink: 0;">
      <div>
        <div class="brand-title text-white fw-bold" style="font-size: 13px; line-height: 1.2;">INVENTARIS SEKOLAH</div>
        <small class="brand-sub" style="font-size: 10.5px; color: #7cb8ff;">Portal Penanggung Jawab</small>
      </div>
    </div>

    <!-- Assigned Lab Badge -->
    <div class="mx-3 my-2 p-2 rounded-2" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
      <small class="text-white-50 d-block" style="font-size: 10px;">UNIT / RUANGAN PENUGASAN:</small>
      <b class="text-white d-flex align-items-center gap-1" style="font-size: 12px;">
        <span class="material-symbols-outlined text-info fs-6">domain</span>
        <span>{{ session('auth_user.lab', 'Lab / Ruangan') }}</span>
      </b>
    </div>

    <div class="menu-heading">MENU PENANGGUNG JAWAB</div>

    <a href="{{ route('pj.dashboard') }}" class="sidebar-link {{ request()->routeIs('pj.dashboard*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">grid_view</span>
      <span>Cek Barang Ruangan Saya</span>
    </a>

    <a href="{{ route('pj.laporan') }}" class="sidebar-link {{ request()->routeIs('pj.laporan*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">report_problem</span>
      <span>Laporan &amp; Pengaduan</span>
    </a>

    <!-- Logout -->
    <a href="{{ route('logout') }}" class="logout-link">
      <span class="material-symbols-outlined">logout</span>
      <span>Keluar Sistem</span>
    </a>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="main-wrapper">
    <header class="top-navbar">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-light border d-lg-none p-1 px-2" type="button" onclick="toggleSidebarMenu()" aria-label="Toggle Menu">
          <span class="material-symbols-outlined fs-5">menu</span>
        </button>
        <div class="breadcrumb-nav">
          <span class="material-symbols-outlined" style="font-size:18px">home</span>
          <span>/</span>
          <b>Portal Penanggung Jawab Ruangan</b>
        </div>
      </div>

      <div class="user-box d-flex align-items-center gap-2 ms-auto" title="Profil Penanggung Jawab (Diatur oleh Admin Sarpras)">
        <img src="{{ auth()->user()?->foto_url }}" alt="PJ" class="avatar-img rounded-circle border" style="width: 36px; height: 36px; object-fit: cover; flex-shrink: 0;">
        <div class="text-start" style="line-height: 1.25;">
          <div class="user-name fw-bold" style="font-size: 13px; color: #1a1c2c;">{{ auth()->user()?->name ?? session('auth_user.name', 'Penanggung Jawab') }}</div>
          <small class="user-role fw-semibold" style="font-size: 11px; color: #0284c7;">{{ auth()->user()?->jabatan ?? ('PJ ' . session('auth_user.lab', 'Ruangan')) }}</small>
        </div>
      </div>
    </header>

    <main class="flex-grow-1">
      <div class="page-container">
        <!-- Flash Alert -->
        @if(session('success'))
          <div class="alert alert-success py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-success">check_circle</span>
            <span>{{ session('success') }}</span>
          </div>
        @endif
        @if(session('warning'))
          <div class="alert alert-warning py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-warning">warning</span>
            <span>{{ session('warning') }}</span>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-danger">error</span>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  @include('partials.realtime-notifier')
  @include('partials.swal-confirm')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebarMenu() {
      document.getElementById('adminSidebar').classList.toggle('open');
      document.getElementById('sidebarBackdrop').classList.toggle('show');
    }
  </script>
  @stack('scripts')
</body>
</html>
