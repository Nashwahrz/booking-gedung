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
       Schema::create('nashwa_pembayarans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pemesanan_id')->constrained('nashwa_pemesanans')->onDelete('cascade');
    $table->date('tanggal_bayar');
    $table->integer('jumlah_bayar');
    $table->string('bukti_bayar')->nullable(); // filepath atau nama file
    $table->enum('status_bayar', ['menunggu', 'lunas', 'gagal'])->default('menunggu');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nashwa_pembayarans');
    }
};
