<?php

use App\Console\Commands\TweetAboutCourseReleaseCommand;
use App\Models\Course;


it('tweets about release for provided course', function () {
    // Arrange
    Twitter::fake();
    $course = Course::factory()->create();


    // Act
    $this->artisan(TweetAboutCourseReleaseCommand::class, [
        'courseId' => $course->id,
    ]);


    // Assert
    Twitter::assertTweetSent("[TESTING] I just released $course->title 🎉 check it out on ". route('pages.course-details', $course));

});
