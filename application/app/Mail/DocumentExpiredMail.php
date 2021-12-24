<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentExpiredMail extends Mailable
{
    use Queueable, SerializesModels;
    public $doc,$date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doc,$date)
    {
        $this->doc = $doc;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.document-expired-mail');
    }
}
