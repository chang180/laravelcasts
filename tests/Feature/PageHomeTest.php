<?php

use function Pest\Laravel\get;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows courses overviews', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'description' =>'Course A description']);
    Course::factory()->create(['title' => 'Course B', 'description' =>'Course A description']);
    Course::factory()->create(['title' => 'Course C', 'description' =>'Course A description']);

    // Act & Assert
    get(route('home'))
        ->assertSeeText([
            'Course A',
            'Course B',
            'Course C',
        ]);
});

it('shows only release courses', function () {
    // Arrange

    // Act

    // Assert

});

it('shows courses by release date', function () {
    // Arrange

    // Act

    // Assert

});
