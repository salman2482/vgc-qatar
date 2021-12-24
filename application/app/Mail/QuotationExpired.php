<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationExpired extends Mailable
{
    use Queueable, SerializesModels;
    public $quotation,$date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotation,$date) {
        $this->quotation = $quotation;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quotation-expired');
    }
}
