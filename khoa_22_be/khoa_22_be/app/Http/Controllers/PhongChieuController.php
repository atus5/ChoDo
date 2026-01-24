<?php

namespace App\Http\Controllers;

use App\Models\PhongChieu;
use Illuminate\Http\Request;

class PhongChieuController extends Controller
{
    public function getData()
    {
        $data = PhongChieu::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        $data = PhongChieu::create([
            'ten_phong'     => $request->ten_phong,
            'hang_ngang'    => $request->hang_ngang,
            'hang_doc'      => $request->hang_doc,
            'tinh_trang'    => $request->tinh_trang
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Thêm phòng chiếu ' . $request->ten_phong . ' thành công',
            'data'      => $data
        ]);
    }

    public function update(Request $request)
    {
        PhongChieu::where('id', $request->id)->update([
            'ten_phong'     => $request->ten_phong,
            'hang_ngang'    => $request->hang_ngang,
            'hang_doc'      => $request->hang_doc,
            'tinh_trang'    => $request->tinh_trang
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Cập nhật phòng chiếu ' . $request->ten_phong . ' thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        PhongChieu::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa phòng chiếu thành công',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = PhongChieu::where('id', $request->id)->first();
        $data->tinh_trang = !$data->tinh_trang;
        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }
}
