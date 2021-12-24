<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplainMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        if(isset($this->data['attachment'])){
            return $this->subject('Veteran General Contracting')->view('users.complain')->with(['data'=>'data'])
            ->attach(url('storage/public/complain/'.$this->data['attachment']), [
                'as' => 'Complaint.'.$this->data['mime'],
                'mime' => 'application/'.$this->data['mime'],
           ]);
            }else{
                return $this->subject('Veteran General Contracting')->view('users.complain')->with(['data'=>'data']);
            }
    }
    
}
