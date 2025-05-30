<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@sekolah.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
