<?php
// database/seeders/DatabaseSeeder.php

// php artisan migrate:fresh --seed

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // We call the specific seeders here
        $this->call([
            UserSeeder::class,
            // later you can add PostSeeder::class, SettingSeeder::class, etc.
        ]);
    }
}
