<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Database\Seeder;

class KriteriaUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            $user->kriteria()->attach($k->id);
        }
    }
}