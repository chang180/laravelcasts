<?php

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;

it('does not find unreleased courses', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertNotFound();
});

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
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
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});

it('includes checkout button', function () {
    // Arrange
    config()->set('services.checkout.store', 'store');
    $course = Course::factory()
        ->released()
        ->create(
        [
            'checkout_id' => 'checkout_id',
        ]
    );

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee('https://ccore.newebpay.com/EPG/store',false);
});
