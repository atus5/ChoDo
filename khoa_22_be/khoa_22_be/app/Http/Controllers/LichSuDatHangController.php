<?php

namespace App\Http\Controllers;

use App\Models\LichSuDatHang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LichSuDatHangController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $limit = (int) $request->query('limit', 10);
        $limit = max(1, min($limit, 50));

        $orders = LichSuDatHang::where('id_khach_hang', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $orders
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $order = LichSuDatHang::where('id', $id)
            ->where('id_khach_hang', $user->id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng không tồn tại'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $order
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $validated = $request->validate([
            'ten_san_pham' => 'required|string',
            'so_luong' => 'required|integer|min:1',
            'gia_don_vi' => 'nullable|integer',
            'tong_tien' => 'required|integer',
            'trang_thai' => 'nullable|string',
            'hinh_anh' => 'nullable|string',
            'vi' => 'nullable|string',
            'kich_thuoc' => 'nullable|string',
            'ghi_chu' => 'nullable|string',
            'ten_nguoi_nhan' => 'nullable|string',
            'sdt' => 'nullable|string',
            'dia_chi' => 'nullable|string',
            'phuong_thuc_giao' => 'nullable|string',
            'phuong_thuc_thanh_toan' => 'nullable|string',
        ]);

        $order = LichSuDatHang::create([
            'id_khach_hang' => $user->id,
            'ten_tai_khoan' => $user->ho_va_ten,
            'email' => $user->email,
            'ma_don_hang' => 'DH-' . Str::random(10),
            'ten_san_pham' => $validated['ten_san_pham'],
            'so_luong' => $validated['so_luong'],
            'gia_don_vi' => $validated['gia_don_vi'] ?? 0,
            'tong_tien' => $validated['tong_tien'],
            'trang_thai' => $validated['trang_thai'] ?? 'paid',
            'hinh_anh' => $validated['hinh_anh'] ?? null,
            'vi' => $validated['vi'] ?? null,
            'kich_thuoc' => $validated['kich_thuoc'] ?? null,
            'ghi_chu' => $validated['ghi_chu'] ?? null,
            'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'] ?? null,
            'sdt' => $validated['sdt'] ?? null,
            'dia_chi' => $validated['dia_chi'] ?? null,
            'phuong_thuc_giao' => $validated['phuong_thuc_giao'] ?? null,
            'phuong_thuc_thanh_toan' => $validated['phuong_thuc_thanh_toan'] ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Lưu lịch sử đặt hàng thành công',
            'data' => $order
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $order = LichSuDatHang::where('id', $id)
            ->where('id_khach_hang', $user->id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng không tồn tại'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa lịch sử đơn hàng thành công'
        ]);
    }
}
