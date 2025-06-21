<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'nashwa_gedungs';
     protected $fillable = [
        'nama',
        'lokasi',
        'deskripsi',
        'kapasitas',
        'harga_per_hari',
        'kategori_id',
        'foto',
    ];
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
