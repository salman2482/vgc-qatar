<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RfqMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user, $rfq;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,  $rfq)
    {
        $this->user = $user;
        $this->rfq = $rfq;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('users.index')->with(['user' => $this->user,'rfq' => $this->rfq]);
    }
}
