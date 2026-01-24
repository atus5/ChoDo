<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhongChieuSeeder extends Seeder
{
    public function run(): void
    {
        $phongChieu = [
            [
                'ten_phong' => 'Phòng 1',
                'hang_ngang' => 8,
                'hang_doc' => 8,
                'is_active' => 1,
                'tinh_trang' => 1,
            ],
            [
                'ten_phong' => 'Phòng 2',
                'hang_ngang' => 8,
                'hang_doc' => 6,
                'is_active' => 1,
                'tinh_trang' => 1,
            ],
            [
                'ten_phong' => 'Phòng VIP',
                'hang_ngang' => 6,
                'hang_doc' => 6,
                'is_active' => 1,
                'tinh_trang' => 1,
            ],
        ];

        DB::table('phong_chieus')->truncate();
        DB::table('phong_chieus')->delete();
        DB::table('phong_chieus')->insert($phongChieu);
    }
}
