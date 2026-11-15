<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Lang pagination.previous: " . __('pagination.previous') . "\n";
echo "Lang pagination.next: " . __('pagination.next') . "\n";
