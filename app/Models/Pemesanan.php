<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    public function gedung() {
    return $this->belongsTo(Gedung::class);
}

public function pembayaran() {
    return $this->hasOne(Pembayaran::class);
}

}
