<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'nashwa_pembayarans';
    public function pemesanan() {
    return $this->belongsTo(Pemesanan::class);
}

}
