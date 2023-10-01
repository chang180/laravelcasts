<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddGivenVideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beggins')->firstOrFail();
        $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
        $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

        Video::insert([
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'intro',
                'vimeo_id' => '330287829',
                'title' => 'Introduction',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'installing-laravel',
                'vimeo_id' => '329875646',
                'title' => 'Installing Laravel',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 2,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'laravel-architecture',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Architecture',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'laravel-routing',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Routing',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'laravel-controllers',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Controllers',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => 'laravel-views',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Views',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => 'laravel-models',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Models',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $tddTheLaravelWayCourse->id,
                'slug' => 'laravel-migrations',
                'vimeo_id' => '330287829',
                'title' => 'Laravel Migrations',
                'description' => 'The PHP Framework for Web Artisans',
                'duration_in_min' => 1,
            ]
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Video::where('title', 'Introduction')->exists()
            && Video::where('title', 'Installing Laravel')->exists()
            && Video::where('title', 'Laravel Architecture')->exists()
            && Video::where('title', 'Laravel Routing')->exists()
            && Video::where('title', 'Laravel Controllers')->exists()
            && Video::where('title', 'Laravel Views')->exists()
            && Video::where('title', 'Laravel Models')->exists()
            && Video::where('title', 'Laravel Migrations')->exists();
    }
}
