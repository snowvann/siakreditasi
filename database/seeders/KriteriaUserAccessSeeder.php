<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KriteriaUserAccess;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KriteriaUserAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        // database/seeders/KriteriaUserAccessSeeder.php
public function run()
{
    $mapping = [
            1 => 5,
            2 => 6,
            3 => 7,
            4 => 8,
            5 => 9,
            6 => 10,
            7 => 11,
            8 => 12,
            9 => 13, 
    ];

    foreach ($mapping as $kriteriaId => $userId) {
        // Validasi user exist
        if (!User::where('id', $userId)->exists()) {
            $this->command->error("User ID $userId tidak ditemukan!");
            continue;
        }

        KriteriaUserAccess::updateOrCreate(
            [
                'user_id' => $userId,
                'kriteria_id' => $kriteriaId
            ],
            [
                'baca' => true,
                'tulis' => false,
                'validasi' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
}
