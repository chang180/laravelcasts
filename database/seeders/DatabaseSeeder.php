<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\Course::factory()->create(['title' => 'Course A', 'description' => 'Course A description', 'released_at' => \Carbon\Carbon::now()]);
        \App\Models\Course::factory()->create(['title' => 'Course B', 'description' => 'Course B description', 'released_at' => \Carbon\Carbon::yesterday()]);
        \App\Models\Course::factory()->create(['title' => 'Course C', 'description' => 'Course C description', 'released_at' => \Carbon\Carbon::tomorrow()]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
