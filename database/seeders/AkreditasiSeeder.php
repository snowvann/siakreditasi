<?php

namespace Database\Seeders;

use App\Models\Akreditasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class AkreditasiSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('role', 'Anggota')->first();

        Akreditasi::create([
            'user_id' => $user->id,
            'judul' => 'Akreditasi Program Studi 2023',
            'deskripsi' => 'Proses akreditasi program studi tahun 2023',
            'status' => 'diajukan'
        ]);
    }
}