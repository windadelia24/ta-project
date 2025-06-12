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
        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });

        Schema::table('aspek_pemeriksaan', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('sub_aspek_pemeriksaan', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropTimestamps(); // Menghapus created_at dan updated_at
        });

        Schema::table('aspek_pemeriksaan', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('sub_aspek_pemeriksaan', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
