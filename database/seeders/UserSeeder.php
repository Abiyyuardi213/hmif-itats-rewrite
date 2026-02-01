<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (!User::where('email', 'admin@hmif.com')->exists()) {
            User::create([
                'name' => 'Dimas Admin',
                'email' => 'admin@hmif.com',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]);
        }
    }
}
