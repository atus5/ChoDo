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
        Schema::create('phims', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phim');
            $table->string('dao_dien')->nullable();
            $table->string('dien_vien')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->date('ngay_phat_hanh')->nullable();
            $table->integer('thoi_luong')->nullable(); // Tính bằng phút
            $table->longText('mo_ta')->nullable();
            $table->integer('tinh_trang')->default(1); // Ví dụ: 1 = Sắp chiếu, 2 = Đang chiếu, 0 = Ngừng chiếu
            $table->integer('id_the_loai')->default(1); // Có
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phims');
    }
};
