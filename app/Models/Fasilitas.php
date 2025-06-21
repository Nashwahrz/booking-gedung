<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'nashwa_fasilitas';
    protected $fillable = [
    'gedung_id',
    'proyektor',
    'meja',
    'kursi',
    'wc',
    'tempat_ibadah',
    'wifi',
    'ac',
    'lainnya',
];
    public function gedung() {
    return $this->belongsTo(Gedung::class);
}

}
