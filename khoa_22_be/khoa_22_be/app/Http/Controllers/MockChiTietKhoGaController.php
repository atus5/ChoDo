<?php

namespace App\Http\Controllers;

class MockChiTietKhoGaController extends Controller
{
    // Get all mock kho ga products
    public function getData()
    {
        $products = [
            [
                'id' => 1,
                'ten_kho_ga' => 'Khô Gà Cay Siêu Cấp',
                'mo_ta' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền.',
                'noi_dung' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền. Ăn một cái là đổi màu mặt nhưng vẫn cứ ăn tiếp! Được làm từ gà ta chọn lọc, nướng trên lò than truyền thống, kết hợp với các loại gia vị tây phương.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Sieu+Cap',
                'gia' => 120000,
                'tinh_trang' => 2,
                'loai_vi' => 'Cay siêu cấp',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 245,
                'tong_danh_gia' => 1225,
                'ngay_tao' => '2024-01-15'
            ],
            [
                'id' => 2,
                'ten_kho_ga' => 'Khô Gà Vàng Ươm',
                'mo_ta' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng.',
                'noi_dung' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng. Với công thức bí truyền từ ông bà, mỗi miếng khô gà đều chứa đầy hương vị. Gà ta chọn lọc, nướng thơm vàng ươm, kết hợp với tinh dầu cà chua và các loại gia vị.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Vang+Uom',
                'gia' => 100000,
                'tinh_trang' => 2,
                'loai_vi' => 'Truyền thống',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 156,
                'tong_danh_gia' => 780,
                'ngay_tao' => '2024-01-10'
            ],
            [
                'id' => 3,
                'ten_kho_ga' => 'Khô Gà Nướng Thơm',
                'mo_ta' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm.',
                'noi_dung' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm. Kỹ thuật nướng trên lò than truyền thống tạo nên hương thơm đặc biệt. Mỗi miếng khô gà đều được chọn lọc và nướng tới kỹ lưỡng để đạt độ hoàn hảo.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Nuong+Thom',
                'gia' => 110000,
                'tinh_trang' => 2,
                'loai_vi' => 'Truyền thống',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 89,
                'tong_danh_gia' => 445,
                'ngay_tao' => '2024-01-12'
            ],
            [
                'id' => 4,
                'ten_kho_ga' => 'Khô Gà Chua Cay',
                'mo_ta' => 'Khô gà chua cay kích thích vị giác.',
                'noi_dung' => 'Khô gà chua cay kích thích vị giác. Hỗn hợp vừa chua chua vừa cay cay tạo nên hương vị độc đáo khó quên. Được ủ trong nước chua từ ngải cứu, kết hợp với các loại gia vị đặc biệt.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Chua+Cay',
                'gia' => 130000,
                'tinh_trang' => 2,
                'loai_vi' => 'Chua cay',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 178,
                'tong_danh_gia' => 890,
                'ngay_tao' => '2024-01-08'
            ],
            [
                'id' => 5,
                'ten_kho_ga' => 'Khô Gà Honey Butter',
                'mo_ta' => 'Khô gà vị mật ong bơ mới lạ.',
                'noi_dung' => 'Khô gà vị mật ong bơ mới lạ, kết hợp giữa ngọt ngào và vị bơ béo. Dành cho những ai yêu thích hương vị tây phương nhưng vẫn giữ độ cay nhẹ của khô gà truyền thống.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Honey+Butter',
                'gia' => 140000,
                'tinh_trang' => 2,
                'loai_vi' => 'Honey Butter',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 67,
                'tong_danh_gia' => 335,
                'ngay_tao' => '2024-01-18'
            ]
        ];

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    // Get chi tiet kho ga by id
    public function getChiTiet($id)
    {
        $products = [
            1 => [
                'id' => 1,
                'ten_kho_ga' => 'Khô Gà Cay Siêu Cấp',
                'mo_ta' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền.',
                'noi_dung' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền. Ăn một cái là đổi màu mặt nhưng vẫn cứ ăn tiếp! Được làm từ gà ta chọn lọc, nướng trên lò than truyền thống, kết hợp với các loại gia vị tây phương.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Sieu+Cap',
                'gia' => 120000,
                'tinh_trang' => 2,
                'loai_vi' => 'Cay siêu cấp',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 245,
                'tong_danh_gia' => 1225,
                'ngay_tao' => '2024-01-15'
            ],
            2 => [
                'id' => 2,
                'ten_kho_ga' => 'Khô Gà Vàng Ươm',
                'mo_ta' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng.',
                'noi_dung' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng. Với công thức bí truyền từ ông bà, mỗi miếng khô gà đều chứa đầy hương vị. Gà ta chọn lọc, nướng thơm vàng ươm, kết hợp với tinh dầu cà chua và các loại gia vị.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Vang+Uom',
                'gia' => 100000,
                'tinh_trang' => 2,
                'loai_vi' => 'Truyền thống',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 156,
                'tong_danh_gia' => 780,
                'ngay_tao' => '2024-01-10'
            ]
        ];

        if (!isset($products[$id])) {
            return response()->json([
                'status' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $products[$id]
        ]);
    }

    // Get dang ban products (tinh_trang = 2)
    public function getDangBan()
    {
        $products = [
            [
                'id' => 1,
                'ten_kho_ga' => 'Khô Gà Cay Siêu Cấp',
                'mo_ta' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền.',
                'noi_dung' => 'Khô gà cay siêu cấp từ Chộ Đó, nướng thơm lừng, cay độc quyền. Ăn một cái là đổi màu mặt nhưng vẫn cứ ăn tiếp! Được làm từ gà ta chọn lọc, nướng trên lò than truyền thống, kết hợp với các loại gia vị tây phương.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Sieu+Cap',
                'gia' => 120000,
                'tinh_trang' => 2,
                'loai_vi' => 'Cay siêu cấp',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 245,
                'tong_danh_gia' => 1225,
                'ngay_tao' => '2024-01-15'
            ],
            [
                'id' => 2,
                'ten_kho_ga' => 'Khô Gà Vàng Ươm',
                'mo_ta' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng.',
                'noi_dung' => 'Khô gà vàng ươm, thơm ngon, bổ dưỡng. Với công thức bí truyền từ ông bà, mỗi miếng khô gà đều chứa đầy hương vị. Gà ta chọn lọc, nướng thơm vàng ươm, kết hợp với tinh dầu cà chua và các loại gia vị.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Vang+Uom',
                'gia' => 100000,
                'tinh_trang' => 2,
                'loai_vi' => 'Truyền thống',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 156,
                'tong_danh_gia' => 780,
                'ngay_tao' => '2024-01-10'
            ],
            [
                'id' => 3,
                'ten_kho_ga' => 'Khô Gà Nướng Thơm',
                'mo_ta' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm.',
                'noi_dung' => 'Khô gà nướng thơm lừng, da giòn, thịt mềm. Kỹ thuật nướng trên lò than truyền thống tạo nên hương thơm đặc biệt. Mỗi miếng khô gà đều được chọn lọc và nướng tới kỹ lưỡng để đạt độ hoàn hảo.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Nuong+Thom',
                'gia' => 110000,
                'tinh_trang' => 2,
                'loai_vi' => 'Truyền thống',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 89,
                'tong_danh_gia' => 445,
                'ngay_tao' => '2024-01-12'
            ],
            [
                'id' => 4,
                'ten_kho_ga' => 'Khô Gà Chua Cay',
                'mo_ta' => 'Khô gà chua cay kích thích vị giác.',
                'noi_dung' => 'Khô gà chua cay kích thích vị giác. Hỗn hợp vừa chua chua vừa cay cay tạo nên hương vị độc đáo khó quên. Được ủ trong nước chua từ ngải cứu, kết hợp với các loại gia vị đặc biệt.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Chua+Cay',
                'gia' => 130000,
                'tinh_trang' => 2,
                'loai_vi' => 'Chua cay',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 178,
                'tong_danh_gia' => 890,
                'ngay_tao' => '2024-01-08'
            ]
        ];

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    // Get sap ban products (tinh_trang = 1)
    public function getSapBan()
    {
        $products = [
            [
                'id' => 5,
                'ten_kho_ga' => 'Khô Gà Honey Butter',
                'mo_ta' => 'Khô gà vị mật ong bơ mới lạ.',
                'noi_dung' => 'Khô gà vị mật ong bơ mới lạ, kết hợp giữa ngọt ngào và vị bơ béo. Dành cho những ai yêu thích hương vị tây phương nhưng vẫn giữ độ cay nhẹ của khô gà truyền thống.',
                'hinh_anh' => 'https://via.placeholder.com/400x500?text=Kho+Ga+Honey+Butter',
                'gia' => 140000,
                'tinh_trang' => 1,
                'loai_vi' => 'Honey Butter',
                'kich_thuoc' => 'Standard (200g)',
                'nha_cung_cap' => 'Chộ Đó',
                'luot_danh_gia' => 67,
                'tong_danh_gia' => 335,
                'ngay_tao' => '2024-01-18'
            ]
        ];

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }
}
