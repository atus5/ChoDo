<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\KhachHang;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function binh_luan(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập'
            ], 401);
        }

        $khachHang = KhachHang::where('id_user', $user->id)->first();
        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Khách hàng không tồn tại'
            ], 404);
        }

        DanhGia::create([
            'id_khach_hang' => $khachHang->id,
            'id_phim' => $request->id_phim,
            'noi_dung' => $request->noi_dung_binh_luan,
            'so_sao' => $request->so_sao ?? 5,
            'tinh_trang' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Bình luận thành công'
        ]);
    }

    public function binh_luan_get_data($id_phim)
    {
        $data = DanhGia::where('id_phim', $id_phim)
            ->where('tinh_trang', 1)
            ->join('khach_hangs', 'danh_gias.id_khach_hang', '=', 'khach_hangs.id')
            ->join('users', 'khach_hangs.id_user', '=', 'users.id')
            ->select('danh_gias.*', 'khach_hangs.ho_va_ten', 'users.avatar', 'danh_gias.created_at')
            ->orderBy('danh_gias.created_at', 'DESC')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
