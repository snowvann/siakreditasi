<?php

namespace Database\Seeders;

use App\Models\Akreditasi;
use App\Models\Kriteria;
use App\Models\ValidasiKriteria;
use Illuminate\Database\Seeder;

class ValidasiKriteriaSeeder extends Seeder
{
    public function run()
    {
        $akreditasi = Akreditasi::first();
        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            ValidasiKriteria::create([
                'akreditasi_id' => $akreditasi->id,
                'kriteria_id' => $k->id,
                'status' => 'belum',
                'catatan' => null
            ]);
        }
    }
}