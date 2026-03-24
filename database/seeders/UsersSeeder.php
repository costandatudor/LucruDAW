<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ion Popescu',
            'email' => 'ion.popescu@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Maria Ionescu',
            'email' => 'maria.ionescu@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Andrei Georgescu',
            'email' => 'andrei.georgescu@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Elena Dumitru',
            'email' => 'elena.dumitru@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Mihai Nikolas',
            'email' => 'mihai.nikolas@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
