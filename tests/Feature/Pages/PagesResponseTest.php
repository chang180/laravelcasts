<?php

use App\Models\Course;

use function Pest\Laravel\get;

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
    // $user = User::factory()->create();

    // Act & Assert
    loginAsUser();
    get(route('pages.dashboard'))
        ->assertOk();
});

it('does not find JetStream registration page', function () {
    // Act & Assert
    get('register')
        ->assertNotFound();
});
