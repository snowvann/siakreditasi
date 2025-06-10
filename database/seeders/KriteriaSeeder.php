<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $kriterias = [
            ['id' => 1, 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi'],
            ['id' => 2, 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama'],
            ['id' => 3, 'nama_kriteria' => 'Mahasiswa'],
            ['id' => 4, 'nama_kriteria' => 'Sumber Daya Manusia'],
            ['id' => 5, 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'],
            ['id' => 6, 'nama_kriteria' => 'Pendidikan'],
            ['id' => 7, 'nama_kriteria' => 'Penelitian'],
            ['id' => 8, 'nama_kriteria' => 'Pengabdian kepada Masyarakat'],
            ['id' => 9, 'nama_kriteria' => 'Luaran dan Capaian Tridharma'],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::updateOrCreate(
                ['id' => $kriteria['id']],
                ['nama_kriteria' => $kriteria['nama_kriteria'], 'deskripsi' => 'Deskripsi ' . $kriteria['nama_kriteria']]
            );
        }
    }
}
