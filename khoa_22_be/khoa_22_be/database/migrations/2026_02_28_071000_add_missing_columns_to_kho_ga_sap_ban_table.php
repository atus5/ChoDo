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
        if (!Schema::hasTable('kho_ga_sap_ban')) {
            return;
        }

        Schema::table('kho_ga_sap_ban', function (Blueprint $table) {
            if (!Schema::hasColumn('kho_ga_sap_ban', 'gia')) {
                $table->integer('gia')->nullable()->after('loai_vi');
            }

            if (!Schema::hasColumn('kho_ga_sap_ban', 'ngay_phat_hanh')) {
                $table->date('ngay_phat_hanh')->nullable()->after('gia');
            }

            if (!Schema::hasColumn('kho_ga_sap_ban', 'so_luong_dat_truoc')) {
                $table->integer('so_luong_dat_truoc')->default(0)->after('ngay_phat_hanh');
            }

            if (!Schema::hasColumn('kho_ga_sap_ban', 'mo_ta_ngan')) {
                $table->longText('mo_ta_ngan')->nullable()->after('mo_ta');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('kho_ga_sap_ban')) {
            return;
        }

        Schema::table('kho_ga_sap_ban', function (Blueprint $table) {
            if (Schema::hasColumn('kho_ga_sap_ban', 'mo_ta_ngan')) {
                $table->dropColumn('mo_ta_ngan');
            }

            if (Schema::hasColumn('kho_ga_sap_ban', 'so_luong_dat_truoc')) {
                $table->dropColumn('so_luong_dat_truoc');
            }

            if (Schema::hasColumn('kho_ga_sap_ban', 'ngay_phat_hanh')) {
                $table->dropColumn('ngay_phat_hanh');
            }

            if (Schema::hasColumn('kho_ga_sap_ban', 'gia')) {
                $table->dropColumn('gia');
            }
        });
    }
};
