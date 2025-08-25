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
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->text('prinsip_koperasi')->nullable()->change();
            $table->text('kelembagaan')->nullable()->change();
            $table->text('manajemen_koperasi')->nullable()->change();
            $table->text('prinsip_syariah')->nullable()->change();
            $table->text('risiko_inheren')->nullable()->change();
            $table->text('kpmr')->nullable()->change();
            $table->text('kinerja_keuangan')->nullable()->change();
            $table->text('permodalan')->nullable()->change();
            $table->text('temuan_lainnya')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->text('prinsip_koperasi')->nullable(false)->change();
            $table->text('kelembagaan')->nullable(false)->change();
            $table->text('manajemen_koperasi')->nullable(false)->change();
            $table->text('prinsip_syariah')->nullable()->change(); // tetap nullable sebelumnya
            $table->text('risiko_inheren')->nullable(false)->change();
            $table->text('kpmr')->nullable(false)->change();
            $table->text('kinerja_keuangan')->nullable(false)->change();
            $table->text('permodalan')->nullable(false)->change();
            $table->text('temuan_lainnya')->nullable()->change(); // tetap nullable sebelumnya
        });
    }
};
