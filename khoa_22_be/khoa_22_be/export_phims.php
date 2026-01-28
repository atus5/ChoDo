<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Get all phims from long_loz with mo_ta, hinh_anh, tinh_trang, and dien_vien
    $phims = DB::table('phims')
        ->select('id', 'ten_phim', 'mo_ta', 'hinh_anh', 'tinh_trang', 'thoi_luong', 'dien_vien')
        ->get();
    
    $data = [
        'status' => true,
        'data' => $phims->toArray()
    ];
    
    // Output as JSON with UTF-8 encoding
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
