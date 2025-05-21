<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $fromEmail;
    public string $messageBody;
    public string $subjectLine;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectLine, string $fromEmail, string $messageBody)
    {
        $this->subjectLine = $subjectLine;
        $this->fromEmail = $fromEmail;
        $this->messageBody = $messageBody;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
            replyTo: $this->fromEmail,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.feedback',
            with: [
                'subjectLine' => $this->subjectLine,
                'fromEmail' => $this->fromEmail,
                'messageBody' => $this->messageBody,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}

