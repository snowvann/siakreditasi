<?php

namespace Database\Seeders;

use App\Models\DokumenTemplate;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class DokumenTemplateSeeder extends Seeder
{
    public function run()
    {
        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            DokumenTemplate::create([
                'kriteria_id' => $k->id,
                'nama_file' => 'Template Kriteria ' . $k->id,
                'path' => 'templates/kriteria_' . $k->id . '.docx'
            ]);
        }
    }
}