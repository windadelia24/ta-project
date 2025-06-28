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
        Schema::table('koperasi', function (Blueprint $table) {
            $table->dropColumn('jumlah_anggota');
        });

        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropColumn('file_lk');
        });

        Schema::dropIfExists('temuan');

        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->json('status_aspektl')->nullable();
            $table->text('respon_tl')->nullable();
            $table->string('nama_responder')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasi', function (Blueprint $table) {
            $table->integer('jumlah_anggota')->nullable();
        });

        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->string('file_lk')->nullable();
        });

        Schema::create('temuan', function (Blueprint $table) {
            $table->id('id_temuan');
            $table->unsignedBigInteger('id_subaspek');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('id_subaspek')
                ->references('id_subaspek')
                ->on('sub_aspek_pemeriksaan')
                ->onDelete('cascade');
        });

        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropColumn(['status_aspektl', 'respon_tl', 'nama_responder']);
        });
    }
};
