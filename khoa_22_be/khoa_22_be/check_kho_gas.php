<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Check count of phims
    $count = DB::table('phims')->count();
    echo "Total phims in long_loz: $count\n\n";
    
    if ($count > 0) {
        echo "Sample phims data:\n";
        $phims = DB::table('phims')->limit(5)->get();
        foreach ($phims as $phim) {
            echo "ID: {$phim->id}, Name: {$phim->ten_phim}, Price: {$phim->thoi_luong}\n";
        }
    }
    
    // Check the_loai_phims
    $genres = DB::table('the_loai_phims')->get();
    echo "\nGenres available:\n";
    foreach ($genres as $g) {
        echo "ID: {$g->id}, Name: {$g->ten_the_loai}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
