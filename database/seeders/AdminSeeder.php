<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'role' => 1,
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::updateOrInsert(
            ['email' => 'super-admin@gmail.com'],
            [
                'name' => 'Super Admin User',
                'email' => 'super-admin@gmail.com',
                'role' => 2,
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::updateOrInsert(
            ['email' => 'developer@gmail.com'],
            [
                'name' => 'Developer',
                'email' => 'developer@gmail.com',
                'role' => 3,
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
