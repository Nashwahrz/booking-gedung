<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function fasilitas()
    {
        return $this->hasOne(Fasilitas::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
