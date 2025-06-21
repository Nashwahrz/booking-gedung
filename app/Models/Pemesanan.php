<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'nashwa_pemesanans';
    public function gedung() {
    return $this->belongsTo(Gedung::class);
}

public function pembayaran() {
    return $this->hasOne(Pembayaran::class);
}

}
