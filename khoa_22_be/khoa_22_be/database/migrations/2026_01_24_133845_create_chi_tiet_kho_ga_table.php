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
        Schema::create('chi_tiet_kho_ga', function (Blueprint $table) {
            $table->id();
            $table->string('ten_kho_ga');
            $table->text('mo_ta')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->decimal('gia', 10, 2);
            $table->string('loai_vi')->nullable();
            $table->string('kich_thuoc')->nullable();
            $table->tinyInteger('tinh_trang')->default(2); // 1=sắp bán, 2=đang bán
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_kho_ga');
    }
};
