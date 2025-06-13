<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaUserSeeder extends Seeder
{
    public function run(): void
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
            DB::table('kriteria_user')->updateOrInsert(
                ['kriteria_id' => $kriteriaId],
                ['user_id' => $userId, 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
