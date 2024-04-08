<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Podsumowanie extends Mailable
{
    use Queueable, SerializesModels;

    // public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($mailData)
    // {
    //     $this->mailData = $mailData;
    // }
    public function __construct()
    {
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->view('emails.podsumowanie')
       ;
        // ->with([
        //     'mailData' => $this->mailData
        // ]);
    }
}
