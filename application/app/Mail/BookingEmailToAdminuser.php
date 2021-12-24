<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingEmailToAdminuser extends Mailable
{
    use Queueable;

    /**
     * The data for merging into the email
     */
    public $service;

    /**
     * Model instance
     */
    public $data;

    public $emailerrepo;
    public $admin_email;
    public $employee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = '', $service = '', $admin_email = '',$employee)
    {

        $this->data = $data;
        $this->service = $service;
        $this->admin_email = $admin_email;
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //email template
        if (!$template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Booking Mail To Admin')->first()) {
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

        //set template variables
        $payload += [
            'full_name' => $this->data->full_name,
            'email' => $this->data->email,
            'phone' => $this->data->phone,
            'title' => $this->service->title,
            'address' => $this->data->zone_no,
            'price' => $this->data->price,
            'description' => $this->data->description,
            'employee' => $this->employee,
        ];

        //save in the database queue
        $queue = new \App\Models\EmailQueue();
        $queue->emailqueue_to = $this->admin_email;
        $queue->emailqueue_subject = $template->parse('subject', $payload);
        $queue->emailqueue_message = $template->parse('body', $payload);
        $queue->emailqueue_type = 'general';
        $queue->emailqueue_pdf_resource_type = 'admin';
        $queue->emailqueue_pdf_resource_id = '';
        $queue->emailqueue_resourcetype = 'admin';
        $queue->emailqueue_resourceid = '';
        $queue->save();
    }
}
