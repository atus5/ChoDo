<?php

namespace App\Http\Controllers;

use App\Models\ChiTietKhoGa;
use Illuminate\Http\Request;

class ChiTietKhoGaController extends Controller
{
    // Get all chi tiet kho ga products
    public function getData()
    {
        try {
            $products = ChiTietKhoGa::all();
            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get chi tiet kho ga by id
    public function getChiTiet($id)
    {
        try {
            $product = ChiTietKhoGa::find($id);
            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sản phẩm không tồn tại'
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get products by tinh_trang
    public function getByTinhTrang($tinh_trang)
    {
        try {
            $products = ChiTietKhoGa::where('tinh_trang', $tinh_trang)->get();
            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get dang ban products
    public function getDangBan()
    {
        try {
            // Use Phim model as requested by user
            $products = \App\Models\Phim::where('tinh_trang', 2)->get()->map(function($phim) {
                return [
                    'id' => $phim->id,
                    'ten_kho_ga' => $phim->ten_phim,
                    'mo_ta' => $phim->mo_ta,
                    'hinh_anh' => $phim->hinh_anh,
                    'gia' => $phim->thoi_luong * 1000, // Convert thoi_luong to price estimate
                    'tinh_trang' => $phim->tinh_trang,
                    'loai_vi' => 'Truyền thống',
                    'kich_thuoc' => 'Standard'
                ];
            });
            
            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get sap ban products
    public function getSapBan()
    {
        try {
            // Use Phim model as requested by user
            $products = \App\Models\Phim::where('tinh_trang', 1)->get()->map(function($phim) {
                return [
                    'id' => $phim->id,
                    'ten_kho_ga' => $phim->ten_phim,
                    'mo_ta' => $phim->mo_ta,
                    'hinh_anh' => $phim->hinh_anh,
                    'gia' => $phim->thoi_luong * 1000,
                    'tinh_trang' => $phim->tinh_trang,
                    'loai_vi' => 'Sắp ra mắt',
                    'kich_thuoc' => 'Standard'
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
