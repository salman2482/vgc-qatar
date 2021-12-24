<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingEmailToClient extends Mailable
{

    public $user_email;
    public $id;
    public $url;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email, $id, $url,$data)
    {
        $this->user_email = $user_email;
        $this->id = $id;
        $this->url = $url;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //email template
        if (!$template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'User Booking Mail')->first()) {
            return false;
        }

        // //validate
        // // if (!$this->obj instanceof \App\Models\Estimate || !$this->user instanceof \App\Models\User) {
        // //     return false;
        // // }

        // //only active templates
        // if ($template->emailtemplate_status != 'enabled') {
        //     return false;
        // }

        //get common email variables
        $payload = config('mail.data');

        $payload += [
            'id' => $this->id,
            'invoice_url' => $this->url,
            'service' => $this->data['service'],
            'name' => $this->data['name'],
        ];

        //save in the database queue
        $queue = new \App\Models\EmailQueue();
        $queue->emailqueue_to = $this->user_email;
        $queue->emailqueue_subject = $template->parse('subject', $payload);
        $queue->emailqueue_message = $template->parse('body', $payload);
        $queue->emailqueue_type = 'general';
        $queue->emailqueue_pdf_resource_type = 'user';
        $queue->emailqueue_pdf_resource_id = '';
        $queue->emailqueue_resourcetype = 'user';
        $queue->emailqueue_resourceid = '';
        $queue->save();
    }
}
