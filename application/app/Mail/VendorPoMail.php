<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorPoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $vendorpo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vendorpo)
    {
        $this->vendorpo = $vendorpo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Veteran General Contracting')->view('users.vendor-po-mail');
    }
}
