<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerApplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $career;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($career)
    {
        $this->career = $career;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Veteran General Contracting')->view('users.career-apply');
    }
}
