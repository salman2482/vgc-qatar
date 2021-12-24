<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeExpiredDocuments extends Mailable
{
    use Queueable, SerializesModels;
    public $document,$date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($document,$date)
    {
        $this->document = $document;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.employee-expired-documents');
    }
}
