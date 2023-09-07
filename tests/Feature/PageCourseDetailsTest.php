<?php

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;



uses(RefreshDatabase::class);

it('does not find unreleased courses', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('course-details', $course))
        ->assertNotFound();
});

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings,
        ])
        ->assertSee(asset("images/$course->image_name"));
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()
    ->has(Video::factory()->count(3))
    ->released()
    ->create();

    // Act & Assert
    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});
