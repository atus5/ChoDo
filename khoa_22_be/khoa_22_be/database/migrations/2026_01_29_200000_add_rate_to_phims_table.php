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
            if (!Schema::hasColumn('phims', 'rate')) {
                $table->string('rate')->nullable()->after('tinh_trang');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phims', function (Blueprint $table) {
            if (Schema::hasColumn('phims', 'rate')) {
                $table->dropColumn('rate');
            }
        });
    }
};
