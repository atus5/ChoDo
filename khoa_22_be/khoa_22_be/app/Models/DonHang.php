<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hangs';
    protected $fillable = [
        'id_khach_hang', 
        'ma_don_hang', 
        'ngay_dat', 
        'tien_thuc_nhan', 
        'tong_tien', 
        'giam_gia', 
        'is_thanh_toan', 
        'id_voucher',
        'ten_san_pham',
        'so_luong',
        'gia_tien',
        'ten_nguoi_nhan',
        'sdt',
        'dia_chi',
        'phuong_thuc_giao',
        'ghi_chu',
        'phuong_thuc_thanh_toan',
        'trang_thai'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'id_khach_hang');
    }

    public function ves()
    {
        return $this->hasMany(Ve::class, 'id_don_dat_ve');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'id_voucher');
    }
}
