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
        Schema::table('suat_chieus', function (Blueprint $table) {
            if (!Schema::hasColumn('suat_chieus', 'gia_ve')) {
                $table->integer('gia_ve')->nullable()->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suat_chieus', function (Blueprint $table) {
            if (Schema::hasColumn('suat_chieus', 'gia_ve')) {
                $table->dropColumn('gia_ve');
            }
        });
    }
};
