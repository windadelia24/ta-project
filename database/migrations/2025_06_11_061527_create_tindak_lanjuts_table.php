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
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->id('id_tindaklanjut');
            $table->unsignedBigInteger('id_pemeriksaan');

            // Kolom isian form
            $table->text('prinsip_koperasi');
            $table->text('kelembagaan');
            $table->text('manajemen_koperasi');
            $table->text('prinsip_syariah')->nullable();
            $table->text('risiko_inheren');
            $table->text('kpmr');
            $table->text('kinerja_keuangan');
            $table->text('permodalan');
            $table->text('temuan_lainnya')->nullable();

            // File upload (bisa disimpan sebagai JSON array untuk multiple files)
            $table->json('bukti_tl_tk')->nullable();
            $table->json('bukti_tl_pr')->nullable();
            $table->json('bukti_tl_kk')->nullable();
            $table->json('bukti_tl_pk')->nullable();
            $table->json('bukti_tl_tl')->nullable();

            $table->string('status_tindaklanjut')->default('Belum Ditindaklanjuti');

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
