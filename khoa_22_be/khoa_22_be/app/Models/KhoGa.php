<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhoGa extends Model
{
    protected $table = 'kho_gas';
    protected $fillable = ['ten_kho_ga', 'dao_dien', 'dien_vien', 'ngay_phat_hanh', 'thoi_luong', 'mo_ta', 'noi_dung', 'tinh_trang', 'id_the_loai', 'hinh_anh', 'trailer', 'quoc_gia', 'ngon_ngu', 'nha_san_xuat'];

    public function suatChieu()
    {
        return $this->hasMany(SuatChieu::class, 'id_kho_ga');
    }

    public function theLoai()
    {
        return $this->belongsTo(LoaiKhoGa::class, 'id_the_loai');
    }
}
