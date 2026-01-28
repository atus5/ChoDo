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
        // Indexes for danh_gias (most frequently queried)
        Schema::table('danh_gias', function (Blueprint $table) {
            $table->index('id_phim');
            $table->index('id_khach_hang');
            $table->index('tinh_trang');
            $table->index(['id_phim', 'tinh_trang']);
        });

        // Indexes for phims
        Schema::table('phims', function (Blueprint $table) {
            $table->index('tinh_trang');
            $table->index('id_the_loai');
        });

        // Indexes for suat_chieus
        Schema::table('suat_chieus', function (Blueprint $table) {
            $table->index('id_phim');
            $table->index('id_phong_chieu');
            $table->index('tinh_trang');
            $table->index('ngay_chieu');
        });

        // Indexes for ves
        Schema::table('ves', function (Blueprint $table) {
            $table->index('id_suat_chieu');
        });

        // Indexes for khach_hangs
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->index('id_user');
            $table->index('email');
        });

        // Indexes for users
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danh_gias', function (Blueprint $table) {
            $table->dropIndex(['id_phim']);
            $table->dropIndex(['id_khach_hang']);
            $table->dropIndex(['tinh_trang']);
            $table->dropIndex(['id_phim', 'tinh_trang']);
        });

        Schema::table('phims', function (Blueprint $table) {
            $table->dropIndex(['tinh_trang']);
            $table->dropIndex(['id_the_loai']);
        });

        Schema::table('suat_chieus', function (Blueprint $table) {
            $table->dropIndex(['id_phim']);
            $table->dropIndex(['id_phong_chieu']);
            $table->dropIndex(['tinh_trang']);
            $table->dropIndex(['ngay_chieu']);
        });

        Schema::table('ves', function (Blueprint $table) {
            $table->dropIndex(['id_suat_chieu']);
        });

        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->dropIndex(['id_user']);
            $table->dropIndex(['email']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
        });
    }
};
