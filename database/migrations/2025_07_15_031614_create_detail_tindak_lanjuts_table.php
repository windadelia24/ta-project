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
        Schema::create('detail_tindak_lanjut', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_tindaklanjut');
            $table->string('nama_aspek');
            $table->json('deskripsi');
            $table->json('bukti_tindaklanjut')->nullable();
            $table->timestamps();

            $table->foreign('id_tindaklanjut')
                  ->references('id_tindaklanjut')
                  ->on('tindak_lanjut')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tindak_lanjut');
    }
};
