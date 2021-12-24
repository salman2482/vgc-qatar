<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractExpiredMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contract,$date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract,$date)
    {
        $this->contract = $contract;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contract-expired');
    }
}
