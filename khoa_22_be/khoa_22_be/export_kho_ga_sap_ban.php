<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    $items = DB::table('kho_ga_sap_ban')
        ->select('id', 'ten_kho_ga', 'mo_ta', 'mo_ta_ngan', 'hinh_anh', 'loai_vi', 'gia', 'dien_vien', 'ngay_phat_hanh', 'so_luong_dat_truoc')
        ->get();

    $data = [
        'status' => true,
        'data' => $items->toArray()
    ];

    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    $outputPath = __DIR__ . '/../../khoa_22_fe/frontend/public/kho-ga-sap-ban.json';
    @file_put_contents($outputPath, $json);

    echo $json;
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage(),
        'data' => []
    ], JSON_UNESCAPED_UNICODE);
}
