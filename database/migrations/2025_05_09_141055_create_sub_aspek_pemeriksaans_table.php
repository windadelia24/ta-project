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
        Schema::create('sub_aspek_pemeriksaan', function (Blueprint $table) {
            $table->id('id_subaspek');
            $table->unsignedBigInteger('id_aspek'); 
            $table->string('nama_subaspek');
            $table->decimal('skor', 5, 2);
            $table->string('kategori');

            $table->foreign('id_aspek')->references('id_aspek')->on('aspek_pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_aspek_pemeriksaan');
    }
};
