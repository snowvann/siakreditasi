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
                'name' => 'Anggota',
                'username' => 'anggota',
                'password' => Hash::make('12345678'),
                'role' => 'Anggota',
                'is_active' => true
            ],
            [
                'name' => 'KPS',
                'username' => 'KPS',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'is_active' => true
            ],
            [
                'name' => 'Kajur',
                'username' => 'Kajur',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'is_active' => true
            ],
            [
                'name' => 'KJM',
                'username' => 'KJM',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'is_active' => true
            ],
            [
                'name' => 'Direktur',
                'username' => 'Direktur',
                'password' => Hash::make('12345678'),
                'role' => 'Validator',
                'is_active' => true
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}