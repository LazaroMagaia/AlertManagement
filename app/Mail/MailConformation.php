<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailConformation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $member,$user,$message;
    public function __construct($member,$message,$user)
    {
        $this->member = $member;
        $this->message=$message;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.mail-conformation',[
            "member"=>$this->member,
            "message" =>$this->message,
            "user" => $this->user
        ]);
    }
}
