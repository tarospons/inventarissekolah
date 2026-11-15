<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\User;

echo "public_path('storage'): " . public_path('storage') . "\n";
echo "is_link: " . (is_link(public_path('storage')) ? 'YES' : 'NO') . "\n";
echo "is_dir: " . (is_dir(public_path('storage')) ? 'YES' : 'NO') . "\n";
echo "storage_path('app/public'): " . storage_path('app/public') . "\n";

// Test write a dummy file
Storage::disk('public')->put('test.txt', 'hello');
echo "Disk public exists test.txt: " . (Storage::disk('public')->exists('test.txt') ? 'YES' : 'NO') . "\n";
echo "public/storage/test.txt exists: " . (file_exists(public_path('storage/test.txt')) ? 'YES' : 'NO') . "\n";
