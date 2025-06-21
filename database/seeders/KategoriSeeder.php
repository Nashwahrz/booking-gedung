<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nashwa_kategoris')->insert([
            ['nama_kategori' => 'Gedung Pernikahan'],
            ['nama_kategori' => 'Ruang Seminar'],
            ['nama_kategori' => 'Aula Kampus'],
            ['nama_kategori' => 'Tempat Ibadah'],
        ]);
    }
}
