<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Database\Seeder;

class SubkriteriaSeeder extends Seeder
{
    public function run()
    {
        $subkriteriaData = [
            ['nama' => 'Penetapan', 'deskripsi' => 'Proses menetapkan standar'],
            ['nama' => 'Pelaksanaan', 'deskripsi' => 'Implementasi kegiatan'],
            ['nama' => 'Evaluasi', 'deskripsi' => 'Penilaian pelaksanaan'],
            ['nama' => 'Pengendalian', 'deskripsi' => 'Mekanisme pengawasan'],
            ['nama' => 'Peningkatan', 'deskripsi' => 'Upaya perbaikan'],
        ];

        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            foreach ($subkriteriaData as $data) {
                Subkriteria::create([
                    'kriteria_id' => $k->id,
                    'nama_subkriteria' => $data['nama'],
                    'deskripsi' => $data['deskripsi']
                ]);
            }
        }
    }
}