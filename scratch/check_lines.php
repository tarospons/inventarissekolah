<?php
$dirs = [
    __DIR__ . '/../app/Http/Controllers',
    __DIR__ . '/../app/Models',
    __DIR__ . '/../app/Http/Middleware',
    __DIR__ . '/../database/seeders',
    __DIR__ . '/../resources/views',
    __DIR__ . '/../routes',
];

$allUnder700 = true;
foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array($file->getExtension(), ['php', 'blade'])) {
            $lines = count(file($file->getPathname()));
            $relPath = str_replace(realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR, '', $file->getPathname());
            if ($lines >= 700) {
                echo "❌ OVER 700: {$relPath} ({$lines} lines)\n";
                $allUnder700 = false;
            } else {
                // show anything over 450 just to be vigilant
                if ($lines > 450) {
                    echo "ℹ High count: {$relPath} ({$lines} lines)\n";
                }
            }
        }
    }
}

if ($allUnder700) {
    echo "✔ ALL files are strictly under 700 lines!\n";
}
