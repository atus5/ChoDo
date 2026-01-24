<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuatChieu extends Model
{
    protected $table = 'suat_chieus';
    protected $fillable = ['id_phim', 'id_phong_chieu', 'ngay_chieu', 'thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'tinh_trang'];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'id_phim');
    }

    public function phongChieu()
    {
        return $this->belongsTo(PhongChieu::class, 'id_phong_chieu');
    }

    public function ves()
    {
        return $this->hasMany(Ve::class, 'id_suat_chieu');
    }
}
