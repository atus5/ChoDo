<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'ma_code' => 'WELCOME2024',
                'thoi_gian_bat_dau' => Carbon::now(),
                'thoi_gian_ket_thuc' => Carbon::now()->addMonths(1),
                'loai_giam' => 1, // 1: Phần trăm, 2: Tiền mặt
                'so_giam_gia' => 20, // 20%
                'so_tien_toi_da' => 100000,
                've_toi_thieu' => 1,
                'tinh_trang' => 1, // 1: Hoạt động
            ],
            [
                'ma_code' => 'MEMBER50K',
                'thoi_gian_bat_dau' => Carbon::now(),
                'thoi_gian_ket_thuc' => Carbon::now()->addMonths(2),
                'loai_giam' => 2, // 1: Phần trăm, 2: Tiền mặt
                'so_giam_gia' => 50000, // 50,000đ
                'so_tien_toi_da' => 50000,
                've_toi_thieu' => 1,
                'tinh_trang' => 1,
            ],
            [
                'ma_code' => 'COMBO30',
                'thoi_gian_bat_dau' => Carbon::now(),
                'thoi_gian_ket_thuc' => Carbon::now()->addWeeks(2),
                'loai_giam' => 1, // 1: Phần trăm, 2: Tiền mặt
                'so_giam_gia' => 30, // 30%
                'so_tien_toi_da' => 50000,
                've_toi_thieu' => 2,
                'tinh_trang' => 1,
            ],
        ];
        DB::table('vouchers')->truncate();
        DB::table('vouchers')->delete();
        DB::table('vouchers')->insert($vouchers);
    }
}
