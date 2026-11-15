<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Inventaris Sekolah</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #f6f8fc;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px;
      color: #1a1c2c;
      position: relative;
    }
    body::before {
      content: "";
      position: absolute;
      right: -100px;
      bottom: -100px;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(#dbeafe, transparent 70%);
      z-index: 0;
    }
    .material-symbols-outlined { font-size: 18px; vertical-align: middle; }
    .auth-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      padding: 34px 30px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 10px 30px rgba(0, 32, 96, 0.07);
      position: relative;
      z-index: 1;
    }
    .field-box {
      display: flex;
      align-items: center;
      background: #f8fafc;
      border: 1px solid #d0d7de;
      border-radius: 8px;
      padding: 0 12px;
      margin-bottom: 16px;
      height: 44px;
      transition: all 0.15s;
    }
    .field-box:focus-within {
      background: #ffffff;
      border-color: #002366;
      box-shadow: 0 0 0 3px rgba(0, 35, 102, 0.15);
    }
    .field-box input {
      border: none;
      background: transparent;
      width: 100%;
      height: 100%;
      outline: none;
      font-size: 13px;
      color: #1e293b;
      padding-left: 8px;
    }
    .btn-submit {
      width: 100%;
      height: 44px;
      border: none;
      border-radius: 8px;
      background: #002366;
      color: #ffffff;
      font-weight: 700;
      font-size: 13.5px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      transition: background 0.15s;
      margin-top: 8px;
    }
    .btn-submit:hover { background: #001744; }
  </style>
</head>
<body>
  <!-- Brand Badge -->
  <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: #e0edff; color: #002366; font-size: 11px; font-weight: 700; letter-spacing: 0.04em;">
    <span style="width: 7px; height: 7px; border-radius: 50%; background: #0284c7;"></span>
    INVENTARIS SEKOLAH &bull; SISTEM MANAJEMEN ASET
  </div>

  <main class="auth-card">
    <div class="text-center mb-4">
      <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
        <img src="{{ asset('images/logo-inventaris.svg') }}" alt="Logo" style="width: 56px; height: 56px; object-fit: contain;">
      </div>
      <h1 class="fs-5 fw-bold mb-1 text-dark">Portal Masuk Inventaris</h1>
      <p class="text-muted small mb-0">Sistem Inventaris Sarana &amp; Prasarana Sekolah</p>
    </div>

    <!-- Alert Messages -->
    @if(session('error'))
      <div class="alert alert-danger py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12px;">
        <span class="material-symbols-outlined fs-5">error</span>
        <span>{{ session('error') }}</span>
      </div>
    @endif

    @if(session('warning'))
      <div class="alert alert-warning py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12px;">
        <span class="material-symbols-outlined fs-5">warning</span>
        <span>{{ session('warning') }}</span>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info py-2 px-3 small d-flex align-items-center gap-2 mb-3" style="font-size: 12px;">
        <span class="material-symbols-outlined fs-5">info</span>
        <span>{{ session('info') }}</span>
      </div>
    @endif

    @auth
      <div class="alert py-2 px-3 small d-flex flex-column gap-1 mb-3 rounded-3" style="font-size: 12px; background: #e0f2fe; border: 1px solid #bae6fd; color: #0369a1;">
        <div class="d-flex align-items-center justify-content-between">
          <span class="d-flex align-items-center gap-1 fw-bold">
            <span class="material-symbols-outlined fs-6">account_circle</span>
            Sesi Aktif: {{ auth()->user()->name }} ({{ strtoupper(auth()->user()->role) }})
          </span>
          <a href="{{ route('logout') }}" class="text-danger fw-bold text-decoration-none small">Keluar</a>
        </div>
        <div class="mt-1 d-flex justify-content-between align-items-center">
          <span class="text-muted" style="font-size: 11px;">Anda terhubung ke sistem.</span>
          <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-sm btn-primary py-1 px-3 fw-semibold text-white text-decoration-none" style="font-size: 11.5px; background: #002366; border-color: #002366; border-radius: 6px;">
            Buka Dashboard &rarr;
          </a>
        </div>
      </div>
    @endauth

    <!-- Single Unified Login Form -->
    <form action="{{ route('login.post') }}" method="POST">
      @csrf

      <!-- Identifier Field (Email / NIP) -->
      <label class="form-label small fw-bold text-muted mb-1">EMAIL ATAU NIP</label>
      <div class="field-box">
        <span class="material-symbols-outlined text-secondary">account_circle</span>
        <input type="text" name="identifier" id="inputIdentifier" placeholder="Masukkan email atau NIP terdaftar" value="{{ old('identifier') }}" required autocomplete="username" autofocus>
      </div>

      <!-- Password Field -->
      <label class="form-label small fw-bold text-muted mb-1">KATA SANDI</label>
      <div class="field-box">
        <span class="material-symbols-outlined text-secondary">lock</span>
        <input type="password" name="password" id="inputPassword" placeholder="Masukkan kata sandi" required autocomplete="current-password">
        <button type="button" class="btn btn-sm text-secondary p-0 border-0" onclick="togglePass()" aria-label="Toggle password">
          <span class="material-symbols-outlined" id="iconEye">visibility</span>
        </button>
      </div>

      <button type="submit" class="btn-submit">
        <span class="material-symbols-outlined">login</span>
        <span>Masuk ke Sistem</span>
      </button>
    </form>
  </main>

  <footer class="text-center text-muted small mt-4" style="font-size: 11.5px; z-index: 1;">
    <span>Sistem Informasi Inventaris Sarana &amp; Prasarana Sekolah</span>
  </footer>

  <script>
    function togglePass() {
      const p = document.getElementById('inputPassword');
      const eye = document.getElementById('iconEye');
      if (p.type === 'password') {
        p.type = 'text';
        eye.innerText = 'visibility_off';
      } else {
        p.type = 'password';
        eye.innerText = 'visibility';
      }
    }
  </script>
</body>
</html>
