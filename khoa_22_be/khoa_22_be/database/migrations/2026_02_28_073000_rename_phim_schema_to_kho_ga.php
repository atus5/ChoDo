<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('phims') && !Schema::hasTable('kho_gas')) {
            Schema::rename('phims', 'kho_gas');
        }

        if (Schema::hasTable('the_loai_phims') && !Schema::hasTable('loai_kho_gas')) {
            Schema::rename('the_loai_phims', 'loai_kho_gas');
        }

        if (Schema::hasTable('kho_gas') && Schema::hasColumn('kho_gas', 'ten_phim') && !Schema::hasColumn('kho_gas', 'ten_kho_ga')) {
            Schema::table('kho_gas', function (Blueprint $table) {
                $table->renameColumn('ten_phim', 'ten_kho_ga');
            });
        }

        if (Schema::hasTable('suat_chieus') && Schema::hasColumn('suat_chieus', 'id_phim') && !Schema::hasColumn('suat_chieus', 'id_kho_ga')) {
            Schema::table('suat_chieus', function (Blueprint $table) {
                $table->renameColumn('id_phim', 'id_kho_ga');
            });
        }

        if (Schema::hasTable('danh_gias') && Schema::hasColumn('danh_gias', 'id_phim') && !Schema::hasColumn('danh_gias', 'id_kho_ga')) {
            Schema::table('danh_gias', function (Blueprint $table) {
                $table->renameColumn('id_phim', 'id_kho_ga');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('danh_gias') && Schema::hasColumn('danh_gias', 'id_kho_ga') && !Schema::hasColumn('danh_gias', 'id_phim')) {
            Schema::table('danh_gias', function (Blueprint $table) {
                $table->renameColumn('id_kho_ga', 'id_phim');
            });
        }

        if (Schema::hasTable('suat_chieus') && Schema::hasColumn('suat_chieus', 'id_kho_ga') && !Schema::hasColumn('suat_chieus', 'id_phim')) {
            Schema::table('suat_chieus', function (Blueprint $table) {
                $table->renameColumn('id_kho_ga', 'id_phim');
            });
        }

        if (Schema::hasTable('kho_gas') && Schema::hasColumn('kho_gas', 'ten_kho_ga') && !Schema::hasColumn('kho_gas', 'ten_phim')) {
            Schema::table('kho_gas', function (Blueprint $table) {
                $table->renameColumn('ten_kho_ga', 'ten_phim');
            });
        }

        if (Schema::hasTable('loai_kho_gas') && !Schema::hasTable('the_loai_phims')) {
            Schema::rename('loai_kho_gas', 'the_loai_phims');
        }

        if (Schema::hasTable('kho_gas') && !Schema::hasTable('phims')) {
            Schema::rename('kho_gas', 'phims');
        }
    }
};
