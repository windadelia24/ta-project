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
        Schema::create('indikator_pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->string('tipe'); // 'item' atau 'sub'
            $table->integer('section_index')->nullable();
            $table->integer('risk_index')->nullable(); // karena ada di sub
            $table->integer('sub_index')->nullable();
            $table->integer('item_index')->nullable();
            $table->text('indikator');
            $table->timestamps();

            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_pemeriksaan');
    }
};
