<?php

namespace App\Mail;

use App\Models\AlertRemember;
use App\Models\MessageAlert;
use App\Models\ReciveEmails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AlertEmailUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $email,$user,$message;
    public function __construct($email,$user,$message)
    {
        $this->email = $email;
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $ReciveEmails = DB::table('recive_emails')->where('email',$email)->first();
        $Alert_remember = DB::table('alert_remembers')
        ->where('id',$this->message->id_alert_remember)->first();
        return $this->markdown('mail.alert-email-user',[
            'email'=>$ReciveEmails,
            'user'=>$this->user,
            'message'=>$this->message,
            'alert'=>$Alert_remember
        ])->to($email)
        ->subject($this->message->subject);
    }
}
