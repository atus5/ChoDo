<?php

namespace App\Http\Controllers;

use App\Models\KhoGaSapBan;

class KhoGaSapBanController extends Controller
{
    public function getData()
    {
        try {
            $items = KhoGaSapBan::orderByDesc('id')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'ten_phim' => $item->ten_kho_ga,
                    'ten_kho_ga' => $item->ten_kho_ga,
                    'mo_ta' => $item->mo_ta_ngan ?: $item->mo_ta,
                    'hinh_anh' => $item->hinh_anh,
                    'tinh_trang' => $item->tinh_trang ?? 'Sắp bán',
                    'thoi_luong' => $item->gia,
                    'loai_vi' => $item->loai_vi,
                    'dien_vien' => $item->dien_vien,
                    'ngay_phat_hanh' => $item->ngay_phat_hanh,
                    'so_luong_dat_truoc' => $item->so_luong_dat_truoc,
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $items,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể lấy danh sách khô gà sắp bán: ' . $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}
