<?php

namespace App\Jobs;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class HandlePaddlePurchaseJob extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::create([
            'name' => $this->webhookCall->payload['name'],
            'email' => $this->webhookCall->payload['email'],
            'password' => bcrypt(Str::uuid())
        ]);

        $course = Course::where('paddle_product_id', $this->webhookCall->payload['p_product_id'])->first();
        $user->purchasedCourses()->attach($course);
    }
}
