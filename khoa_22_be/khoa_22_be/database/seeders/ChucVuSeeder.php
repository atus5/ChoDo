<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucVuSeeder extends Seeder
{
    public function run(): void
    {
        $chucVu = [
            [
                'ten_chuc_vu' => 'Quản lý',
                'slug_chuc_vu' => 'quan-ly',
                'tinh_trang' => 1,
            ],
            [
                'ten_chuc_vu' => 'Nhân viên bán vé',
                'slug_chuc_vu' => 'nhan-vien-ban-ve',
                'tinh_trang' => 1,
            ],
            [
                'ten_chuc_vu' => 'Nhân viên kỹ thuật',
                'slug_chuc_vu' => 'nhan-vien-ky-thuat',
                'tinh_trang' => 1,
            ],
            [
                'ten_chuc_vu' => 'Nhân viên bán đồ ăn',
                'slug_chuc_vu' => 'nhan-vien-ban-do-an',
                'tinh_trang' => 1,
            ],
        ];
        DB::table('chuc_vus')->truncate();
        DB::table('chuc_vus')->delete();
        DB::table('chuc_vus')->insert($chucVu);
    }
}
