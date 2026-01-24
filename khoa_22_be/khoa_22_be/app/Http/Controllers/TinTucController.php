<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function getData()
    {
        $data = TinTuc::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        $data = TinTuc::create([
            'tieu_de'           => $request->tieu_de,
            'noi_dung'          => $request->noi_dung,
            'hinh_anh'          => $request->hinh_anh,
            'is_noi_bat'        => $request->is_noi_bat,
            'tinh_trang'        => $request->tinh_trang
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Thêm tin tức thành công',
        ]);
    }

    public function update(Request $request)
    {
        TinTuc::where('id', $request->id)->update([
            'tieu_de'           => $request->tieu_de,
            'noi_dung'          => $request->noi_dung,
            'hinh_anh'          => $request->hinh_anh,
            'is_noi_bat'        => $request->is_noi_bat,
            'tinh_trang'        => $request->tinh_trang
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Cập nhật tin tức thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        TinTuc::where('id', $request->id)->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Xóa tin tức thành công',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = TinTuc::where('id', $request->id)->first();
        $data->tinh_trang = !$data->tinh_trang;
        $data->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Thay đổi trạng thái thành công',
        ]);
    }
}
