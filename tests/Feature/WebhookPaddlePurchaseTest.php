<?php

use App\Jobs\HandlePaddlePurchaseJob;
use Illuminate\Support\Facades\Queue;
use Spatie\WebhookClient\Models\WebhookCall;


it('stores a paddle purchase request', function () {
    // Arrange
    Queue::fake();
    $this->assertDatabaseCount(WebhookCall::class, 0);

    // Act
    $this->post('webhooks', _getValidPaddleRequestData());

    // Assert
    $this->assertDatabaseCount(WebhookCall::class, 1);
});


it('doest not store invalid paddle purchase request', function () {
    // Arrange
    $this->assertDatabaseCount(WebhookCall::class, 0);

    // Act
    $this->post('webhooks', _getInvalidPaddleRequestData());

    // Assert
    $this->assertDatabaseCount(WebhookCall::class, 0);
});

it('dispatches a job for valid paddle request', function () {
    // Arrange
    Queue::fake();

    // Act
    $this->post('webhooks', _getValidPaddleRequestData());

    // Assert
    Queue::assertPushed(HandlePaddlePurchaseJob::class);
});

it('does not dispatch a job for invalid paddle request', function () {
    // Arrange
    Queue::fake();

    // Act
    $this->post('webhooks', _getInvalidPaddleRequestData());

    // Assert
    Queue::assertNotPushed(HandlePaddlePurchaseJob::class);
});

function _getInvalidPaddleRequestData(): array
{
    return [];
}

function _getValidPaddleRequestData(): array
{
    return [
        'alert_id' => 271725083,
        'alert_name' => 'payment_succeeded',
        'balance_currency' => 'GBP',
        'balance_earnings' => 12.16,
        'balance_fee' => 938.06,
        'balance_gross' => 643.07,
        'balance_tax' => 608.15,
        'checkout_id' => '7-a72de94b085167d-e88d49c241',
        'country' => 'US',
        'coupon' => 'Coupon 1',
        'currency' => 'USD',
        'custom_data' => 'custom_data',
        'customer_name' => 'customer_name',
        'earnings' => 749.02,
        'email' => 'ortiz.fritz@example.org',
        'event_time' => '2023-10-04 06:13:07',
        'fee' => 0.32,
        'ip' => '148.41.20.137',
        'marketing_consent' => '',
        'order_id' => 3,
        'passthrough' => 'Example String',
        'payment_method' => 'paypal',
        'payment_tax' => 0.77,
        'product_id' => 8,
        'product_name' => 'Example String',
        'quantity' => 56,
        'receipt_url' => 'https://my.paddle.com/receipt/4/71563377fdc7a49-e87edd40b1',
        'sale_gross' => 491.5,
        'used_price_override' => 1,
        'p_signature' => 'ANJS4qevBRkqxEo0oQ4bqOfZUolDC/BTTe0c5FiY6vCyVT6nmlXa52U5o6XE8Q0LKzK1RAW+Tx6ul5IVsBKkNY7MrxrCM+sw1CnH96V3raFqJOjgLiX1XHtWwuxqZRzQviIAdjtbHfr2vnHEx7hVEtHUC/gcKsjzKy6TOTmesFTR2DowcSieoRpQaALnYlpwAq5yro/uaGAD2h2H/wmDaf1vabIS/Q3q3yAhGNzdNhTAZIkm3gGw0Ppy4e+3n1GepW5Wf9aW3noRsp1tWa2Uu7g7fog4mQr/hxR7Nql/LLdrwWgubfBuVKavZhOITIz7NOG4/XRdOVPW49EWWPu+vh1/q+XufpzKDZwnwRtdZyWemk6V84VdHU7Obcna0CSKW/5M4tdR6jZYny5NlyTb4s87xPI7ncgPtsgg3TEAFbBX5yYHh7b1ZeWHxtYkvGNf9+ijBOP31sYOsil3Vleoo4rjE7d8hP4ihA6jokQ0q2dKeTzz0H85cdyFSoFMo8mh0KBHy0G5ek8gIeIcwgahYCChbxPWa48xhsSARGOMtrq5qRaInsQaeaoQFReAub6rPnYIQ4HLhvewAC1/RtV3jSZHcvH5hMFIp+QSc2UbjsSqn0G9QM4JZJj+sONlaglITJtZp8pwovyftuQn7lxECXx/0ECZOI1nZ1LnnmeVLzI='
    ];
}
