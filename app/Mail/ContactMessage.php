<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $userMessage; // 'message' is a reserved word, so let's use userMessage

    public function __construct($name, $email, $userMessage)
    {
        $this->name = $name;
        $this->email = $email;
        $this->userMessage = $userMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('abc757001@smtp-brevo.com', 'Portfolio Contact'), // Tells Brevo: "This is an authorized sender"
            replyTo: [
                new Address($this->email, $this->name) // Allows you to hit "Reply" in your inbox to message the client back!
            ],
            subject: 'New Portfolio Message from ' . $this->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
        );
    }
}