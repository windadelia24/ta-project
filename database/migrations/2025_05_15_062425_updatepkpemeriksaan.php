<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE pemeriksaan DROP PRIMARY KEY');
        DB::statement('ALTER TABLE pemeriksaan MODIFY id_pemeriksaan BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');

        // Tambahkan foreign key di aspek_pemeriksaan (kolomnya sudah unsignedBigInteger, jadi tidak perlu diubah lagi)
        Schema::table('aspek_pemeriksaan', function (Blueprint $table) {
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
        Schema::table('aspek_pemeriksaan', function (Blueprint $table) {
            $table->dropForeign(['id_pemeriksaan']);
        });

        // Kembalikan id_pemeriksaan ke string
        DB::statement('ALTER TABLE pemeriksaan DROP PRIMARY KEY');
        DB::statement('ALTER TABLE pemeriksaan MODIFY id_pemeriksaan VARCHAR(20) NOT NULL PRIMARY KEY');
    }
};
