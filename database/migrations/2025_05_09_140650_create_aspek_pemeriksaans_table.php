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
        Schema::create('aspek_pemeriksaan', function (Blueprint $table) {
            $table->id('id_aspek');
            $table->unsignedBigInteger('id_pemeriksaan'); 
            $table->string('nama_aspek');
            $table->decimal('skor_total', 5, 2);
            $table->string('kategori');

            // Foreign key constraint
            $table->foreign('id_pemeriksaan')
                ->references('id_pemeriksaan')
                ->on('pemeriksaan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspek_pemeriksaan');
    }
};
