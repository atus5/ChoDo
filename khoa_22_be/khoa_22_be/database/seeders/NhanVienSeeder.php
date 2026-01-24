<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NhanVienSeeder extends Seeder
{
    public function run(): void
    {
        $nhanVien = [
            [
                'email' => 'admin@gmail.com',
                'ho_va_ten' => 'Admin',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0901234567',
                'dia_chi' => '123 Nguyễn Huệ, Q.1, TP.HCM',
                'ngay_sinh' => '1990-01-15',
                'tinh_trang' => 1,
                'id_chuc_vu' => 1,
            ],
            [
                'email' => 'nhanvien@gmail.com',
                'ho_va_ten' => 'Nhân viên',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0901234567',
                'dia_chi' => '123 Nguyễn Huệ, Q.1, TP.HCM',
                'ngay_sinh' => '1990-01-15',
                'tinh_trang' => 0,
                'id_chuc_vu' => 2,
            ],

        ];
        DB::table('nhan_viens')->truncate();
        DB::table('nhan_viens')->delete();
        DB::table('nhan_viens')->insert($nhanVien);
    }
}
