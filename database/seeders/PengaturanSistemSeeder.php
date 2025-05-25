<?php

namespace Database\Seeders;

use App\Models\PengaturanSistem;
use Illuminate\Database\Seeder;

class PengaturanSistemSeeder extends Seeder
{
    public function run()
    {
        $pengaturan = [
            ['key' => 'app_name', 'value' => 'Sistem Akreditasi'],
            ['key' => 'app_version', 'value' => '1.0.0'],
            ['key' => 'maintenance_mode', 'value' => 'false'],
        ];

        foreach ($pengaturan as $setting) {
            PengaturanSistem::create($setting);
        }
    }
}