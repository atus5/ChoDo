<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuatChieuSeeder extends Seeder
{
    public function run(): void
    {
        $suatChieu = [];
        $gioChieu = [
            ['bat_dau' => '09:00:00', 'ket_thuc' => '11:00:00'],
            ['bat_dau' => '11:30:00', 'ket_thuc' => '13:30:00'],
            ['bat_dau' => '14:00:00', 'ket_thuc' => '16:00:00'],
            ['bat_dau' => '16:30:00', 'ket_thuc' => '18:30:00'],
            ['bat_dau' => '19:00:00', 'ket_thuc' => '21:00:00'],
            ['bat_dau' => '21:30:00', 'ket_thuc' => '23:30:00'],
        ];

        $ngayChieu = [
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->addDay()->format('Y-m-d'),
            Carbon::now()->addDays(2)->format('Y-m-d'),
        ];

        foreach ($ngayChieu as $ngay) {
            foreach ($gioChieu as $gio) {
                // Suất chiếu cho phim Avengers: Endgame
                $suatChieu[] = [
                    'id_phim' => 1,
                    'id_phong_chieu' => 1,
                    'ngay_chieu' => $ngay,
                    'thoi_gian_bat_dau' => $gio['bat_dau'],
                    'thoi_gian_ket_thuc' => $gio['ket_thuc'],
                    'tinh_trang' => 1,
                ];

                // Suất chiếu cho phim Frozen II
                $suatChieu[] = [
                    'id_phim' => 2,
                    'id_phong_chieu' => 2,
                    'ngay_chieu' => $ngay,
                    'thoi_gian_bat_dau' => $gio['bat_dau'],
                    'thoi_gian_ket_thuc' => $gio['ket_thuc'],
                    'tinh_trang' => 1,
                ];

                // Suất chiếu cho phim The Conjuring
                $suatChieu[] = [
                    'id_phim' => 3,
                    'id_phong_chieu' => 3,
                    'ngay_chieu' => $ngay,
                    'thoi_gian_bat_dau' => $gio['bat_dau'],
                    'thoi_gian_ket_thuc' => $gio['ket_thuc'],
                    'tinh_trang' => 1,
                ];
            }
        }

        DB::table('suat_chieus')->truncate();
        DB::table('suat_chieus')->delete();
        DB::table('suat_chieus')->insert($suatChieu);
    }
}
