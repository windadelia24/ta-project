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
        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->decimal('skor_akhir', 5, 2)->nullable()->after('file_lk'); // contoh: 98.75
            $table->string('kategori')->nullable()->after('skor_akhir'); // contoh: "Baik", "Cukup", dll
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropColumn(['skor_akhir', 'kategori']);
        });
    }
};
