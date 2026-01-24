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
        Schema::table('phims', function (Blueprint $table) {
            if (!Schema::hasColumn('phims', 'trailer')) {
                $table->string('trailer')->nullable()->after('hinh_anh');
            }
            if (!Schema::hasColumn('phims', 'quoc_gia')) {
                $table->string('quoc_gia')->nullable()->after('trailer');
            }
            if (!Schema::hasColumn('phims', 'ngon_ngu')) {
                $table->string('ngon_ngu')->nullable()->after('quoc_gia');
            }
            if (!Schema::hasColumn('phims', 'noi_dung')) {
                $table->longText('noi_dung')->nullable()->after('mo_ta');
            }
            if (!Schema::hasColumn('phims', 'nha_san_xuat')) {
                $table->string('nha_san_xuat')->nullable()->after('noi_dung');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phims', function (Blueprint $table) {
            if (Schema::hasColumn('phims', 'trailer')) {
                $table->dropColumn('trailer');
            }
            if (Schema::hasColumn('phims', 'quoc_gia')) {
                $table->dropColumn('quoc_gia');
            }
            if (Schema::hasColumn('phims', 'ngon_ngu')) {
                $table->dropColumn('ngon_ngu');
            }
            if (Schema::hasColumn('phims', 'noi_dung')) {
                $table->dropColumn('noi_dung');
            }
            if (Schema::hasColumn('phims', 'nha_san_xuat')) {
                $table->dropColumn('nha_san_xuat');
            }
        });
    }
};
