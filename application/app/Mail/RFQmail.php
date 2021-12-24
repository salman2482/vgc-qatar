<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RFQmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user, $rfq, $materials2;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $rfq, $materials2)
    {
        $this->user = $user;
        $this->rfq = $rfq;
        $this->materials2 = $materials2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Veteran General Contracting')->view('users.index')->with(["user" => $this->user, "rfq" => $this->rfq, "materials2" => $this->materials2]);
    }
}
