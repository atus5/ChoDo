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
            $products = ChiTietKhoGa::where('tinh_trang', 2)->get();
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
            $products = ChiTietKhoGa::where('tinh_trang', 1)->get();
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
