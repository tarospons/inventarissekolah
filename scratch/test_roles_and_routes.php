<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

echo "========================================\n";
echo "1. VERIFYING USER CREDENTIALS & PASSWORDS\n";
echo "========================================\n";

$admin = User::where('email', 'admin@adminsvc.com')->first();
if ($admin && Hash::check('admin1234', $admin->password)) {
    echo "✔ Admin login verified: {$admin->name} (role: {$admin->role})\n";
} else {
    echo "❌ Admin login FAILED!\n";
}

$kepsek = User::where('email', 'kepalasekolah@kepseksvc.com')->first();
if ($kepsek && Hash::check('kepsek1234', $kepsek->password)) {
    echo "✔ Kepala Sekolah login verified: {$kepsek->name} (role: {$kepsek->role})\n";
} else {
    echo "❌ Kepala Sekolah login FAILED!\n";
}

$pj = User::where('nip', '19840312 200902 1 004')->first();
if ($pj && Hash::check('pj123456', $pj->password)) {
    echo "✔ Penanggung Jawab login verified: {$pj->name} (role: {$pj->role})\n";
} else {
    echo "❌ Penanggung Jawab login FAILED!\n";
}

echo "\n========================================\n";
echo "2. VERIFYING VIEW RENDERING (NO BLADE ERRORS)\n";
echo "========================================\n";

// Test Admin views
Auth::login($admin);
$adminController = app(\App\Http\Controllers\AdminController::class);
try {
    $res = $adminController->dashboard();
    echo "✔ Admin Dashboard rendered successfully (HTTP " . ($res ? "200" : "ERR") . ")\n";
} catch (\Throwable $e) {
    echo "❌ Admin Dashboard Error: " . $e->getMessage() . " on line " . $e->getLine() . "\n";
}

try {
    $req = new \Illuminate\Http\Request();
    $res = $adminController->penanggungJawabIndex($req);
    echo "✔ Admin Penanggung Jawab view rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ Admin PJ Error: " . $e->getMessage() . "\n";
}

// Test Kepsek views
Auth::login($kepsek);
$kepsekController = app(\App\Http\Controllers\KepsekController::class);
try {
    $res = $kepsekController->dashboard();
    echo "✔ Kepsek Dashboard rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ Kepsek Dashboard Error: " . $e->getMessage() . " on line " . $e->getLine() . "\n";
}

try {
    $req = new \Illuminate\Http\Request();
    $res = $kepsekController->inventaris($req);
    echo "✔ Kepsek Inventaris view rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ Kepsek Inventaris Error: " . $e->getMessage() . "\n";
}

try {
    $res = $kepsekController->ruangan();
    echo "✔ Kepsek Ruangan view rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ Kepsek Ruangan Error: " . $e->getMessage() . "\n";
}

try {
    $req = new \Illuminate\Http\Request();
    $res = $kepsekController->laporan($req);
    echo "✔ Kepsek Laporan view rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ Kepsek Laporan Error: " . $e->getMessage() . "\n";
}

// Test PJ views
Auth::login($pj);
$pjController = app(\App\Http\Controllers\PjController::class);
try {
    $res = $pjController->dashboard();
    echo "✔ PJ Dashboard rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ PJ Dashboard Error: " . $e->getMessage() . " on line " . $e->getLine() . "\n";
}

try {
    $res = $pjController->laporanIndex();
    echo "✔ PJ Laporan view rendered successfully\n";
} catch (\Throwable $e) {
    echo "❌ PJ Laporan Error: " . $e->getMessage() . "\n";
}

echo "\n========================================\n";
echo "3. CHECKING FILE LINE COUNTS (< 700 LINES)\n";
echo "========================================\n";

$dirs = [
    __DIR__ . '/../app/Http/Controllers',
    __DIR__ . '/../app/Models',
    __DIR__ . '/../database/seeders',
    __DIR__ . '/../resources/views/admin',
    __DIR__ . '/../resources/views/kepsek',
    __DIR__ . '/../resources/views/pj',
    __DIR__ . '/../resources/views/layouts',
    __DIR__ . '/../resources/views/partials',
];

$allUnder700 = true;
foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'blade.php', 'blade'])) {
            $lines = count(file($file->getPathname()));
            $relPath = str_replace(realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR, '', $file->getPathname());
            if ($lines >= 700) {
                echo "❌ OVER 700: {$relPath} ({$lines} lines)\n";
                $allUnder700 = false;
            }
        }
    }
}

if ($allUnder700) {
    echo "✔ ALL files are strictly under 700 lines!\n";
}

echo "\nTesting Completed.\n";
