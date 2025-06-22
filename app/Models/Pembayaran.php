<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'nashwa_pembayarans';
    use HasFactory;

   protected $fillable = [
    'pemesanan_id',
    'tanggal_bayar',
    'jumlah_bayar',   // untuk DP
    'pelunasan',      // untuk pelunasan
    'bukti_bayar',
    'status_bayar'
];


    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}



