<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nashwa_fasilitas', function (Blueprint $table) {
            // Ubah boolean ke integer
            $table->integer('proyektor')->nullable()->change();
            $table->integer('meja')->nullable()->change();
            $table->integer('kursi')->nullable()->change();
            $table->integer('wc')->nullable()->change();

            // Ubah jadi string
            $table->string('tempat_ibadah')->nullable()->change();
            $table->string('wifi')->nullable()->change();
            $table->string('ac')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('nashwa_fasilitas', function (Blueprint $table) {
            $table->boolean('proyektor')->default(false)->change();
            $table->boolean('meja')->default(false)->change();
            $table->boolean('kursi')->default(false)->change();
            $table->boolean('wc')->default(false)->change();

            $table->boolean('tempat_ibadah')->default(false)->change();
            $table->boolean('wifi')->default(false)->change();
            $table->boolean('ac')->default(false)->change();
        });
    }
};
