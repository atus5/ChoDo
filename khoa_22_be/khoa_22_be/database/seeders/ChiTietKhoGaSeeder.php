<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChiTietKhoGa;

class ChiTietKhoGaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChiTietKhoGa::create([
            'ten_kho_ga' => 'Khô Gà Cay Siêu Cấp',
            'mo_ta' => 'Khô gà cay với gia vị chuẩn bị tỉ mỉ, vị cay nồng đặc trưng',
            'hinh_anh' => 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/',
            'gia' => 129000,
            'loai_vi' => 'Cay siêu cấp',
            'kich_thuoc' => '200g',
            'tinh_trang' => 2
        ]);

        ChiTietKhoGa::create([
            'ten_kho_ga' => 'Khô Gà Vàng Ươm',
            'mo_ta' => 'Khô gà nướng vàng ươm, thơm lừng với hương nước cốt dừa',
            'hinh_anh' => 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/',
            'gia' => 149000,
            'loai_vi' => 'Vàng ươm',
            'kich_thuoc' => '250g',
            'tinh_trang' => 2
        ]);

        ChiTietKhoGa::create([
            'ten_kho_ga' => 'Khô Gà Nướng Thơm',
            'mo_ta' => 'Khô gà nướng truyền thống với mùi thơm tự nhiên',
            'hinh_anh' => 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/',
            'gia' => 139000,
            'loai_vi' => 'Nướng thơm',
            'kich_thuoc' => '200g',
            'tinh_trang' => 1
        ]);

        ChiTietKhoGa::create([
            'ten_kho_ga' => 'Khô Gà Chua Cay',
            'mo_ta' => 'Khô gà vị chua cay kích thích vị giác, hợp ăn nhễu',
            'hinh_anh' => 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/',
            'gia' => 119000,
            'loai_vi' => 'Chua cay',
            'kich_thuoc' => '150g',
            'tinh_trang' => 2
        ]);

        ChiTietKhoGa::create([
            'ten_kho_ga' => 'Khô Gà Sắp Tới',
            'mo_ta' => 'Sản phẩm khô gà mới sắp được ra mắt với công thức độc quyền',
            'hinh_anh' => 'https://voz.vn/attachments/542754057_1467285577853420_8471185407916019492_n-jpg.3225827/',
            'gia' => 159000,
            'loai_vi' => 'Mặn nhẹ',
            'kich_thuoc' => '300g',
            'tinh_trang' => 1
        ]);
    }
}

