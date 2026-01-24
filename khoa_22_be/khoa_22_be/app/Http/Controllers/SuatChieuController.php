<?php

namespace App\Http\Controllers;

use App\Models\SuatChieu;
use Illuminate\Http\Request;

class SuatChieuController extends Controller
{
    public function getData()
    {
        $suatChieu = SuatChieu::join('phims', 'phims.id', 'suat_chieus.id_phim')
            ->join('phong_chieus', 'phong_chieus.id', 'suat_chieus.id_phong_chieu')
            ->select('suat_chieus.*', 'phims.ten_phim', 'phong_chieus.ten_phong')
            ->get();
        return response()->json([
            'data' => $suatChieu
        ]);
    }

    public function addData(Request $request)
    {
        SuatChieu::create([
            'id_phim'           => $request->id_phim,
            'id_phong_chieu'    => $request->id_phong_chieu,
            'ngay_chieu'        => $request->ngay_chieu,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
            'tinh_trang'        => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm suất chiếu thành công',
        ]);
    }

    public function update(Request $request)
    {
        SuatChieu::where('id', $request->id)->update([
            'id_phim'           => $request->id_phim,
            'id_phong_chieu'    => $request->id_phong_chieu,
            'ngay_chieu'        => $request->ngay_chieu,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
            'tinh_trang'        => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật suất chiếu thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        SuatChieu::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa suất chiếu thành công',
        ]);
    }
    public function changeStatus(Request $request)
    {
        $data = SuatChieu::where('id', $request->id)->first();
        $data->tinh_trang = !$data->tinh_trang;
        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }

    // Client - Lấy danh sách ghế của suất chiếu
    public function getGheOfSuatChieu($id)
    {
        $suatChieu = SuatChieu::find($id);

        if (!$suatChieu) {
            return response()->json([
                'status' => false,
                'message' => 'Suất chiếu không tồn tại'
            ], 404);
        }

        // Lấy tất cả ghế trong phòng
        $allGhe = \App\Models\Ghe::where('id_phong_chieu', $suatChieu->id_phong_chieu)
            ->select('id', 'ten_ghe', 'tinh_trang', 'id_phong_chieu')
            ->get();

        // Lấy những ghế đã được đặt cho suất chiếu này
        $bookedGhe = \App\Models\Ve::where('id_suat_chieu', $id)
            ->pluck('ten_ghe')
            ->toArray();

        // Thêm trạng thái booked cho mỗi ghế
        foreach ($allGhe as $ghe) {
            $ghe->is_booked = in_array($ghe->ten_ghe, $bookedGhe);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'suat_chieu' => $suatChieu,
                'ghes' => $allGhe
            ]
        ]);
    }
}
