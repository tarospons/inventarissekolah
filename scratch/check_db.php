<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\Laporan;
use App\Models\Kategori;

echo "=== USERS ===\n";
foreach (User::all() as $u) {
    echo "ID: {$u->id} | Name: {$u->name} | Role: {$u->role} | Email: {$u->email} | NIP: {$u->nip}\n";
}

echo "\n=== STATS ===\n";
echo "Total Ruangan: " . Ruangan::count() . "\n";
echo "Total Kategori: " . Kategori::count() . "\n";
echo "Total Barang: " . Barang::count() . " (Sum jumlah: " . Barang::sum('jumlah') . ")\n";
echo "Total Laporan: " . Laporan::count() . "\n";
