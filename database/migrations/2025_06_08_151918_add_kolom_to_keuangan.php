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
        Schema::table('keuangans', function (Blueprint $table) {
            $table->decimal('titipan_dana', 15, 2)->nullable()->after('shu_lalu');
            $table->decimal('kewajiban_jangka_panjang', 15, 2)->nullable()->after('titipan_dana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuangans', function (Blueprint $table) {
            $table->dropColumn(['titipan_dana', 'kewajiban_jangka_panjang']);
        });
    }
};
