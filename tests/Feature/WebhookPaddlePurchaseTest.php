<?php

use Spatie\WebhookClient\Models\WebhookCall;


it('stores a paddle purchase request', function () {
    // Arrange
    $this->withoutExceptionHandling();
    $this->assertDatabaseCount(WebhookCall::class, 0);

    // Act
    $this->post('webhooks', [
        'alert_id' => '123',
        'alert_name' => 'subscription_created',
        'cancel_url' => 'https://example.com/cancel',
        'checkout_id' => '123',
        'currency' => 'USD',
        'earnings' => '10.00',
        'email' => 'chang180@gmail.com'
    ]);

    // Assert
    $this->assertDatabaseCount(WebhookCall::class, 1);

});


it('doest not store invalid paddle purchase request', function () {
});
