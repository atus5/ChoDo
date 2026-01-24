<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeSeeder extends Seeder
{
    public function run(): void
    {
        $ves = [
            [
                'ma_ve' => 'VE' . date('YmdHis') . '001',
                'gia_ve' => 100000,
                'id_don_dat_ve' => 1,
                'id_suat_chieu' => 1,
                'ten_ghe' => 'A1',
                'tinh_trang' => 1,
            ],
            [
                'ma_ve' => 'VE' . date('YmdHis') . '002',
                'gia_ve' => 100000,
                'id_don_dat_ve' => 1,
                'id_suat_chieu' => 1,
                'ten_ghe' => 'A2',
                'tinh_trang' => 1,
            ],
            [
                'ma_ve' => 'VE' . date('YmdHis') . '003',
                'gia_ve' => 85000,
                'id_don_dat_ve' => 2,
                'id_suat_chieu' => 2,
                'ten_ghe' => 'B3',
                'tinh_trang' => 1,
            ],
            [
                'ma_ve' => 'VE' . date('YmdHis') . '004',
                'gia_ve' => 90000,
                'id_don_dat_ve' => 3,
                'id_suat_chieu' => 3,
                'ten_ghe' => 'C4',
                'tinh_trang' => 1,
            ],
            [
                'ma_ve' => 'VE' . date('YmdHis') . '005',
                'gia_ve' => 90000,
                'id_don_dat_ve' => 3,
                'id_suat_chieu' => 3,
                'ten_ghe' => 'C5',
                'tinh_trang' => 1,
            ],
        ];

        // Xóa dữ liệu cũ trước khi chèn mới
        DB::table('ves')->truncate();
        DB::table('ves')->delete();
        DB::table('ves')->insert($ves);
    }
}
