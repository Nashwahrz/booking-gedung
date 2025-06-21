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
    Schema::table('nashwa_fasilitas', function (Blueprint $table) {
        $table->foreignId('gedung_id')->nullable()->constrained('nashwa_gedungs')->onDelete('cascade');
        $table->boolean('proyektor')->default(false);
        $table->boolean('meja')->default(false);
        $table->boolean('kursi')->default(false);
        $table->boolean('wc')->default(false);
        $table->boolean('tempat_ibadah')->default(false);
        $table->boolean('wifi')->default(false);
        $table->boolean('ac')->default(false);
        $table->text('lainnya')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nashwa_fasilitas', function (Blueprint $table) {
            //
        });
    }
};
