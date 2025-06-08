<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'KPS',
                'username' => 'KPS',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'level_validator' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Kajur',
                'username' => 'Kajur',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'level_validator' => 1,
                'is_active' => true
            ],
            [
                'name' => 'KJM',
                'username' => 'KJM',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'level_validator' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Direktur',
                'username' => 'Direktur',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'level_validator' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Dosen 1',
                'username' => 'anggota1',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 2',
                'username' => 'anggota2',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 3',
                'username' => 'anggota3',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 4',
                'username' => 'anggota4',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 5',
                'username' => 'anggota5',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 6',
                'username' => 'anggota6',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 7',
                'username' => 'anggota7',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 8',
                'username' => 'anggota8',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Dosen 9',
                'username' => 'anggota',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'Super Admin',
                'username' => 'superAdmin',
                'password' => Hash::make('12345678'),
                'role' => 'SuperAdmin',
                'is_active' => true
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
