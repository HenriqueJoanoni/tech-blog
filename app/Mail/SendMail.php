<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build(): SendMail
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('NO-REPLY: email from TechBlog')
            ->view('SendMail');
    }
}
