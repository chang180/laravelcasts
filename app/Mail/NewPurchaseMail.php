<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Mail\Mailable;

class NewPurchaseMail extends Mailable
{
    /**
     * Create a new message instance.
     */
    public function __construct(public Course $course)
    {
    }

    public function build()
    {
        return $this->markdown('emails.new-purchase');
    }
}
