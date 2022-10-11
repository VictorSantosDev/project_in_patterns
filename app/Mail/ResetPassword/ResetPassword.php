<?php

namespace App\Mail\ResetPassword;

use App\Mail\Interfaces\EmailInterface;
use App\Mail\resetPasswordEmail;
use \Illuminate\Support\Facades\Mail;

class ResetPassword implements EmailInterface
{
    public $message;
    public $email;
    public $name;
    public $verify_email;
    public $resetPasswordEmail;

    public function __construct(
    $message, 
    $email, 
    $name, 
    $verify_email
    )
    {
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
        $this->verify_email = $verify_email;
    }

    public function handle()
    {
        $emailFormate = new resetPasswordEmail(
            $this->message,
            $this->email,
            $this->name,
            $this->verify_email
        );

        Mail::send($emailFormate);
    }
}
