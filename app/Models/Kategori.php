<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function gedungs() {
    return $this->hasMany(Gedung::class);
}

}
