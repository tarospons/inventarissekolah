<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

$admin = User::where('role', 'admin')->first();
Auth::login($admin);

$request = Request::create('/admin/penanggung-jawab?page=2', 'GET');
$controller = app(\App\Http\Controllers\AdminController::class);
try {
    view()->share('errors', new \Illuminate\Support\ViewErrorBag());
$response = $controller->penanggungJawabIndex($request);
    $html = $response->render();
    echo "Length of rendered HTML: " . strlen($html) . "\n";
    file_put_contents(__DIR__ . '/rendered_page2.html', $html);
    echo "First 500 chars:\n" . substr($html, 0, 500) . "\n";
} catch (\Throwable $e) {
    echo "ERROR on page 2: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
}
