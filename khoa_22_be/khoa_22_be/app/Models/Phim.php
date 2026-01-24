<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    protected $table = 'phims';
    protected $fillable = ['ten_phim', 'dao_dien', 'dien_vien', 'ngay_phat_hanh', 'thoi_luong', 'mo_ta', 'noi_dung', 'tinh_trang', 'id_the_loai', 'hinh_anh', 'trailer', 'quoc_gia', 'ngon_ngu', 'nha_san_xuat'];

    public function suatChieu()
    {
        return $this->hasMany(SuatChieu::class, 'id_phim');
    }

    public function theLoai()
    {
        return $this->belongsTo(TheLoaiPhim::class, 'id_the_loai');
    }
}
