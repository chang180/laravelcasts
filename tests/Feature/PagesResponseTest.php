<?php

use App\Models\Course;

use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

it('gives back successful response for home page', function () {
    // Act & Assert
    get(route('home'))
        ->assertOk();
});

it('give back successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('course-details', $course))
        ->assertOk();
});
