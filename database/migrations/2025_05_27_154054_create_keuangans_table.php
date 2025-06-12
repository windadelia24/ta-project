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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan')->unique();
            $table->decimal('kas_bank', 15, 2)->nullable();
            $table->decimal('aktiva', 15, 2)->nullable();
            $table->decimal('kewajiban_lancar', 15, 2)->nullable();
            $table->decimal('shu', 15, 2)->nullable();
            $table->decimal('ekuitas', 15, 2)->nullable();
            $table->decimal('pinjaman_usaha', 15, 2)->nullable();
            $table->decimal('kewajiban_ekuitas', 15, 2)->nullable();
            $table->decimal('hutang_pajak', 15, 2)->nullable();
            $table->decimal('beban_masuk', 15, 2)->nullable();
            $table->decimal('hutang_biaya', 15, 2)->nullable();
            $table->decimal('aktiva_lancar', 15, 2)->nullable();
            $table->decimal('persediaan', 15, 2)->nullable();
            $table->decimal('piutang_dagang', 15, 2)->nullable();
            $table->decimal('tabungan_anggota', 15, 2)->nullable();
            $table->decimal('tabungan_nonanggota', 15, 2)->nullable();
            $table->decimal('simpanan_jangka_anggota', 15, 2)->nullable();
            $table->decimal('simpanan_jangka_calonanggota', 15, 2)->nullable();
            $table->decimal('partisipasi_bruto', 15, 2)->nullable();
            $table->decimal('beban_pokok', 15, 2)->nullable();
            $table->decimal('porsi_beban', 15, 2)->nullable();
            $table->decimal('beban_perkoperasian', 15, 2)->nullable();
            $table->decimal('beban_usaha', 15, 2)->nullable();
            $table->decimal('shu_kotor', 15, 2)->nullable();
            $table->decimal('beban_penjualan', 15, 2)->nullable();
            $table->decimal('penjualan_anggota', 15, 2)->nullable();
            $table->decimal('penjualan_nonanggota', 15, 2)->nullable();
            $table->decimal('pendapatan', 15, 2)->nullable();
            $table->decimal('simpanan_pokok', 15, 2)->nullable();
            $table->decimal('simpanan_wajib', 15, 2)->nullable();
            $table->decimal('aktiva_lalu', 15, 2)->nullable();
            $table->decimal('ekuitas_lalu', 15, 2)->nullable();
            $table->decimal('shu_lalu', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
