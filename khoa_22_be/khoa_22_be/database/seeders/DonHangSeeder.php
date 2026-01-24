<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DonHangSeeder extends Seeder
{
    public function run(): void
    {
        $donHangs = [
            [
                'id_khach_hang' => 1,
                'ma_don_hang' => 'DH' . date('YmdHis') . '001',
                'ngay_dat' => Carbon::now()->subDays(5),
                'tien_thuc_nhan' => 180000,
                'tong_tien' => 200000,
                'giam_gia' => 20000,
                'is_thanh_toan' => 1,
                'id_voucher' => 1,
            ],
            [
                'id_khach_hang' => 2,
                'ma_don_hang' => 'DH' . date('YmdHis') . '002',
                'ngay_dat' => Carbon::now()->subDays(3),
                'tien_thuc_nhan' => 85000,
                'tong_tien' => 85000,
                'giam_gia' => 0,
                'is_thanh_toan' => 1,
                'id_voucher' => null,
            ],
            [
                'id_khach_hang' => 3,
                'ma_don_hang' => 'DH' . date('YmdHis') . '003',
                'ngay_dat' => Carbon::now()->subDay(),
                'tien_thuc_nhan' => 150000,
                'tong_tien' => 200000,
                'giam_gia' => 50000,
                'is_thanh_toan' => 1,
                'id_voucher' => 2,
            ],
        ];
        DB::table('don_hangs')->truncate();
        DB::table('don_hangs')->delete();
        DB::table('don_hangs')->insert($donHangs);
    }
}
