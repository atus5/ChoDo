<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MockDonHangController extends Controller
{
    // Mock data storage
    private static $orders = [];
    private static $nextId = 1;

    public function getData()
    {
        return response()->json([
            'status' => true,
            'data' => [
                [
                    'id' => 1,
                    'ma_don_hang' => 'KHO-GA-001',
                    'ten_san_pham' => 'Khô Gà Cay Siêu Cấp',
                    'so_luong' => 2,
                    'gia_tien' => 240000,
                    'ten_nguoi_nhan' => 'Nguyễn Văn A',
                    'sdt' => '0912345678',
                    'dia_chi' => 'Số 1 Đường Chộ Đó, Hà Nội',
                    'phuong_thuc_giao' => 'express',
                    'trang_thai' => 'Chờ xác nhận',
                    'ngay_tao' => '2024-01-20 10:30:00'
                ]
            ]
        ]);
    }

    public function create(Request $request)
    {
        try {
            // Get request data
            $ten_san_pham = $request->input('ten_san_pham', 'Khô Gà Chộ Đó');
            $so_luong = $request->input('so_luong', 1);
            $gia_tien = $request->input('gia_tien', 0);
            $ten_nguoi_nhan = $request->input('ten_nguoi_nhan', 'Khách hàng');
            $sdt = $request->input('sdt', '0000000000');
            $dia_chi = $request->input('dia_chi', 'Hà Nội');
            $phuong_thuc_giao = $request->input('phuong_thuc_giao', 'express');
            $phuong_thuc_thanh_toan = $request->input('phuong_thuc_thanh_toan', 'card');

            // Create mock order
            $orderId = 'KHO-GA-' . str_pad(self::$nextId++, 3, '0', STR_PAD_LEFT);
            
            $order = [
                'id' => self::$nextId - 1,
                'ma_don_hang' => $orderId,
                'ten_san_pham' => $ten_san_pham,
                'so_luong' => $so_luong,
                'gia_tien' => $gia_tien,
                'ten_nguoi_nhan' => $ten_nguoi_nhan,
                'sdt' => $sdt,
                'dia_chi' => $dia_chi,
                'phuong_thuc_giao' => $phuong_thuc_giao,
                'phuong_thuc_thanh_toan' => $phuong_thuc_thanh_toan,
                'trang_thai' => 'Chờ xác nhận',
                'ghi_chu' => $request->input('ghi_chu', ''),
                'giam_gia' => $request->input('giam_gia', 0),
                'ngay_tao' => now()->format('Y-m-d H:i:s')
            ];

            return response()->json([
                'status' => true,
                'message' => 'Đơn hàng được tạo thành công!',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi tạo đơn hàng: ' . $e->getMessage()
            ], 400);
        }
    }

    public function addData(Request $request)
    {
        return $this->create($request);
    }

    public function update(Request $request)
    {
        try {
            // Mock update - just return success
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật đơn hàng thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi cập nhật đơn hàng: ' . $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Mock delete - just return success
            return response()->json([
                'status' => true,
                'message' => 'Xóa đơn hàng thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi xóa đơn hàng: ' . $e->getMessage()
            ], 400);
        }
    }

    public function getOrderById($id)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'id' => $id,
                'ma_don_hang' => 'KHO-GA-' . str_pad($id, 3, '0', STR_PAD_LEFT),
                'ten_san_pham' => 'Khô Gà Cay Siêu Cấp',
                'so_luong' => 2,
                'gia_tien' => 240000,
                'ten_nguoi_nhan' => 'Nguyễn Văn A',
                'sdt' => '0912345678',
                'dia_chi' => 'Số 1 Đường Chộ Đó, Hà Nội',
                'phuong_thuc_giao' => 'express',
                'trang_thai' => 'Chờ xác nhận',
                'ngay_tao' => '2024-01-20 10:30:00'
            ]
        ]);
    }
}
