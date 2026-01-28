<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KhachHangSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first
        KhachHang::truncate();

        // Create test accounts with linked users
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
                'user_email' => 'dung.pham@gmail.com',
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
                'user_email' => 'nguyenvan.a@gmail.com',
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
                'user_email' => 'tranthi.b@gmail.com',
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
                'user_email' => 'levan.c@gmail.com',
            ],
        ];

        foreach ($khachHangs as $khachHang) {
            // Extract user_email for later linking
            $userEmail = $khachHang['user_email'];
            unset($khachHang['user_email']);
            
            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $userEmail],
                [
                    'name' => $khachHang['ho_va_ten'],
                    'password' => Hash::make($khachHang['password']),
                ]
            );
            
            // Add id_user to khach hang
            $khachHang['id_user'] = $user->id;
            
            KhachHang::create($khachHang);
        }
    }
}
