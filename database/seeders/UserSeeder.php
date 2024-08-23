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
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => User::ROLE_SUPERADMIN,
                'alamat' => 'Jl. Pemuda'
            ],
            [
                'name' => 'Seika Nugraha',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => User::ROLE_ADMIN,
                'alamat' => 'Jl. Pemuda'
            ],
            [
                'name' => 'I Rosiana',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('zxasqw12'),
                'role' => User::ROLE_CUSTOMER,
                'alamat' => 'Jl. Pemuda'
            ]
        ];
        User::query()->insert($users);
    }
}
