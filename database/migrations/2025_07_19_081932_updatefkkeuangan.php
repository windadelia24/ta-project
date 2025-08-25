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
            $table->dropForeign(['id_pemeriksaan']);

            $table->dropUnique(['id_pemeriksaan']);

            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuangans', function (Blueprint $table) {
            $table->dropForeign(['id_pemeriksaan']);
            $table->unique('id_pemeriksaan');
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }
};
