<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheLoaiPhim extends Model
{
    protected $table = 'the_loai_phims';
    protected $fillable = ['ten_the_loai', 'slug_the_loai', 'tinh_trang'];
}
