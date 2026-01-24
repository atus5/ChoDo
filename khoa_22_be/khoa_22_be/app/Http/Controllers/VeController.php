<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use Illuminate\Http\Request;

class VeController extends Controller
{
    public function getData()
    {
        $data = Ve::join('suat_chieus', 'suat_chieus.id', 'ves.id_suat_chieu')
            ->join('phims', 'phims.id', 'suat_chieus.id_phim')
            ->join('phong_chieus', 'phong_chieus.id', 'suat_chieus.id_phong_chieu')
            ->join('don_hangs', 'don_hangs.id', 'ves.id_don_dat_ve')
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->select('ves.*', 'phims.ten_phim', 'phong_chieus.ten_phong', 'don_hangs.ma_don_hang', 'suat_chieus.thoi_gian_bat_dau', 'suat_chieus.ngay_chieu', 'khach_hangs.ho_va_ten')
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        Ve::create([
            'ma_ve'             => $request->ma_ve,
            'gia_ve'            => $request->gia_ve,
            'id_don_dat_ve'     => $request->id_don_dat_ve,
            'id_suat_chieu'     => $request->id_suat_chieu,
            'ten_ghe'           => $request->ten_ghe,
            'tinh_trang'        => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm vé thành công',
        ]);
    }

    public function update(Request $request)
    {
        Ve::where('id', $request->id)->update([
            'ma_ve'             => $request->ma_ve,
            'gia_ve'            => $request->gia_ve,
            'id_don_dat_ve'     => $request->id_don_dat_ve,
            'id_suat_chieu'     => $request->id_suat_chieu,
            'ten_ghe'           => $request->ten_ghe,
            'tinh_trang'        => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật vé thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        Ve::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa vé thành công',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = Ve::where('id', $request->id)->first();
        if ($data->tinh_trang == 0)
            $data->tinh_trang = 1;
        else if ($data->tinh_trang == 1)
            $data->tinh_trang = 2;
        else
            $data->tinh_trang = 0;

        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }
}
