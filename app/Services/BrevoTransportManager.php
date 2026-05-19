<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class BrevoTransportManager extends AbstractTransport
{
    public function __invoke()
    {
        return $this;
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        
        $htmlContent = $email->getHtmlBody() ?? $email->getTextBody();

        $payload = [
            'sender' => [
                'email' => config('mail.from.address'),
                'name' => config('mail.from.name')
            ],
            'to' => collect($email->getTo())->map(fn($to) => ['email' => $to->getAddress()])->toArray(),
            'replyTo' => collect($email->getReplyTo())->map(fn($rt) => ['email' => $rt->getAddress()])->toArray() ?: null,
            'subject' => $email->getSubject(),
            'htmlContent' => (string) $htmlContent,
        ];

        // Send over secure HTTPS port 443 using your Render dashboard key
        Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', $payload)->throw();
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}