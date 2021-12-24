<?php

namespace App\Jobs;

use App\Mail\RFQmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user, $rfq, $materials2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $rfq, $materials2)
    {
        $this->user = $user;
        $this->rfq = $rfq;
        $this->materials2 = $materials2;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new RFQmail($this->user,  $this->rfq, $this->materials2);
        Mail::to($this->user['email'])->send($email);
    }
}
