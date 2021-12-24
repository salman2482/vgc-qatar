<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingEmailToEmployee extends Mailable
{
    use Queueable;

    /**
     * The data for merging into the email
     */
    public $service;

    /**
     * Model instance
     */
    public $booking;

    /**
     * Model instance
     */
    public $user;

    public $schedule;

    public $emailerrepo;
    public $employee;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking = '', $schedules = '', $service = '', $user = '',$employee = '',$url)
    {

        $this->schedules = $schedules;
        $this->user = $user;
        $this->booking = $booking;
        $this->service = $service;
        $this->employee = $employee;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //email template
        if (!$template = \App\Models\EmailTemplate::Where('emailtemplate_name', 'Employee Booking Mail')->first()) {
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
            'employee' => $this->employee,
            'client' => $this->booking->full_name,
            'email' => $this->booking->email,
            'phone' => $this->booking->phone,
            'start_date' => $this->schedules->start,
            'address' => $this->booking->zone_no,
            'service_name' => $this->service->title,
            'url' => $this->url,
        ];

        //save in the database queue
        $queue = new \App\Models\EmailQueue();
        $queue->emailqueue_to = $this->user;
        $queue->emailqueue_subject = $template->parse('subject', $payload);
        $queue->emailqueue_message = $template->parse('body', $payload);
        $queue->emailqueue_type = 'general';
        $queue->emailqueue_pdf_resource_type = 'employee';
        $queue->emailqueue_pdf_resource_id = $this->service->id;
        $queue->emailqueue_resourcetype = 'employee';
        $queue->emailqueue_resourceid = $this->service->id;
        $queue->save();
    }
}
