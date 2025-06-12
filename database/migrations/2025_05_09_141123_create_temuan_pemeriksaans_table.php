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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan');
    }
};
