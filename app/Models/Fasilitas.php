<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    public function gedung() {
    return $this->belongsTo(Gedung::class);
}

}
