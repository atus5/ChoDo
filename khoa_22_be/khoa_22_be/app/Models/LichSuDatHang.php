<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuDatHang extends Model
{
    protected $table = 'lich_su_dat_hang';

    protected $fillable = [
        'id_khach_hang',
        'ten_tai_khoan',
        'email',
        'ma_don_hang',
        'ten_san_pham',
        'so_luong',
        'gia_don_vi',
        'tong_tien',
        'trang_thai',
        'hinh_anh',
        'vi',
        'kich_thuoc',
        'ghi_chu',
        'ten_nguoi_nhan',
        'sdt',
        'dia_chi',
        'phuong_thuc_giao',
        'phuong_thuc_thanh_toan',
    ];
}
