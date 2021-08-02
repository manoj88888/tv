<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOTPEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $code, $logo, $company, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $logo, $company, $email)
    {
        //
         $this->code = $code;
        $this->logo = $logo;
        $this->company = $company;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('forgotemail')->subject('OTP Send Successfully!');
    }
}
