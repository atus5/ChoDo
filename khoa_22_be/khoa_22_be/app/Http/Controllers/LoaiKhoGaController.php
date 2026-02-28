<?php

namespace App\Http\Controllers;

use App\Models\LoaiKhoGa;
use Illuminate\Http\Request;

class LoaiKhoGaController extends Controller
{
    public function getData()
    {
        $data = LoaiKhoGa::all();

        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        LoaiKhoGa::create([
            'ten_the_loai'  => $request->ten_the_loai,
            'slug_the_loai' => $request->slug_the_loai,
            'tinh_trang'    => $request->tinh_trang
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Loại Khô Gà ' . $request->ten_the_loai . ' thành công',
        ]);
    }

    public function update(Request $request)
    {
        LoaiKhoGa::where('id', $request->id)->update([
            'ten_the_loai'  => $request->ten_the_loai,
            'slug_the_loai' => $request->slug_the_loai,
            'tinh_trang'    => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật Loại Khô Gà ' . $request->ten_the_loai . ' thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        LoaiKhoGa::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa Loại Khô Gà thành công',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = LoaiKhoGa::where('id', $request->id)->first();
        $data->tinh_trang = !$data->tinh_trang;
        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }
}
