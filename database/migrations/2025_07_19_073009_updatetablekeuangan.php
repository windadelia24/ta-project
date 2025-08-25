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
            $table->dropColumn([
                'kas_bank',
                'aktiva',
                'kewajiban_lancar',
                'shu',
                'ekuitas',
                'pinjaman_usaha',
                'kewajiban_ekuitas',
                'hutang_pajak',
                'beban_masuk',
                'hutang_biaya',
                'aktiva_lancar',
                'persediaan',
                'piutang_dagang',
                'tabungan_anggota',
                'tabungan_nonanggota',
                'simpanan_jangka_anggota',
                'simpanan_jangka_calonanggota',
                'partisipasi_bruto',
                'beban_pokok',
                'porsi_beban',
                'beban_perkoperasian',
                'beban_usaha',
                'shu_kotor',
                'beban_penjualan',
                'penjualan_anggota',
                'penjualan_nonanggota',
                'pendapatan',
                'simpanan_pokok',
                'simpanan_wajib',
                'aktiva_lalu',
                'ekuitas_lalu',
                'shu_lalu'
            ]);

            $table->string('aspek_keuangan')->nullable();
            $table->decimal('nominal', 15, 2)->nullable();
        });

        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropColumn([
                'prinsip_koperasi',
                'kelembagaan',
                'manajemen_koperasi',
                'prinsip_syariah',
                'risiko_inheren',
                'kpmr',
                'kinerja_keuangan',
                'permodalan',
                'temuan_lainnya',
                'bukti_tl_tk',
                'bukti_tl_pr',
                'bukti_tl_kk',
                'bukti_tl_pk',
                'bukti_tl_tl'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->text('prinsip_koperasi');
            $table->text('kelembagaan');
            $table->text('manajemen_koperasi');
            $table->text('prinsip_syariah')->nullable();
            $table->text('risiko_inheren');
            $table->text('kpmr');
            $table->text('kinerja_keuangan');
            $table->text('permodalan');
            $table->text('temuan_lainnya')->nullable();
            $table->json('bukti_tl_tk')->nullable();
            $table->json('bukti_tl_pr')->nullable();
            $table->json('bukti_tl_kk')->nullable();
            $table->json('bukti_tl_pk')->nullable();
            $table->json('bukti_tl_tl')->nullable();
        });

        Schema::table('keuangans', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['aspek_keuangan', 'nominal']);

            // Add back old columns
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
        });
    }
};
