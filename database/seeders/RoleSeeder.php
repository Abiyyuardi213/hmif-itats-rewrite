<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Akses penuh ke seluruh sistem.',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Akses manajemen konten dan pengguna.',
            ],
            [
                'name' => 'ketua_hima',
                'display_name' => 'Ketua Hima',
                'description' => 'Akses monitoring program kerja.',
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Akses dasar pengguna.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
