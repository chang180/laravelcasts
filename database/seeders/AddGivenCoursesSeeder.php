<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddGivenCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }
        Course::create([
            'slug' => Str::of('Laravel For Beggins')->slug(),
            'title' => 'Laravel For Beggins',
            'tagline' => 'The PHP Framework for Web Artisans',
            'description' => 'The PHP Framework for Web Artisans',
            'image_name' => 'laravel-for-beggins.png',
            'learnings' => [
                'How to install Laravel',
                'How to use the most common Artisan commands',
                'How to use the most common Blade directives',
            ],
            'released_at' => now(),
        ]);

        Course::create([
            'slug' => Str::of('Advanced Laravel')->slug(),
            'title' => 'Advanced Laravel',
            'tagline' => 'The PHP Framework for Web Artisans',
            'description' => 'The PHP Framework for Web Artisans',
            'image_name' => 'advanced-laravel.png',
            'learnings' => [
                'How to install Laravel',
                'How to use the most common Artisan commands',
                'How to use the most common Blade directives',
            ],
            'released_at' => now(),
        ]);

        Course::create([
            'slug' => Str::of('TDD The Laravel Way')->slug(),
            'title' => 'TDD The Laravel Way',
            'tagline' => 'The PHP Framework for Web Artisans',
            'description' => 'The PHP Framework for Web Artisans',
            'image_name' => 'tdd-the-laravel-way.png',
            'learnings' => [
                'How to install Laravel',
                'How to use the most common Artisan commands',
                'How to use the most common Blade directives',
            ],
            'released_at' => now(),
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Course::where('title', 'Laravel For Beggins')->exists()
            && Course::where('title', 'Advanced Laravel')->exists()
            && Course::where('title', 'TDD The Laravel Way')->exists();
    }
}
