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
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->string('ten_san_pham')->nullable();
            $table->integer('so_luong')->nullable();
            $table->integer('gia_tien')->nullable();
            $table->string('ten_nguoi_nhan')->nullable();
            $table->string('sdt')->nullable();
            $table->text('dia_chi')->nullable();
            $table->string('phuong_thuc_giao')->nullable();
            $table->text('ghi_chu')->nullable();
            $table->string('phuong_thuc_thanh_toan')->nullable();
            $table->enum('trang_thai', ['pending', 'preparing', 'shipping', 'delivered', 'cancelled'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->dropColumn([
                'ten_san_pham',
                'so_luong',
                'gia_tien',
                'ten_nguoi_nhan',
                'sdt',
                'dia_chi',
                'phuong_thuc_giao',
                'ghi_chu',
                'phuong_thuc_thanh_toan',
                'trang_thai'
            ]);
        });
    }
};
