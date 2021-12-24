<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RfmToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $rfm;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rfm)
    {
        $this->rfm = $rfm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Veteran General Contracting')->view('emails.rfm-to-admin');
    }
}
