<?php

use App\Models\Course;
use App\Models\User;

use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

it('gives back successful response for home page', function () {
    // Act & Assert
    get(route('pages.home'))
        ->assertOk();
});

it('give back successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk();
});

it('give back successful response for dashboard page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk();
});