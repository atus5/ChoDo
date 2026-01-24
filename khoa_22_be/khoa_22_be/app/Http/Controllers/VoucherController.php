<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function getData()
    {
        $data = Voucher::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        Voucher::create([
            'ma_code'               => $request->ma_code,
            'thoi_gian_bat_dau'     => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc'    => $request->thoi_gian_ket_thuc,
            'loai_giam'             => $request->loai_giam,
            'so_giam_gia'           => $request->so_giam_gia,
            'so_tien_toi_da'        => $request->so_tien_toi_da,
            've_toi_thieu'          => $request->ve_toi_thieu,
            'tinh_trang'            => $request->tinh_trang
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm voucher thành công',
        ]);
    }


    public function update(Request $request)
    {
        Voucher::where('id', $request->id)->update([
            'ma_code'               => $request->ma_code,
            'thoi_gian_bat_dau'     => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc'    => $request->thoi_gian_ket_thuc,
            'loai_giam'             => $request->loai_giam,
            'so_giam_gia'           => $request->so_giam_gia,
            'so_tien_toi_da'        => $request->so_tien_toi_da,
            've_toi_thieu'          => $request->ve_toi_thieu,
            'tinh_trang'            => $request->tinh_trang
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Cập nhật voucher thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        Voucher::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa voucher thành công',
        ]);
    }
}
