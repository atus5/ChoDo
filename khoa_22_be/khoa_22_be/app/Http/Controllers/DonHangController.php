<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\Ve;
use App\Models\SuatChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonHangController extends Controller
{
    public function getData()
    {
        $data = DonHang::join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->select('don_hangs.*', 'khach_hangs.ho_va_ten', 'khach_hangs.email')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        DonHang::create([
            'id_khach_hang' => $request->id_khach_hang,
            'ma_don_hang' => 'DH-' . Str::random(8),
            'ngay_dat' => now(),
            'tien_thuc_nhan' => $request->tien_thuc_nhan,
            'tong_tien' => $request->tong_tien,
            'giam_gia' => $request->giam_gia ?? 0,
            'is_thanh_toan' => $request->is_thanh_toan ?? 0,
            'id_voucher' => $request->id_voucher ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm đơn hàng thành công',
        ]);
    }

    public function update(Request $request)
    {
        DonHang::where('id', $request->id)->update([
            'id_khach_hang' => $request->id_khach_hang,
            'ngay_dat' => $request->ngay_dat,
            'tien_thuc_nhan' => $request->tien_thuc_nhan,
            'tong_tien' => $request->tong_tien,
            'giam_gia' => $request->giam_gia,
            'is_thanh_toan' => $request->is_thanh_toan,
            'id_voucher' => $request->id_voucher,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật đơn hàng thành công',
        ]);
    }

    public function destroy(Request $request)
    {
        DonHang::where('id', $request->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa đơn hàng thành công',
        ]);
    }

    // Client - Lấy danh sách đơn hàng của user
    public function getDonHangOfUser(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $donHangs = DonHang::where('id_khach_hang', $user->id)
            ->with(['ves' => function($query) {
                $query->join('suat_chieus', 'suat_chieus.id', '=', 'ves.id_suat_chieu')
                    ->join('phims', 'phims.id', '=', 'suat_chieus.id_phim')
                    ->join('phong_chieus', 'phong_chieus.id', '=', 'suat_chieus.id_phong_chieu')
                    ->select('ves.*', 'phims.ten_phim', 'phong_chieus.ten_phong', 'suat_chieus.ngay_chieu', 'suat_chieus.thoi_gian_bat_dau');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $donHangs
        ]);
    }

    // Client - Đặt vé (tạo đơn hàng + vé)
    public function datVe(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $validated = $request->validate([
            'id_suat_chieu' => 'required|integer|exists:suat_chieus,id',
            'danh_sach_ghe' => 'required|array|min:1',
            'danh_sach_ghe.*' => 'required|string',
            'tong_tien' => 'required|integer',
            'id_voucher' => 'nullable|integer',
        ]);

        $suatChieu = SuatChieu::find($validated['id_suat_chieu']);

        if (!$suatChieu) {
            return response()->json([
                'status' => false,
                'message' => 'Suất chiếu không tồn tại'
            ], 404);
        }

        // Check xem ghế đã được đặt chưa
        $bookedGhe = Ve::where('id_suat_chieu', $validated['id_suat_chieu'])
            ->whereIn('ten_ghe', $validated['danh_sach_ghe'])
            ->count();

        if ($bookedGhe > 0) {
            return response()->json([
                'status' => false,
                'message' => 'Một số ghế đã được đặt. Vui lòng chọn ghế khác'
            ], 400);
        }

        try {
            // Tạo đơn hàng
            $donHang = DonHang::create([
                'id_khach_hang' => $user->id,
                'ma_don_hang' => 'DH-' . Str::random(10),
                'ngay_dat' => now(),
                'tien_thuc_nhan' => $validated['tong_tien'],
                'tong_tien' => $validated['tong_tien'],
                'giam_gia' => 0,
                'is_thanh_toan' => 0,
                'id_voucher' => $validated['id_voucher'] ?? null,
            ]);

            // Tạo vé cho từng ghế
            $giaTien = $validated['tong_tien'] / count($validated['danh_sach_ghe']);
            foreach ($validated['danh_sach_ghe'] as $tenGhe) {
                Ve::create([
                    'ma_ve' => 'VE-' . Str::random(10),
                    'gia_ve' => intval($giaTien),
                    'id_don_dat_ve' => $donHang->id,
                    'id_suat_chieu' => $validated['id_suat_chieu'],
                    'ten_ghe' => $tenGhe,
                    'tinh_trang' => 1,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Đặt vé thành công',
                'data' => [
                    'don_hang' => $donHang,
                    'so_ve' => count($validated['danh_sach_ghe'])
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Client - Hủy vé
    public function huyVe(Request $request)
    {
        $user = $request->user();
        $donHangId = $request->id;

        $donHang = DonHang::find($donHangId);

        if (!$donHang || $donHang->id_khach_hang != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Đơn hàng không tồn tại'
            ], 404);
        }

        // Xóa tất cả vé của đơn hàng
        Ve::where('id_don_dat_ve', $donHangId)->delete();

        // Xóa đơn hàng
        $donHang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hủy vé thành công'
        ]);
    }

    // Client - Lấy lịch sử đơn hàng (cho order history dropdown)
    public function getOrderHistory(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $orders = DonHang::where('id_khach_hang', $user->id)
            ->select('id', 'ten_san_pham', 'created_at', 'trang_thai', 'tong_tien')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $orders
        ]);
    }

    // Client - Tạo đơn hàng khô gà
    public function createOrder(Request $request)
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
            'gia_tien' => 'required|integer',
            'ten_nguoi_nhan' => 'required|string',
            'sdt' => 'required|string',
            'dia_chi' => 'required|string',
            'phuong_thuc_giao' => 'required|string',
            'ghi_chu' => 'nullable|string',
            'phuong_thuc_thanh_toan' => 'required|string',
            'giam_gia' => 'nullable|integer',
        ]);

        try {
            $tong_tien = $validated['gia_tien'] - ($validated['giam_gia'] ?? 0);
            
            $donHang = DonHang::create([
                'id_khach_hang' => $user->id,
                'ma_don_hang' => 'DH-' . Str::random(10),
                'ten_san_pham' => $validated['ten_san_pham'],
                'so_luong' => $validated['so_luong'],
                'gia_tien' => $validated['gia_tien'],
                'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
                'sdt' => $validated['sdt'],
                'dia_chi' => $validated['dia_chi'],
                'phuong_thuc_giao' => $validated['phuong_thuc_giao'],
                'ghi_chu' => $validated['ghi_chu'] ?? null,
                'phuong_thuc_thanh_toan' => $validated['phuong_thuc_thanh_toan'],
                'giam_gia' => $validated['giam_gia'] ?? 0,
                'tong_tien' => $tong_tien,
                'tien_thuc_nhan' => $tong_tien,
                'trang_thai' => 'pending',
                'is_thanh_toan' => 0,
                'ngay_dat' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => $donHang
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Client - Lấy chi tiết đơn hàng
    public function getOrderDetail(Request $request)
    {
        $user = $request->user();
        $orderId = $request->id;

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }

        $order = DonHang::where('id', $orderId)
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
}
