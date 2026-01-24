<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    protected $table = 'ves';
    protected $fillable = ['ma_ve', 'gia_ve', 'id_don_dat_ve', 'id_suat_chieu', 'ten_ghe', 'tinh_trang'];
}
