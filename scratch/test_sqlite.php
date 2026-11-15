<?php
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS _test (id INTEGER PRIMARY KEY, name TEXT)");
    echo "SQLite is completely functional and working!\n";
} catch (Exception $e) {
    echo "SQLite error: " . $e->getMessage() . "\n";
}
