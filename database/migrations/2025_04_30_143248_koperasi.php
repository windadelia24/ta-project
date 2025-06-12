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
        Schema::create('koperasi', function (Blueprint $table) {
            $table->id('id_koperasi'); // Auto-increment integer primary key
            $table->string('nama_koperasi', 100);
            $table->string('nbh', 50);
            $table->string('alamat', 150);
            $table->string('bentuk_koperasi', 30);
            $table->string('jenis_koperasi', 30);
            $table->integer('jumlah_anggota');
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi');
    }
};
