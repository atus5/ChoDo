<?php

declare(strict_types=1);

$host = '127.0.0.1';
$port = 3308;
$username = 'root';
$password = '';
$database = 'long_loz_kho_ga';

try {
    $dsn = "mysql:host={$host};port={$port};charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    echo "Created or verified database: {$database}" . PHP_EOL;
} catch (Throwable $e) {
    fwrite(STDERR, 'Failed to create database: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
