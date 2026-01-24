<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhachHang;

class KhachHangSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first
        KhachHang::truncate();

        // Create test accounts
        $khachHangs = [
            [
                'ho_va_ten' => 'Phạm Thị Dung',
                'email' => 'dung.pham@gmail.com',
                'so_dien_thoai' => '0934567890',
                'password' => '123456', // Model sẽ hash tự động
                'cccd' => '123456789001',
                'ngay_sinh' => '1998-03-25',
                'is_active' => 1,
                'is_block' => 0,
            ],
            [
                'ho_va_ten' => 'Nguyễn Văn A',
                'email' => 'nguyenvan.a@gmail.com',
                'so_dien_thoai' => '0912345678',
                'password' => '123456', // Model sẽ hash tự động
                'cccd' => '123456789002',
                'ngay_sinh' => '1998-03-25',
                'is_active' => 1,
                'is_block' => 0,
            ],
            [
                'ho_va_ten' => 'Trần Thị B',
                'email' => 'tranthi.b@gmail.com',
                'so_dien_thoai' => '0945678901',
                'password' => '123456', // Model sẽ hash tự động
                'cccd' => '123456789003',
                'ngay_sinh' => '1998-03-25',
                'is_active' => 1,
                'is_block' => 0,
            ],
            [
                'ho_va_ten' => 'Lê Văn C',
                'email' => 'levan.c@gmail.com',
                'so_dien_thoai' => '0912345678',
                'password' => '123456', // Model sẽ hash tự động
                'cccd' => '123456789004',
                'ngay_sinh' => '1998-03-25',
                'is_active' => 1,
                'is_block' => 0,
            ],
        ];

        foreach ($khachHangs as $khachHang) {
            KhachHang::create($khachHang);
        }
    }
}
