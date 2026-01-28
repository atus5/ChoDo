<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoGaSapBan extends Model
{
    use HasFactory;

    protected $table = 'kho_ga_sap_ban';
    
    protected $fillable = [
        'ten_kho_ga',
        'dien_vien',
        'hinh_anh',
        'mo_ta',
        'loai_vi',
        'gia',
        'ngay_phat_hanh',
        'so_luong_dat_truoc',
        'mo_ta_ngan',
    ];
}
