<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@automart.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create 20 Cars
        Car::factory(20)->create();
    }
}
