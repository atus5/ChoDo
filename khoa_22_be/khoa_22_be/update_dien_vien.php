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

// Define ingredients for each product
$ingredients = [
    1 => "Ức gà, tiêu xanh Phú Quốc, lá chanh, mật ong",
    2 => "Ức gà thơm, lá chanh tươi, tiêu xanh, mật ong nguyên chất",
    3 => "Ức gà tươi, chuối hột, gừng, tỏi, tiêu đen, muối",
    4 => "Ức gà, ớt cay, chua cay đặc biệt, sả, hành",
    5 => "Ức gà chọn, muối hồng Himalaya, tiêu xanh, lá chanh calamansi",
    6 => "Ức gà, ớt habanero, ớt bird's eye, mật ong rừng, xạ hương",
    7 => "Ức gà vàng, nghệ, mật ong, tiêu trắng, quế",
    8 => "Ức gà nướng, sả, hành tây, tiêu xanh, nước mắm cá core",
    9 => "Ức gà, chua cay, ớt bột, xạ hương, muối hồng",
    10 => "Ức gà Cao Bằng, rau mùi, tiêu xanh, lá trầu, mật ong"
];

// Update each phim with correct ingredients
foreach ($ingredients as $id => $dien_vien) {
    $dien_vien = $conn->real_escape_string($dien_vien);
    $sql = "UPDATE phims SET dien_vien = '$dien_vien' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "✓ Updated phim $id\n";
    } else {
        echo "✗ Error updating phim $id: " . $conn->error . "\n";
    }
}

// Verify
echo "\n=== VERIFICATION ===\n";
$result = $conn->query("SELECT id, ten_phim, dien_vien FROM phims ORDER BY id");
while ($row = $result->fetch_assoc()) {
    echo $row['id'] . ". " . $row['ten_phim'] . "\n";
    echo "   → " . $row['dien_vien'] . "\n";
}

$conn->close();
?>
