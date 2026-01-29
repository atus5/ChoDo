<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use Illuminate\Http\Request;

class PhimController extends Controller
{
    public function getData()
    {
        try {
            $data = Phim::join('the_loai_phims', 'phims.id_the_loai',  'the_loai_phims.id')
                ->select('phims.*', 'the_loai_phims.ten_the_loai')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Database error: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    public function addData(Request $request)
    {
        Phim::create([
            'ten_phim'          => $request->ten_phim,
            'dao_dien'          => $request->dao_dien,
            'dien_vien'         => $request->dien_vien,
            'ngay_phat_hanh'    => $request->ngay_phat_hanh,
            'thoi_luong'        => $request->thoi_luong,
            'mo_ta'             => $request->mo_ta,
            'noi_dung'          => $request->noi_dung,
            'hinh_anh'          => $request->hinh_anh,
            'trailer'           => $request->trailer,
            'quoc_gia'          => $request->quoc_gia,
            'ngon_ngu'          => $request->ngon_ngu,
            'nha_san_xuat'      => $request->nha_san_xuat,
            'tinh_trang'        => $request->tinh_trang,
            'id_the_loai'       => $request->id_the_loai,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Thêm phim ' . $request->ten_phim . ' thành công',
        ]);
    }

    public function update(Request $request)
    {
        Phim::where('id', $request->id)->update([
            'ten_phim'          => $request->ten_phim,
            'dao_dien'          => $request->dao_dien,
            'dien_vien'         => $request->dien_vien,
            'ngay_phat_hanh'    => $request->ngay_phat_hanh,
            'thoi_luong'        => $request->thoi_luong,
            'mo_ta'             => $request->mo_ta,
            'noi_dung'          => $request->noi_dung,
            'hinh_anh'          => $request->hinh_anh,
            'trailer'           => $request->trailer,
            'quoc_gia'          => $request->quoc_gia,
            'ngon_ngu'          => $request->ngon_ngu,
            'nha_san_xuat'      => $request->nha_san_xuat,
            'tinh_trang'        => $request->tinh_trang,
            'id_the_loai'       => $request->id_the_loai,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Cập nhật phim ' . $request->ten_phim . ' thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        Phim::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Xóa phim thành công',
        ]);
    }
    public function changeStatus(Request $request)
    {
        $phim = Phim::where('id', $request->id)->first();
        if($phim->tinh_trang == 0)
            $phim->tinh_trang = 1;
        else if($phim->tinh_trang == 1)
            $phim->tinh_trang = 2;
        else
            $phim->tinh_trang = 0;


        $phim->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }

    // Client - Lấy phim đang chiếu với suất chiếu
    public function getPhimDangChieu()
    {
        // Dữ liệu thực tế đang dùng tinh_trang = 1 cho khô gà đang bán
        $data = Phim::where('phims.tinh_trang', 1)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Client - Lấy tất cả phim đang chiếu và sắp chiếu
    public function getDataClient()
    {
        // Không lọc tinh_trang vì dữ liệu hiện lưu chuỗi, trả full để frontend tự hiển thị
        $data = Phim::join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select(
                'phims.id',
                'phims.ten_phim',
                'phims.hinh_anh',
                'phims.mo_ta',
                'phims.tinh_trang',
                'phims.id_the_loai',
                'phims.thoi_luong',
                'phims.dien_vien',
                'the_loai_phims.ten_the_loai'
            )
            ->limit(20)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Client - Lấy chi tiết phim
    public function getChiTietPhim($id)
    {
        $phim = Phim::where('id', $id)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
            ->first();

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'Phim không tồn tại'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $phim
        ]);
    }

    // Client - Lấy chi tiết phim + suất chiếu + phim khác
    public function getChiTietPhimData(Request $request, $id = null)
    {
        // Handle both GET parameter and POST body
        if ($id === null) {
            $id = $request->id;
        }
        
        $phim = Phim::where('phims.id', $id)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai as the_loai')
            ->first();

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'Phim không tồn tại'
            ], 404);
        }

        // Lấy suất chiếu
        $suatChieu = \App\Models\SuatChieu::where('suat_chieus.id_phim', $id)
            ->where('suat_chieus.tinh_trang', '!=', 3)
            ->where('suat_chieus.ngay_chieu', '>=', now()->format('Y-m-d'))
            ->join('phong_chieus', 'suat_chieus.id_phong_chieu', '=', 'phong_chieus.id')
            ->select('suat_chieus.id', 'suat_chieus.id_phim', 'suat_chieus.id_phong_chieu', 'suat_chieus.ngay_chieu', 'suat_chieus.thoi_gian_bat_dau', 'suat_chieus.thoi_gian_ket_thuc', 'suat_chieus.gia_ve', 'suat_chieus.tinh_trang', 'phong_chieus.ten_phong')
            ->get();

        // Lấy phim khác (cùng thể loại hoặc đang chiếu khác)
        $phimKhac = Phim::where('phims.id', '!=', $id)
            ->whereIn('phims.tinh_trang', [1, 2])
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
            ->limit(4)
            ->get();

        return response()->json([
            'status' => true,
            'data_phim' => $phim,
            'data_suat_chieu' => $suatChieu,
            'list_phim_khac' => $phimKhac
        ]);
    }

    // Client - Home page
    public function homePage()
    {
        // Phim đang chiếu (tinh_trang = 2)
        $phimDangChieu = Phim::where('phims.tinh_trang', 2)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.id', 'phims.ten_phim', 'phims.hinh_anh', 'phims.mo_ta', 'phims.tinh_trang', 'phims.id_the_loai', 'the_loai_phims.ten_the_loai as the_loai')
            ->limit(8)
            ->get();

        // Phim sắp chiếu (tinh_trang = 1)
        $phimSapChieu = Phim::where('phims.tinh_trang', 1)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.id', 'phims.ten_phim', 'phims.hinh_anh', 'phims.mo_ta', 'phims.tinh_trang', 'phims.id_the_loai', 'the_loai_phims.ten_the_loai as the_loai')
            ->limit(4)
            ->get();

        // Merge data for frontend compatibility
        $allPhims = $phimDangChieu->concat($phimSapChieu);

        // Mock blog articles data (static for now)
        $articles = [
            [
                'id' => 1,
                'tieu_de' => 'Bí Quyết Ướp Khô Gà Cay Siêu Cấp Chuẩn Chộ Đó',
                'mo_ta_ngan' => 'Khô gà cay siêu cấp không chỉ là một món ăn vặt, mà còn là một nghệ thuật...',
                'hinh_anh' => 'https://picsum.photos/800/400?random=1'
            ],
            [
                'id' => 2,
                'tieu_de' => 'Khô Gà Nướng Thơm: Lợi Ích Sức Khỏe Bạn Không Nên Bỏ Qua',
                'mo_ta_ngan' => 'Khô gà không chỉ ngon miệng mà còn tốt cho sức khỏe...',
                'hinh_anh' => 'https://picsum.photos/800/400?random=2'
            ],
            [
                'id' => 3,
                'tieu_de' => '5 Cách Ăn Khô Gà Sáng Tạo Bạn Chưa Bao Giờ Thử',
                'mo_ta_ngan' => 'Từ khô gà xào rau, khô gà làm snack, đến khô gà nạp cơm...',
                'hinh_anh' => 'https://picsum.photos/800/400?random=3'
            ],
            [
                'id' => 4,
                'tieu_de' => 'Cách Bảo Quản Khô Gà Tươi Lâu Ngon Như Mới',
                'mo_ta_ngan' => 'Học những cách bảo quản khô gà đúng cách để giữ độ giòn...',
                'hinh_anh' => 'https://picsum.photos/800/400?random=4'
            ],
            [
                'id' => 5,
                'tieu_de' => 'Khô Gà Sấy Lạnh Chống Ung Thư?',
                'mo_ta_ngan' => 'Một nghiên cứu mới cho thấy khô gà sấy lạnh có chứa các chất chống oxy hóa...',
                'hinh_anh' => 'https://picsum.photos/800/400?random=5'
            ],
            [
                'id' => 6,
                'tieu_de' => 'Startup Khô Gà Tây Bắc Gây Sốt',
                'mo_ta_ngan' => 'Khô gà từ Chộ Đó vừa lên Top 1 trên Google Trends...',
                'hinh_anh' => 'https://vigift.vn/wp-content/uploads/2022/08/an-kho-ga-co-map-khong-2-768x899.jpg'
            ]
        ];

        return response()->json([
            'status' => true,
            'data_phim' => $allPhims,
            'data_bv' => $articles,
            'phim_dang_chieu' => $phimDangChieu,
            'phim_sap_chieu' => $phimSapChieu
        ]);
    }
}
