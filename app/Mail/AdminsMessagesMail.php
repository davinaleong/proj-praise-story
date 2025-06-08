<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminsMessagesMail extends Mailable
{
    use Queueable, SerializesModels;

    public Message $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject($this->message->subject)
            ->markdown('emails.admins.message')
            ->text('emails.admins.message-plain');
    }
}
