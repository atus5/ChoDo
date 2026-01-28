<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhoGaSapBan;

class KhoGaSapBanSeeder extends Seeder
{
    public function run(): void
    {
        KhoGaSapBan::query()->delete();

        $items = [
            [
                'ten_kho_ga' => 'Khô gà sắp bán - vị chanh sả',
                'mo_ta' => 'Hương vị chanh sả thanh mát, thơm dịu, chuẩn bị ra mắt.',
                'mo_ta_ngan' => 'Chanh sả thanh mát, thơm dịu, sắp ra mắt.',
                'hinh_anh' => 'https://images.unsplash.com/photo-1555939594-58d7cb561af1?w=1200&h=800&fit=crop',
                'gia' => 39000,
                'loai_vi' => 'Chanh sả',
                'dien_vien' => 'Ức gà xé, lá chanh, sả, ớt',
                'ngay_phat_hanh' => now()->addDays(7)->toDateString(),
                'so_luong_dat_truoc' => 120,
            ],
            [
                'ten_kho_ga' => 'Khô gà sắp bán - vị bơ tỏi',
                'mo_ta' => 'Bơ tỏi béo thơm, hậu vị đậm đà.',
                'mo_ta_ngan' => 'Bơ tỏi béo thơm, hậu vị đậm.',
                'hinh_anh' => 'https://images.unsplash.com/photo-1585521537411-16b2d6ea1cc5?w=1200&h=800&fit=crop',
                'gia' => 42000,
                'loai_vi' => 'Bơ tỏi',
                'dien_vien' => 'Ức gà, bơ, tỏi Lý Sơn, tiêu đen',
                'ngay_phat_hanh' => now()->addDays(10)->toDateString(),
                'so_luong_dat_truoc' => 86,
            ],
            [
                'ten_kho_ga' => 'Khô gà sắp bán - vị cay Hàn',
                'mo_ta' => 'Cay nồng kiểu Hàn, tê tê đầu lưỡi.',
                'mo_ta_ngan' => 'Cay Hàn tê tê, thơm nồng.',
                'hinh_anh' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc46e?w=1200&h=800&fit=crop',
                'gia' => 45000,
                'loai_vi' => 'Cay Hàn',
                'dien_vien' => 'Ức gà, ớt bột Hàn, mật ong, tỏi',
                'ngay_phat_hanh' => now()->addDays(14)->toDateString(),
                'so_luong_dat_truoc' => 64,
            ],
        ];

        foreach ($items as $item) {
            KhoGaSapBan::create($item);
        }
    }
}
