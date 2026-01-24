<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = 'nhan_viens';
    protected $fillable = ['email', 'ho_va_ten', 'password', 'so_dien_thoai', 'dia_chi', 'ngay_sinh', 'tinh_trang', 'avatar', 'id_chuc_vu', 'is_master'];
}
