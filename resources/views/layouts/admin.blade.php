<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin') - Inventaris Sekolah</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
  
  <!-- Fonts: Plus Jakarta Sans & Merriweather -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  
  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom Slicing Theme matching exact mockups -->
  <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">

  @stack('styles')
</head>
<body>
  <!-- Mobile Offcanvas Backdrop -->
  <div class="sidebar-overlay" id="sidebarBackdrop" onclick="toggleSidebarMenu()"></div>

  <!-- Sidebar -->
  <aside id="adminSidebar">
    <div class="brand d-flex align-items-center gap-2" style="padding: 4px 6px 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); margin-bottom: 14px;">
      <img src="{{ asset('images/logo-inventaris.svg') }}" alt="Logo" style="width: 36px; height: 36px; object-fit: contain; flex-shrink: 0;">
      <div class="text-start">
        <div class="brand-title text-white fw-bold" style="font-size: 13px; line-height: 1.2;">INVENTARIS SEKOLAH</div>
        <small class="brand-sub" style="font-size: 10.5px; color: #7cb8ff;">Sistem Inventaris Sarpras</small>
      </div>
    </div>

    <div class="menu-heading">MENU UTAMA</div>
    
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="material-symbols-outlined">grid_view</span>
      <span>Dashboard</span>
    </a>
    
    <a href="{{ route('admin.barang') }}" class="sidebar-link {{ request()->routeIs('admin.barang*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">inventory_2</span>
      <span>Data Barang</span>
    </a>
    
    <a href="{{ route('admin.kategori') }}" class="sidebar-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">label</span>
      <span>Kategori</span>
    </a>
    
    <a href="{{ route('admin.ruangan') }}" class="sidebar-link {{ request()->routeIs('admin.ruangan*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">meeting_room</span>
      <span>Data Ruangan</span>
    </a>
    
    <a href="{{ route('admin.pj') }}" class="sidebar-link {{ request()->routeIs('admin.pj*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">badge</span>
      <span>Penanggung Jawab</span>
    </a>
    
    <a href="{{ route('admin.laporan-masuk') }}" class="sidebar-link {{ request()->routeIs('admin.laporan-masuk*') ? 'active' : '' }}">
      <span class="material-symbols-outlined">mark_email_unread</span>
      <span class="flex-grow-1">Laporan Masuk</span>
      <span class="badge rounded-pill bg-danger badge-unread-laporan" style="font-size: 10px; padding: 2px 6px;">{{ \App\Models\Laporan::where('status', 'Menunggu Verifikasi')->count() ?: '' }}</span>
    </a>

    <a href="{{ route('admin.laporan') }}" class="sidebar-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
      <span class="material-symbols-outlined">description</span>
      <span>Laporan</span>
    </a>

    <!-- Logout at bottom -->
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
          <b>Inventaris Sekolah</b>
        </div>
      </div>

      <div class="user-box d-flex align-items-center gap-2 ms-auto" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalGantiFotoProfil" title="Klik untuk ganti foto profil">
        <img src="{{ auth()->user()?->foto_url }}" alt="{{ auth()->user()?->name ?? 'Admin' }}" class="avatar-img rounded-circle border" style="width: 36px; height: 36px; object-fit: cover; flex-shrink: 0;">
        <div class="text-start" style="line-height: 1.25;">
          <div class="user-name fw-bold" style="font-size: 13px; color: #1a1c2c;">{{ auth()->user()?->name ?? 'Admin' }}</div>
          <small class="user-role fw-semibold" style="font-size: 11px; color: #0369a1;">{{ auth()->user()?->jabatan ?? 'Administrator Sarpras' }}</small>
        </div>
      </div>
    </header>

    <main class="flex-grow-1">
      <div class="page-container">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-success">check_circle</span>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
        @if(session('warning'))
          <div class="alert alert-warning alert-dismissible fade show py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-warning">warning</span>
            <div class="flex-grow-1">{{ session('warning') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12.5px;">
            <span class="material-symbols-outlined text-danger">error</span>
            <div class="flex-grow-1">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif
        @yield('content')
      </div>
    </main>
  </div>

  <!-- Bootstrap 5.3.3 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function toggleSidebarMenu() {
      const sidebar = document.getElementById('adminSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      sidebar.classList.toggle('open');
      backdrop.classList.toggle('show');
    }
  </script>

  @include('partials.modal-profile-photo')
  @include('partials.realtime-notifier')
  @include('partials.swal-confirm')

  @stack('modal')
  @stack('scripts')
</body>
</html>
