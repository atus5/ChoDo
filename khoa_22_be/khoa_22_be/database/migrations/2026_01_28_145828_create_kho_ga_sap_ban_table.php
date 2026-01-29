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
        if (Schema::hasTable('kho_ga_sap_ban')) {
            return;
        }

        Schema::create('kho_ga_sap_ban', function (Blueprint $table) {
            $table->id();
            $table->string('ten_kho_ga');
            $table->longText('mo_ta')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('tinh_trang')->default(1); // 1: sắp bán, 2: đang bán
            $table->decimal('thoi_luong', 10, 2)->nullable();
            $table->string('the_loai')->nullable();
            $table->string('loai_vi')->nullable();
            $table->string('dien_vien')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kho_ga_sap_ban');
    }
};
