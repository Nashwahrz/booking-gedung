<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'nashwa_kategoris';
    public function gedungs() {
    return $this->hasMany(Gedung::class);
}

}
