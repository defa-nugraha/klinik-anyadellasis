<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users  = [
            [
                'name' => 'Defa Nugraha',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => 'admin',
                'alamat' => 'Jl. Pemuda'
            ],
            [
                'name' => 'Seika Nugraha',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => 'doctor',
                'alamat' => 'Jl. Pemuda'
            ],
            [
                'name' => 'I Rosiana',
                'email' => 'nurse@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => 'nurse',
                'alamat' => 'Jl. Pemuda'
            ],
            [
                'name' => 'I Rosiana',
                'email' => 'pasien@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => 'patient',
                'alamat' => 'Jl. Pemuda'
            ]
        ];
        User::query()->insert($users);
    }
}
