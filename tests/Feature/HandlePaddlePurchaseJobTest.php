<?php

use App\Jobs\HandlePaddlePurchaseJob;
use App\Mail\NewPurchaseMail;
use App\Models\Course;
use App\Models\PurchasedCourse;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Models\WebhookCall;

beforeEach(function () {
    Mail::fake();
    $this->dummyWebhookCall = WebhookCall::create([
        'name' => 'default',
        'url' => 'https://example.com/webhooks',
        'payload' => [
            'email' => 'test@test.at',
            'name' => 'Test User',
            'p_product_id' => '01hbstvdtddp3rpp2haxc95r92',
        ]
    ]);
});

it('stores paddle purchase', function () {
    // Assert
    $this->assertDatabaseCount(User::class, 0);
    $this->assertDatabaseCount(PurchasedCourse::class, 0);

    // Arrange
    $course = Course::factory()->create(['paddle_product_id' => '01hbstvdtddp3rpp2haxc95r92']);

    // Act
    (new HandlePaddlePurchaseJob($this->dummyWebhookCall))->handle();

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
    $user = User::factory()->create(['email' => 'test@test.at']);
    $course = Course::factory()->create(['paddle_product_id' => '01hbstvdtddp3rpp2haxc95r92']);

    // Act
    (new HandlePaddlePurchaseJob($this->dummyWebhookCall))->handle();

    // Assert
    $this->assertDatabaseCount(User::class, 1);
    $this->assertDatabaseHas(User::class, [
        'email' => $user->email,
        'name' => $user->name,
    ]);

    $this->assertDatabaseHas(PurchasedCourse::class, [
        'user_id' => $user->id,
        'course_id' => $course->id,
    ]);
});

it('sends out purchase email', function () {
    // Arrange
    Course::factory()->create(['paddle_product_id' => '01hbstvdtddp3rpp2haxc95r92']);


    // Act
    (new HandlePaddlePurchaseJob($this->dummyWebhookCall))->handle();

    // Assert
    Mail::assertSent(NewPurchaseMail::class);
});
