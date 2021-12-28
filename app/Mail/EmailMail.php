<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $patch;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $patch = 'mail')
    {
        $this->mail = $mail;
        $this->patch = $patch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail');
    }
}
