<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $message; 
    private $email; 
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $message, string $email, string $name, string $urlHttpHost)
    {
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
        $this->urlHttpHost = $urlHttpHost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->message);
        $this->to($this->email, $this->name);
        return $this->markdown('mail.verificationEmail', [
            'email' => $this->email,
            'name' => $this->name,
            'urlHttpHost' => $this->urlHttpHost
        ]);
    }
}
