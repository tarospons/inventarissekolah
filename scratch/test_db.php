<?php
$configs = [
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => 'roott', 'db' => 'inventaris_smk4'],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => '', 'db' => 'inventaris_smk4'],
    ['host' => 'localhost', 'user' => 'root', 'pass' => '', 'db' => 'inventaris_smk4'],
];

$success = false;
foreach ($configs as $cfg) {
    try {
        $pdo = new PDO("mysql:host={$cfg['host']};port=3306", $cfg['user'], $cfg['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "SUCCESS: Connected to MySQL host={$cfg['host']} user={$cfg['user']} pass=" . ($cfg['pass'] ? '***' : '(empty)') . "\n";
        
        // Ensure database exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$cfg['db']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "DATABASE `{$cfg['db']}` is ready!\n";
        $success = true;
        break;
    } catch (Exception $e) {
        echo "FAIL with {$cfg['user']}@{$cfg['host']}: " . $e->getMessage() . "\n";
    }
}

if (!$success) {
    echo "Notice: MySQL server is currently not reachable or password differs. SQLite fallback can also be used if needed.\n";
}
