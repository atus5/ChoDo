<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TheLoaiPhimSeeder extends Seeder
{
    public function run(): void
    {
        $theLoaiPhim = [
            [
                'ten_the_loai' => 'Hành động',
                'slug_the_loai' => Str::slug('Hành động'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Kinh dị',
                'slug_the_loai' => Str::slug('Kinh dị'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Tình cảm',
                'slug_the_loai' => Str::slug('Tình cảm'),
                'tinh_trang' => 0,
            ],
            [
                'ten_the_loai' => 'Hoạt hình',
                'slug_the_loai' => Str::slug('Hoạt hình'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Hài hước',
                'slug_the_loai' => Str::slug('Hài hước'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Khoa học viễn tưởng',
                'slug_the_loai' => Str::slug('Khoa học viễn tưởng'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Phiêu lưu',
                'slug_the_loai' => Str::slug('Phiêu lưu'),
                'tinh_trang' => 1,
            ],
            [
                'ten_the_loai' => 'Tâm lý',
                'slug_the_loai' => Str::slug('Tâm lý'),
                'tinh_trang' => 1,
            ],
        ];

        DB::table('the_loai_phims')->truncate();
        DB::table('the_loai_phims')->delete();
        DB::table('the_loai_phims')->insert($theLoaiPhim);
    }
}
