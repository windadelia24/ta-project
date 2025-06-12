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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->string('id_pemeriksaan', 20)->primary();
            $table->string('nik', 20);
            $table->date('tanggal_periksa');
            $table->string('file_ba', 50)->nullable();
            $table->string('file_lk', 50)->nullable();

            $table->foreign('nik')->references('nik')->on('koperasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
