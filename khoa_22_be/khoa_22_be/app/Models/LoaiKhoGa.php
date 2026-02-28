<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiKhoGa extends Model
{
    protected $table = 'loai_kho_gas';
    protected $fillable = ['ten_the_loai', 'slug_the_loai', 'tinh_trang'];
}
