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
        Schema::create('kho_ga_sap_ban', function (Blueprint $table) {
            $table->id();
            $table->string('ten_kho_ga');
            $table->string('dien_vien')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->longText('mo_ta')->nullable();
            $table->string('loai_vi')->nullable();
            $table->integer('gia')->nullable();
            $table->date('ngay_phat_hanh')->nullable();
            $table->integer('so_luong_dat_truoc')->default(0);
            $table->longText('mo_ta_ngan')->nullable();
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
