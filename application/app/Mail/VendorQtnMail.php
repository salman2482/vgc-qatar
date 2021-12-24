<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorQtnMail extends Mailable
{
    use Queueable, SerializesModels;
    public $vendorqtn;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendorqtn)
    {
        $this->vendorqtn = $vendorqtn;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Veteran General Contracting')->view('users.vendor-qtn-mail');
    }
}
