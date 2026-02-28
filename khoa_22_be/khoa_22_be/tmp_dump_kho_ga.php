<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$data = App\Models\Phim::select('id', 'ten_phim', 'tinh_trang', 'thoi_luong')->get();
echo json_encode($data, JSON_PRETTY_PRINT);
