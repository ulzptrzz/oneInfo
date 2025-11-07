<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'superadmin'
        ]);
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'siswa'
        ]);

        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '0123456789',
            'role_id' => 1,
            'password' => bcrypt('super12345')
        ]);
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0123456789',
            'role_id' => 2,
            'password' => bcrypt('admin12345')
        ]);

        User::create([
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'phone' => '0123456789',
            'role_id' => 3,
            'password' => bcrypt('siswa12345')
        ]);
    }
}
