<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get all phims from long_loz
try {
    $phims = DB::table('phims')
        ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
        ->select('phims.*', 'the_loai_phims.ten_the_loai')
        ->get();
    
    header('Content-Type: application/json');
    echo json_encode([
        'status' => true,
        'data' => $phims
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
