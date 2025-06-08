<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KriteriaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada
        DB::table('kriteria_user')->truncate();

        $data = [];
        $now = Carbon::now();

        // Loop untuk kriteria_id 1-9 dan user_id 5-13
        for ($kriteria_id = 1; $kriteria_id <= 9; $kriteria_id++) {
            for ($user_id = 5; $user_id <= 13; $user_id++) {
                $data[] = [
                    'kriteria_id' => $kriteria_id,
                    'user_id' => $user_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Insert dalam batch untuk performa yang lebih baik
        DB::table('kriteria_user')->insert($data);

        $this->command->info('KriteriaUser pivot data berhasil di-seed!');
        $this->command->info('Total data: ' . count($data) . ' records');
    }
}

// ATAU jika ingin lebih fleksibel dengan opsi berbeda:

class KriteriaUserSeederAdvanced extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('kriteria_user')->truncate();

        $now = Carbon::now();

        // Opsi 1: Setiap kriteria dimiliki oleh satu user secara berurutan
        $this->seedOneToOne();

        // Opsi 2: Setiap kriteria dimiliki oleh beberapa user
        // $this->seedOneToMany();

        // Opsi 3: Setiap kriteria dimiliki oleh semua user
        // $this->seedManyToMany();

        $this->command->info('KriteriaUser seeding completed!');
    }

    /**
     * Setiap kriteria dimiliki oleh satu user (1:1 mapping)
     */
    private function seedOneToOne()
    {
        $data = [];
        $now = Carbon::now();

        for ($kriteria_id = 1; $kriteria_id <= 9; $kriteria_id++) {
            // User 5-13, jadi untuk kriteria 1-9 kita mapping ke user 5-13
            $user_id = 4 + $kriteria_id; // kriteria 1 -> user 5, kriteria 2 -> user 6, dst.
            
            $data[] = [
                'kriteria_id' => $kriteria_id,
                'user_id' => $user_id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('kriteria_user')->insert($data);
        $this->command->info('One-to-One mapping: ' . count($data) . ' records');
    }

    /**
     * Setiap kriteria dimiliki oleh beberapa user secara random
     */
    private function seedOneToMany()
    {
        $data = [];
        $now = Carbon::now();
        $userIds = range(5, 13); // User 5-13

        for ($kriteria_id = 1; $kriteria_id <= 9; $kriteria_id++) {
            // Setiap kriteria dimiliki oleh 2-4 user secara random
            $selectedUsers = array_rand(array_flip($userIds), rand(2, 4));
            
            if (!is_array($selectedUsers)) {
                $selectedUsers = [$selectedUsers];
            }

            foreach ($selectedUsers as $user_id) {
                $data[] = [
                    'kriteria_id' => $kriteria_id,
                    'user_id' => $user_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('kriteria_user')->insert($data);
        $this->command->info('One-to-Many mapping: ' . count($data) . ' records');
    }

    /**
     * Setiap kriteria dimiliki oleh semua user (Many-to-Many full)
     */
    private function seedManyToMany()
    {
        $data = [];
        $now = Carbon::now();

        for ($kriteria_id = 1; $kriteria_id <= 9; $kriteria_id++) {
            for ($user_id = 5; $user_id <= 13; $user_id++) {
                $data[] = [
                    'kriteria_id' => $kriteria_id,
                    'user_id' => $user_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('kriteria_user')->insert($data);
        $this->command->info('Many-to-Many full mapping: ' . count($data) . ' records');
    }
}