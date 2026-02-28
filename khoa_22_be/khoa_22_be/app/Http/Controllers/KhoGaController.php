<?php

namespace App\Http\Controllers;

use App\Models\KhoGa;
use Illuminate\Http\Request;

class KhoGaController extends Controller
{
    public function getData()
    {
        try {
            $data = KhoGa::join('loai_kho_gas', 'kho_gas.id_the_loai',  'loai_kho_gas.id')
                ->select('kho_gas.*', 'kho_gas.ten_kho_ga as ten_phim', 'loai_kho_gas.ten_the_loai')
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
        $tenKhoGa = $request->ten_kho_ga ?? $request->ten_phim;

        KhoGa::create([
            'ten_kho_ga'        => $tenKhoGa,
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
            'message'   => 'Thêm khô gà ' . $tenKhoGa . ' thành công',
        ]);
    }

    public function update(Request $request)
    {
        $tenKhoGa = $request->ten_kho_ga ?? $request->ten_phim;

        KhoGa::where('id', $request->id)->update([
            'ten_kho_ga'        => $tenKhoGa,
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
            'message'   => 'Cập nhật khô gà ' . $tenKhoGa . ' thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        KhoGa::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Xóa phim thành công',
        ]);
    }
    public function changeStatus(Request $request)
    {
        $phim = KhoGa::where('id', $request->id)->first();
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

    // Client - Lấy khô gà đang bán
    public function getPhimDangChieu()
    {
        // Dữ liệu thực tế đang dùng tinh_trang = 1 cho khô gà đang bán
        $data = KhoGa::where('kho_gas.tinh_trang', 1)
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.*', 'kho_gas.ten_kho_ga as ten_phim', 'loai_kho_gas.ten_the_loai')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Client - Lấy tất cả khô gà đang bán và sắp bán
    public function getDataClient()
    {
        // Không lọc tinh_trang vì dữ liệu hiện lưu chuỗi, trả full để frontend tự hiển thị
        $data = KhoGa::join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select(
                'kho_gas.id',
                'kho_gas.ten_kho_ga as ten_phim',
                'kho_gas.hinh_anh',
                'kho_gas.mo_ta',
                'kho_gas.tinh_trang',
                'kho_gas.id_the_loai',
                'kho_gas.thoi_luong',
                'kho_gas.dien_vien',
                'loai_kho_gas.ten_the_loai'
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
        $phim = KhoGa::where('id', $id)
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.*', 'kho_gas.ten_kho_ga as ten_phim', 'loai_kho_gas.ten_the_loai')
            ->first();

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'Khô gà không tồn tại'
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
        
        $phim = KhoGa::where('kho_gas.id', $id)
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.*', 'kho_gas.ten_kho_ga as ten_phim', 'loai_kho_gas.ten_the_loai as the_loai')
            ->first();

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'Khô gà không tồn tại'
            ], 404);
        }

        // Lấy suất chiếu
        $suatChieu = \App\Models\SuatChieu::where('suat_chieus.id_kho_ga', $id)
            ->where('suat_chieus.tinh_trang', '!=', 3)
            ->where('suat_chieus.ngay_chieu', '>=', now()->format('Y-m-d'))
            ->join('phong_chieus', 'suat_chieus.id_phong_chieu', '=', 'phong_chieus.id')
            ->select('suat_chieus.id', 'suat_chieus.id_kho_ga', 'suat_chieus.id_kho_ga as id_phim', 'suat_chieus.id_phong_chieu', 'suat_chieus.ngay_chieu', 'suat_chieus.thoi_gian_bat_dau', 'suat_chieus.thoi_gian_ket_thuc', 'suat_chieus.gia_ve', 'suat_chieus.tinh_trang', 'phong_chieus.ten_phong')
            ->get();

        // Lấy phim khác (cùng thể loại hoặc đang chiếu khác)
        $phimKhac = KhoGa::where('kho_gas.id', '!=', $id)
            ->whereIn('kho_gas.tinh_trang', [1, 2])
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.*', 'kho_gas.ten_kho_ga as ten_phim', 'loai_kho_gas.ten_the_loai')
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
        // Khô gà đang bán (tinh_trang = 2)
        $phimDangChieu = KhoGa::where('kho_gas.tinh_trang', 2)
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.id', 'kho_gas.ten_kho_ga as ten_phim', 'kho_gas.hinh_anh', 'kho_gas.mo_ta', 'kho_gas.tinh_trang', 'kho_gas.id_the_loai', 'loai_kho_gas.ten_the_loai as the_loai')
            ->limit(8)
            ->get();

        // Khô gà sắp bán (tinh_trang = 1)
        $phimSapChieu = KhoGa::where('kho_gas.tinh_trang', 1)
            ->join('loai_kho_gas', 'kho_gas.id_the_loai', '=', 'loai_kho_gas.id')
            ->select('kho_gas.id', 'kho_gas.ten_kho_ga as ten_phim', 'kho_gas.hinh_anh', 'kho_gas.mo_ta', 'kho_gas.tinh_trang', 'kho_gas.id_the_loai', 'loai_kho_gas.ten_the_loai as the_loai')
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

    // Client - Danh sách loại khô gà từ bảng kho_gas
    public function getLoaiKhoGa()
    {
        try {
            $data = KhoGa::select('id', 'ten_kho_ga as ten_phim', 'hinh_anh', 'mo_ta', 'tinh_trang', 'rate', 'thoi_luong', 'dien_vien')
                ->orderBy('id')
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
}
