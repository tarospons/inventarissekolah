<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\PjController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealtimeController;

// ===== ROOT & AUTENTIKASI =====
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Aliases
Route::get('/admin/login', fn() => redirect()->route('login'))->name('admin.login');
Route::get('/kepsek/login', fn() => redirect()->route('login'))->name('kepsek.login');
Route::get('/pj/login', fn() => redirect()->route('login'))->name('pj.login');

// ===== REALTIME API (SSE & POLLING) =====
Route::get('/api/realtime/poll', [RealtimeController::class, 'poll'])->name('realtime.poll');
Route::get('/api/realtime/stream', [RealtimeController::class, 'stream'])->name('realtime.stream');

// ===== PUBLIC STORAGE ASSET SERVING =====
Route::get('/storage/{path}', function (string $path) {
    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return \Illuminate\Support\Facades\Storage::disk('public')->response($path);
})->where('path', '.*')->name('storage.local');

// ===== PROFIL & GANTI FOTO (SEMUA ROLE) =====
Route::middleware('auth')->group(function () {
    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.foto');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
});

// ===== ROLE: ADMINISTRATOR SARPRAS =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Barang Inventaris CRUD
    Route::get('/barang', [AdminController::class, 'barangIndex'])->name('barang');
    Route::get('/barang/tambah', [AdminController::class, 'barangCreate'])->name('barang.create');
    Route::get('/barang/create', [AdminController::class, 'barangCreate']);
    Route::post('/barang', [AdminController::class, 'barangStore'])->name('barang.store');
    Route::put('/barang/{id}', [AdminController::class, 'barangUpdate'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'barangDestroy'])->name('barang.destroy');

    // Kategori CRUD
    Route::get('/kategori', [AdminController::class, 'kategoriIndex'])->name('kategori');
    Route::post('/kategori', [AdminController::class, 'kategoriStore'])->name('kategori.store');
    Route::put('/kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('kategori.update');
    Route::delete('/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('kategori.destroy');

    // Ruangan CRUD
    Route::get('/ruangan', [AdminController::class, 'ruanganIndex'])->name('ruangan');
    Route::post('/ruangan', [AdminController::class, 'ruanganStore'])->name('ruangan.store');
    Route::put('/ruangan/{id}', [AdminController::class, 'ruanganUpdate'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [AdminController::class, 'ruanganDestroy'])->name('ruangan.destroy');

    // Penanggung Jawab (PJ) CRUD
    Route::get('/penanggung-jawab', [AdminController::class, 'penanggungJawabIndex'])->name('pj');
    Route::get('/pj', [AdminController::class, 'penanggungJawabIndex']);
    Route::post('/penanggung-jawab', [AdminController::class, 'penanggungJawabStore'])->name('pj.store');
    Route::put('/penanggung-jawab/{id}', [AdminController::class, 'penanggungJawabUpdate'])->name('pj.update');
    Route::delete('/penanggung-jawab/{id}', [AdminController::class, 'penanggungJawabDestroy'])->name('pj.destroy');

    // Laporan Masuk & Verifikasi
    Route::get('/laporan-masuk', [AdminController::class, 'laporanMasukIndex'])->name('laporan-masuk');
    Route::match(['post', 'put'], '/laporan-masuk/{id}', [AdminController::class, 'laporanMasukUpdate'])->name('laporan-masuk.update');
    Route::delete('/laporan-masuk/{id}', [AdminController::class, 'laporanMasukDestroy'])->name('laporan-masuk.destroy');
    Route::get('/laporan', [AdminController::class, 'laporanIndex'])->name('laporan');
    Route::delete('/laporan/{id}', [AdminController::class, 'laporanMasukDestroy'])->name('laporan.destroy');
});

// ===== ROLE: KEPALA SEKOLAH (MONITORING & VERIFIKASI) =====
Route::prefix('kepsek')->name('kepsek.')->middleware(['auth', 'role:kepsek'])->group(function () {
    Route::get('/dashboard', [KepsekController::class, 'dashboard'])->name('dashboard');
    Route::get('/inventaris', [KepsekController::class, 'inventaris'])->name('inventaris');
    Route::get('/ruangan', [KepsekController::class, 'ruangan'])->name('ruangan');
    Route::get('/laporan', [KepsekController::class, 'laporan'])->name('laporan');
});

// ===== ROLE: PENANGGUNG JAWAB (PJ LAB / BENGKEL / KELAS) =====
Route::prefix('pj')->name('pj.')->middleware(['auth', 'role:pj'])->group(function () {
    Route::get('/dashboard', [PjController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [PjController::class, 'laporanIndex'])->name('laporan');
    Route::post('/laporan', [PjController::class, 'laporanStore'])->name('laporan.store');
});
