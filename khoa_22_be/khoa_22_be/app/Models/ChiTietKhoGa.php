<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKhoGa extends Model
{
    protected $table = 'chi_tiet_kho_ga';
    protected $fillable = ['ten_kho_ga', 'mo_ta', 'hinh_anh', 'gia', 'loai_vi', 'kich_thuoc', 'tinh_trang'];
}
