<?php

namespace App\Providers;

use App\TwitterClient;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TwitterOAuth::class, function () {
            return new TwitterOAuth(
                (string) config('services.twitter.comsumer_key'),
                (string) config('services.twitter.comsumer_secret'),
                (string) config('services.twitter.access_token'),
                (string) config('services.twitter.access_token_secret')
            );
        });

        $this->app->bind('twitter', function () {
            return app(TwitterClient::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
