<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phims')->insert([
            [
                'ten_phim' => 'Khô Gà Cay Siêu Cấp',
                'dao_dien' => 'Chủ nhà hàng',
                'dien_vien' => 'Khô gà ta nướng',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Sieu+Cap',
                'trailer' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'ngay_phat_hanh' => '2025-01-01',
                'thoi_luong' => 120,
                'mo_ta' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền.',
                'noi_dung' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền. Ăn một cái là đổi màu mặt nhưng vẫn cứ ăn tiếp! Được làm từ gà ta chọn lọc, nướng trên lò than truyền thống, kết hợp với các loại gia vị tây phương.',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'nha_san_xuat' => 'Chộ Đó Restaurant',
                'tinh_trang' => 2,
                'id_the_loai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_phim' => 'Khô Gà Vàng Ươm',
                'dao_dien' => 'Đầu bếp hàng',
                'dien_vien' => 'Gà ta nướng',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Vang+Uom',
                'trailer' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'ngay_phat_hanh' => '2025-01-05',
                'thoi_luong' => 100,
                'mo_ta' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng.',
                'noi_dung' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng. Với công thức bí truyền từ ông bà, mỗi miếng khô gà đều chứa đầy hương vị. Gà ta chọn lọc, nướng thơm vàng ươm, kết hợp với tinh dầu cà chua và các loại gia vị.',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'nha_san_xuat' => 'Chộ Đó Restaurant',
                'tinh_trang' => 2,
                'id_the_loai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_phim' => 'Khô Gà Nướng Thơm',
                'dao_dien' => 'Bếp trưởng',
                'dien_vien' => 'Lò nướng truyền thống',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Nuong+Thom',
                'trailer' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'ngay_phat_hanh' => '2025-01-10',
                'thoi_luong' => 150,
                'mo_ta' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm.',
                'noi_dung' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm. Kỹ thuật nướng trên lò than truyền thống tạo nên hương thơm đặc biệt. Mỗi miếng khô gà đều được chọn lọc và nướng tới kỹ lưỡng để đạt độ hoàn hảo.',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'nha_san_xuat' => 'Chộ Đó Restaurant',
                'tinh_trang' => 1,
                'id_the_loai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_phim' => 'Khô Gà Chua Cay',
                'dao_dien' => 'Bếp gia truyền',
                'dien_vien' => 'Nước chua từ ngải cứu',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Chua+Cay',
                'trailer' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'ngay_phat_hanh' => '2025-01-15',
                'thoi_luong' => 130,
                'mo_ta' => 'Khô gà chua cay kích thích vị giác.',
                'noi_dung' => 'Khô gà chua cay kích thích vị giác. Hỗn hợp vừa chua chua vừa cay cay tạo nên hương vị độc đáo khó quên. Được ủ trong nước chua từ ngải cứu, kết hợp với các loại gia vị đặc biệt.',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'nha_san_xuat' => 'Chộ Đó Restaurant',
                'tinh_trang' => 2,
                'id_the_loai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_phim' => 'Khô Gà Sắp Tới',
                'dao_dien' => 'Thợ nướng tài ba',
                'dien_vien' => 'Gà ta chọn lọc',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Sap+Toi',
                'trailer' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'ngay_phat_hanh' => '2025-02-01',
                'thoi_luong' => 140,
                'mo_ta' => 'Khô gà với công thức mới lạ sắp ra mắt.',
                'noi_dung' => 'Khô gà với công thức mới lạ sắp ra mắt. Kết hợp các loại gia vị tây phương với nước sốt truyền thống. Đây sẽ là một sáng tạo mới mẻ trong lĩnh vực chế biến khô gà tại Việt Nam.',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'nha_san_xuat' => 'Chộ Đó Restaurant',
                'tinh_trang' => 1,
                'id_the_loai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
