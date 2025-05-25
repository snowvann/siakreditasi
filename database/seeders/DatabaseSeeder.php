<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            KriteriaSeeder::class,
            SubkriteriaSeeder::class,
            AkreditasiSeeder::class,
            KriteriaUserSeeder::class,
            ValidasiKriteriaSeeder::class,
            DokumenTemplateSeeder::class,
            PengaturanSistemSeeder::class,
        ]);
    }
}