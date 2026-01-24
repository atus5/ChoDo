<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DichVuSeeder extends Seeder
{
    public function run(): void
    {
        $dichVu = [
            [
                'ten_dich_vu' => 'Bắp rang',
                'mo_ta' => 'Bắp rang bơ tươi, giòn ngon',
                'gia' => 45000,
                'tinh_trang' => 1,
            ],
            [
                'ten_dich_vu' => 'Nước ngọt',
                'mo_ta' => 'Coca Cola, Pepsi, Sprite, Fanta',
                'gia' => 25000,
                'tinh_trang' => 1,
            ],
            [
                'ten_dich_vu' => 'Combo 1',
                'mo_ta' => '1 bắp rang + 1 nước ngọt',
                'gia' => 65000,
                'tinh_trang' => 1,
            ],
            [
                'ten_dich_vu' => 'Combo 2',
                'mo_ta' => '1 bắp rang + 2 nước ngọt',
                'gia' => 85000,
                'tinh_trang' => 1,
            ],
            [
                'ten_dich_vu' => 'Snack',
                'mo_ta' => 'Các loại snack đóng gói',
                'gia' => 20000,
                'tinh_trang' => 1,
            ],
        ];
        DB::table('dich_vus')->truncate();
        DB::table('dich_vus')->delete();
        DB::table('dich_vus')->insert($dichVu);
    }
}
