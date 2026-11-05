<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\job;
use App\Models\jobType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //insert 5 dummy record in the factory 
        // category::factory(5)->create();
        // jobType::factory(5)->create();

        job::factory(25)->create();
    }
}
