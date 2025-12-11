<?php
// database/seeders/UserSeeder.php

// php artisan db:seed --class=UserSeeder

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. The Super Admin (YOU - Has access to Laravel AdminLTE)
        User::create([
            'name'      => 'Raul Castro',
            'email'     => 'admin@root.com',
            'password'  => Hash::make('password'),
            'role'      => 'super_admin',
            'is_active' => true,
            'avatar'    => 'https://ui-avatars.com/api/?name=Raul+Castro&background=0D8ABC&color=fff',
        ]);

        // 2. The Client Manager (Has access to React App - Manager Level)
        User::create([
            'name'      => 'Client Manager',
            'email'     => 'manager@root.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        // 3. The Standard User (Has access to React App - Employee Level)
        User::create([
            'name'      => 'Standard Employee',
            'email'     => 'employee@root.com',
            'password'  => Hash::make('password'),
            'role'      => 'user',
            'is_active' => true,
        ]);

        // 4. Create 10 random extra users for testing pagination/lists
        User::factory(10)->create();
    }
}
