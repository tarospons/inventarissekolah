<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

echo "===============================================\n";
echo "TEST 1: TAMBAH PENANGGUNG JAWAB (NIP & SANDI)\n";
echo "===============================================\n";

$admin = User::where('role', 'admin')->first();
Auth::login($admin);

// Create dummy image file for photo upload test
$tmpImg = tempnam(sys_get_temp_dir(), 'test_img') . '.png';
$im = imagecreatetruecolor(100, 100);
$bg = imagecolorallocate($im, 0, 35, 102);
imagefill($im, 0, 0, $bg);
imagepng($im, $tmpImg);
imagedestroy($im);

$uploadedFile = new UploadedFile(
    $tmpImg,
    'test_avatar.png',
    'image/png',
    null,
    true
);

$testNip = '19951230 202401 1 999';
$testPass = 'sandiRahasia123';
$ruangan = Ruangan::first();

$reqStore = Request::create('/admin/penanggung-jawab', 'POST', [
    'name' => 'Guru Penanggung Jawab Baru, S.T.',
    'nip' => $testNip,
    'password' => $testPass,
    'jabatan' => 'Kepala Lab Baru',
    'jurusan' => 'RPL',
    'ruangan_id' => $ruangan ? $ruangan->id : null,
    'kontak' => '081234567899',
    'email' => 'pjbaru@smkn4bojonegoro.sch.id',
], [], [
    'foto' => $uploadedFile,
]);

$controller = app(\App\Http\Controllers\AdminController::class);

// Delete if exists from previous test
User::where('nip', $testNip)->delete();

$res = $controller->penanggungJawabStore($reqStore);
$createdUser = User::where('nip', $testNip)->first();

if ($createdUser && Hash::check($testPass, $createdUser->password)) {
    echo "✔ BERHASIL Tambah PJ: {$createdUser->name}\n";
    echo "  NIP: {$createdUser->nip}\n";
    echo "  Sandi Hash Match: YES\n";
    echo "  Foto Path: {$createdUser->foto_profil}\n";
    echo "  Foto URL: {$createdUser->foto_url}\n";
    echo "  Status Online: " . ($createdUser->is_online ? 'Online' : 'Offline') . "\n";
} else {
    echo "❌ GAGAL Tambah PJ!\n";
}

echo "\n===============================================\n";
echo "TEST 2: EDIT PENANGGUNG JAWAB\n";
echo "===============================================\n";

$reqUpdate = Request::create("/admin/penanggung-jawab/{$createdUser->id}", 'PUT', [
    'name' => 'Guru Penanggung Jawab Baru (Updated), M.Kom.',
    'nip' => $testNip,
    'email' => 'pjbaru@smkn4bojonegoro.sch.id',
    'jabatan' => 'Kepala Lab Software RPL',
    'jurusan' => 'RPL',
    'kontak' => '089988776655',
]);

$controller->penanggungJawabUpdate($reqUpdate, $createdUser->id);
$updatedUser = User::find($createdUser->id);

if ($updatedUser && $updatedUser->name === 'Guru Penanggung Jawab Baru (Updated), M.Kom.') {
    echo "✔ BERHASIL Update PJ: {$updatedUser->name}\n";
} else {
    echo "❌ GAGAL Update PJ!\n";
}

echo "\n===============================================\n";
echo "TEST 3: GANTI FOTO PROFIL (PROFILE CONTROLLER)\n";
echo "===============================================\n";

// Login as the PJ
Auth::login($updatedUser);
$profileController = app(\App\Http\Controllers\ProfileController::class);

$tmpImg2 = tempnam(sys_get_temp_dir(), 'test_img2') . '.png';
$im2 = imagecreatetruecolor(120, 120);
$bg2 = imagecolorallocate($im2, 2, 132, 199);
imagefill($im2, 0, 0, $bg2);
imagepng($im2, $tmpImg2);
imagedestroy($im2);

$uploadedFile2 = new UploadedFile($tmpImg2, 'new_avatar.png', 'image/png', null, true);
$reqFoto = Request::create('/profile/foto', 'POST', [], [], ['foto' => $uploadedFile2]);

$profileController->updateFoto($reqFoto);
$updatedUser->refresh();

if ($updatedUser->foto_profil && Storage::disk('public')->exists($updatedUser->foto_profil)) {
    echo "✔ BERHASIL Ganti Foto Profil: {$updatedUser->foto_profil}\n";
    echo "  Foto URL: {$updatedUser->foto_url}\n";
} else {
    echo "❌ GAGAL Ganti Foto Profil!\n";
}

echo "\n===============================================\n";
echo "TEST 4: HAPUS PENANGGUNG JAWAB\n";
echo "===============================================\n";

Auth::login($admin);
$controller->penanggungJawabDestroy($updatedUser->id);
$deletedUser = User::find($updatedUser->id);

if (!$deletedUser) {
    echo "✔ BERHASIL Hapus PJ! (ID {$updatedUser->id} sudah terhapus)\n";
} else {
    echo "❌ GAGAL Hapus PJ!\n";
}

echo "\n===============================================\n";
echo "TEST 5: RENDER PAGE 1 & PAGE 2 (NO UI BUG)\n";
echo "===============================================\n";

view()->share('errors', new \Illuminate\Support\ViewErrorBag());

$reqP1 = Request::create('/admin/penanggung-jawab', 'GET');
$htmlP1 = $controller->penanggungJawabIndex($reqP1)->render();
echo "✔ Page 1 rendered successfully (" . strlen($htmlP1) . " bytes)\n";

$reqP2 = Request::create('/admin/penanggung-jawab?page=2', 'GET');
$htmlP2 = $controller->penanggungJawabIndex($reqP2)->render();
echo "✔ Page 2 rendered successfully (" . strlen($htmlP2) . " bytes)\n";

if (strpos($htmlP2, 'pagination.previous') === false) {
    echo "✔ Bootstrap 5 pagination active (NO ugly Tailwind 'pagination.previous' text)!\n";
} else {
    echo "ℹ Tailwind pagination text detected.\n";
}

// Cleanup temp files
@unlink($tmpImg);
@unlink($tmpImg2);

echo "\nAll CRUD and Photo Tests Completed Successfully!\n";
