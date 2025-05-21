<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;
    public string $body;

    public function __construct(string $email, string $body)
    {
        $this->email = $email;
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject('We received your message')
                    ->text('emails.contact.confirmation_plain')
                    ->markdown('emails.contact.confirmation');
    }
}
