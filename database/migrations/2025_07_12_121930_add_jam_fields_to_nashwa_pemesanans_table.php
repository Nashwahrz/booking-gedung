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
        Schema::table('nashwa_pemesanans', function (Blueprint $table) {
    $table->time('jam_mulai')->nullable();
    $table->time('jam_selesai')->nullable();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nashwa_pemesanans', function (Blueprint $table) {
            //
        });
    }
};
