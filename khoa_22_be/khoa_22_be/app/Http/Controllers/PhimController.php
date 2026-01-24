<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use Illuminate\Http\Request;

class PhimController extends Controller
{
    public function getData()
    {
        $data = Phim::join('the_loai_phims', 'phims.id_the_loai',  'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
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
        $data = Phim::where('tinh_trang', 2)
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
            ->with(['suatChieu' => function($query) {
                $query->where('tinh_trang', '!=', 3) // Không lấy suất chiếu đã qua
                    ->where('ngay_chieu', '>=', now()->format('Y-m-d'))
                    ->join('phong_chieus', 'suat_chieus.id_phong_chieu', '=', 'phong_chieus.id')
                    ->select('suat_chieus.*', 'phong_chieus.ten_phong');
            }])
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Client - Lấy tất cả phim đang chiếu và sắp chiếu
    public function getDataClient()
    {
        $data = Phim::whereIn('phims.tinh_trang', [1, 2])
            ->join('the_loai_phims', 'phims.id_the_loai', '=', 'the_loai_phims.id')
            ->select('phims.*', 'the_loai_phims.ten_the_loai')
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
    public function getChiTietPhimData(Request $request)
    {
        $id = $request->id;
        
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
}
