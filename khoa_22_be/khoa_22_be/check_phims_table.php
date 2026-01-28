<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = env('DB_HOST', '127.0.0.1');
$port = env('DB_PORT', 3308);
$database = env('DB_DATABASE', 'long_loz');
$user = env('DB_USERNAME', 'root');
$password = env('DB_PASSWORD', '');

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check table structure
$result = $conn->query("DESCRIBE phims");

echo "\n=== PHIMS TABLE STRUCTURE ===\n";
while ($row = $result->fetch_assoc()) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}

// Check first phim data
echo "\n=== FIRST PHIM DATA ===\n";
$phim = $conn->query("SELECT * FROM phims LIMIT 1")->fetch_assoc();
if ($phim) {
    foreach ($phim as $key => $value) {
        echo "$key: " . (is_null($value) ? "NULL" : $value) . "\n";
    }
} else {
    echo "No phim found\n";
}

$conn->close();
?>
