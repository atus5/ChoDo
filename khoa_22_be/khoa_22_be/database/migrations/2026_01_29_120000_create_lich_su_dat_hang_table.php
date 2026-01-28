<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lich_su_dat_hang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_khach_hang');
            $table->string('ten_tai_khoan');
            $table->string('email')->nullable();
            $table->string('ma_don_hang')->nullable();
            $table->string('ten_san_pham');
            $table->integer('so_luong')->default(1);
            $table->integer('gia_don_vi')->default(0);
            $table->integer('tong_tien')->default(0);
            $table->string('trang_thai')->default('paid');
            $table->string('hinh_anh')->nullable();
            $table->string('vi')->nullable();
            $table->string('kich_thuoc')->nullable();
            $table->text('ghi_chu')->nullable();
            $table->string('ten_nguoi_nhan')->nullable();
            $table->string('sdt')->nullable();
            $table->text('dia_chi')->nullable();
            $table->string('phuong_thuc_giao')->nullable();
            $table->string('phuong_thuc_thanh_toan')->nullable();
            $table->timestamps();

            $table->index('id_khach_hang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_dat_hang');
    }
};
