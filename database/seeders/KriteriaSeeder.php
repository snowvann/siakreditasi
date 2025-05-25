<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 9; $i++) {
            Kriteria::create([
                'nama_kriteria' => 'Kriteria ' . $i,
                'deskripsi' => 'Deskripsi Kriteria ' . $i
            ]);
        }
    }
}