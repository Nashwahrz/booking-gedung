<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('nashwa_pembayarans', function (Blueprint $table) {
        $table->integer('pelunasan')->nullable()->after('jumlah_bayar');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nashwa_pembayarans', function (Blueprint $table) {
            //
        });
    }
};
