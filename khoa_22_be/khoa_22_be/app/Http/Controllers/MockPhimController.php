<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockPhimController extends Controller
{
    public function getData()
    {
        $mockData = [
            [
                'id' => 1,
                'ten_phim' => 'Khô Gà Siêu Cấp',
                'dao_dien' => 'Đạo diễn A',
                'dien_vien' => 'Diễn viên A',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Sieu+Cap',
                'ngay_phat_hanh' => '2025-01-15',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'thoi_luong' => 120,
                'mo_ta' => 'Khô gà siêu cấp với hương vị tuyệt vời',
                'noi_dung' => 'Đây là một sản phẩm khô gà chất lượng cao, được chế biến từ các nguyên liệu tốt nhất',
                'tinh_trang' => 2,
                'trailer' => 'https://www.youtube.com/watch?v=example',
                'ten_the_loai' => 'Thực phẩm'
            ],
            [
                'id' => 2,
                'ten_phim' => 'Khô Gà Vàng Ươm',
                'dao_dien' => 'Đạo diễn B',
                'dien_vien' => 'Diễn viên B',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Vang+Uom',
                'ngay_phat_hanh' => '2025-02-20',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'thoi_luong' => 100,
                'mo_ta' => 'Khô gà vàng ươm, ngon tuyệt cú mèo',
                'noi_dung' => 'Sản phẩm được chế biến theo công thức truyền thống',
                'tinh_trang' => 1,
                'trailer' => 'https://www.youtube.com/watch?v=example2',
                'ten_the_loai' => 'Thực phẩm'
            ],
            [
                'id' => 3,
                'ten_phim' => 'Khô Gà Nướng Thơm',
                'dao_dien' => 'Đạo diễn C',
                'dien_vien' => 'Diễn viên C',
                'hinh_anh' => 'https://via.placeholder.com/300x450?text=Kho+Ga+Nuong+Thom',
                'ngay_phat_hanh' => '2025-03-10',
                'quoc_gia' => 'Việt Nam',
                'ngon_ngu' => 'Tiếng Việt',
                'thoi_luong' => 110,
                'mo_ta' => 'Khô gà nướng với hương thơm đặc biệt',
                'noi_dung' => 'Được nướng bằng phương pháp truyền thống để giữ nguyên hương vị',
                'tinh_trang' => 2,
                'trailer' => 'https://www.youtube.com/watch?v=example3',
                'ten_the_loai' => 'Thực phẩm'
            ]
        ];

        return response()->json([
            'status' => true,
            'data' => $mockData
        ]);
    }
}
