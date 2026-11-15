<?php
function scanDirRecursive($dir) {
    $results = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            $results = array_merge($results, scanDirRecursive($path));
        } else {
            $results[] = $path;
        }
    }
    return $results;
}

$dirs = ['app', 'resources/views', 'public/css', 'routes'];
foreach ($dirs as $d) {
    if (is_dir($d)) {
        foreach (scanDirRecursive($d) as $file) {
            $lines = count(file($file));
            if ($lines > 450) {
                echo "$file: $lines lines\n";
            }
        }
    }
}
