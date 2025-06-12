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
        DB::statement('ALTER TABLE koperasi DROP PRIMARY KEY, MODIFY id_koperasi INT');

        // Ganti nama kolom
        Schema::table('koperasi', function (Blueprint $table) {
            $table->renameColumn('id_koperasi', 'nik');
        });

        // Ubah tipe kolom jadi varchar
        DB::statement('ALTER TABLE koperasi MODIFY nik VARCHAR(20)');

        // Jadikan nik sebagai primary key baru
        Schema::table('koperasi', function (Blueprint $table) {
            $table->primary('nik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->dropPrimary(['nik']);
        });

        // Ubah tipe kembali ke INT
        DB::statement('ALTER TABLE koperasi MODIFY nik INT');

        // Rename kembali ke id_koperasi
        Schema::table('koperasi', function (Blueprint $table) {
            $table->renameColumn('nik', 'id_koperasi');
        });

        // Tambahkan kembali auto_increment dan primary key
        DB::statement('ALTER TABLE koperasi MODIFY id_koperasi INT AUTO_INCREMENT PRIMARY KEY');
    }
};
