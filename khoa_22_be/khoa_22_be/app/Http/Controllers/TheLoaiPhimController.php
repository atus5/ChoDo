<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiPhim;
use Illuminate\Http\Request;

class TheLoaiPhimController extends Controller
{
    public function getData()
    {
        $data = TheLoaiPhim::all();

        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        TheLoaiPhim::create([
            'ten_the_loai'  => $request->ten_the_loai,
            'slug_the_loai' => $request->slug_the_loai,
            'tinh_trang'    => $request->tinh_trang
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Thể Loại Phim ' . $request->ten_the_loai . ' thành công',
        ]);
    }

    public function update(Request $request)
    {
        TheLoaiPhim::where('id', $request->id)->update([
            'ten_the_loai'  => $request->ten_the_loai,
            'slug_the_loai' => $request->slug_the_loai,
            'tinh_trang'    => $request->tinh_trang
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật Thể Loại Phim ' . $request->ten_the_loai . ' thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        TheLoaiPhim::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa Thể Loại Phim thành công',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = TheLoaiPhim::where('id', $request->id)->first();
        $data->tinh_trang = !$data->tinh_trang;
        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }
}
