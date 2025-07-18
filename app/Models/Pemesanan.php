<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'nashwa_pemesanans';
     protected $fillable = ['email','nama_kegiatan', 'no_hp', 'gedung_id', 'tanggal_mulai', 'tanggal_selesai', 'status', 'jam_mulai',
    'jam_selesai','durasi'];
    public function gedung() {
    return $this->belongsTo(Gedung::class);
}

public function pembayaran() {
    return $this->hasOne(Pembayaran::class,'pemesanan_id');
}



}
