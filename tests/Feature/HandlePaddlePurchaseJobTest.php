<?php

use App\Jobs\HandlePaddlePurchaseJob;
use App\Models\Course;
use App\Models\PurchasedCourse;
use App\Models\User;
use Spatie\WebhookClient\Models\WebhookCall;

it('stores paddle purchse', function () {
    // Assert
    $this->assertDatabaseCount(User::class, 0);
    $this->assertDatabaseCount(PurchasedCourse::class, 0);

    // Arrange
    $course = Course::factory()->create(['paddle_product_id' => '01hbstvdtddp3rpp2haxc95r92']);
    $webhookCall = WebhookCall::create([
        'name' => 'default',
        'url' => 'https://example.com/webhooks',
        'payload' => [
            'email' => 'test@test.at',
            'name' => 'Test User',
            'p_product_id' => '01hbstvdtddp3rpp2haxc95r92',
        ]
    ]);

    // Act
    (new HandlePaddlePurchaseJob($webhookCall))->handle();

    // Assert
    $this->assertDatabaseHas(User::class, [
        'email' => 'test@test.at',
        'name' => 'Test User',
    ]);

    $user = User::where('email', 'test@test.at')->first();

    $this->assertDatabaseHas(PurchasedCourse::class, [
        'user_id' => $user->id,
        'course_id' => $course->id,
    ]);
});

it('stores paddle purchase for given user', function () {
    // Arrange
    $this->assertDatabaseCount(WebhookCall::class, 0);

    // Act
    $this->post('webhooks', _getValidPaddleRequestData());

    // Assert
    $this->assertDatabaseHas(WebhookCall::class, [
        'payload' => json_encode(_getValidPaddleRequestData()),
        'user_id' => 1,
    ]);
});

it('sends out purchase email', function () {
    // Arrange
    Mail::fake();
    $this->assertDatabaseCount(WebhookCall::class, 0);

    // Act
    $this->post('webhooks', _getValidPaddleRequestData());

    // Assert
    Mail::assertSent(PurchaseConfirmationMail::class);
});
