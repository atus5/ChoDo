<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDichVuSeeder extends Seeder
{
    public function run(): void
    {
        $chiTietDichVus = [
            [
                'id_don_hang' => 1,
                'id_dich_vu' => 3, // Combo 1
                'so_luong' => 2,
                'don_gia' => 65000,
                'thanh_tien' => 130000,
                'ghi_chu' => 'Khách yêu cầu bắp không bơ',
            ],
            [
                'id_don_hang' => 2,
                'id_dich_vu' => 1, // Bắp rang
                'so_luong' => 1,
                'don_gia' => 45000,
                'thanh_tien' => 45000,
                'ghi_chu' => '',
            ],
            [
                'id_don_hang' => 2,
                'id_dich_vu' => 2, // Nước ngọt
                'so_luong' => 1,
                'don_gia' => 25000,
                'thanh_tien' => 25000,
                'ghi_chu' => 'Coca Cola',
            ],
            [
                'id_don_hang' => 3,
                'id_dich_vu' => 4, // Combo 2
                'so_luong' => 1,
                'don_gia' => 85000,
                'thanh_tien' => 85000,
                'ghi_chu' => '',
            ],
        ];
        DB::table('chi_tiet_dich_vus')->truncate();
        DB::table('chi_tiet_dich_vus')->delete();
        DB::table('chi_tiet_dich_vus')->insert($chiTietDichVus);
    }
}
