<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

it('belongs to a course', function () {
    // Arrange
    $video = Video::factory()->create();

    // Act & Assert
    expect($video->course)
        ->toBeInstanceOf(Course::class);
});

it('gives back readable video duration', function () {
    // Arrange
    $video = Video::factory()->create([
        'duration_in_min' => 120,
    ]);

    // Act & Assert
    expect($video->getReadableDuration())
        ->toBe('120mins');
});

it('tells if current user has not yet watched a given video', function () {
    // Arrange
    $video = Video::factory()->create();

    // Act & Assert
    loginAsUser();
    expect($video->alreadyWatchedByCurrentUser())->toBeFalse();
});

it('tells if current user has already watched a given video', function () {
    // Arrange
    $user = User::factory()
        ->has(Video::factory(), 'watchedVideos')
        ->create();

    // Act & Assert
    loginAsUser($user);
    expect($user->watchedVideos()->first()->alreadyWatchedByCurrentUser())->toBeTrue();
});
