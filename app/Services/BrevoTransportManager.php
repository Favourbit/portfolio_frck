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

        // 1. Build a strict sender block using your verified master Brevo email login string
        $payload = [
            'sender' => [
                'email' => 'abc757001@smtp-brevo.com',
                'name' => config('mail.from.name', 'My Portfolio')
            ],
            'to' => collect($email->getTo())->map(fn($to) => ['email' => $to->getAddress()])->toArray(),
            'subject' => $email->getSubject(),
            'htmlContent' => (string) $htmlContent,
        ];

        // 2. Only add replyTo if a clean address is explicitly provided
        $replyToFields = collect($email->getReplyTo())->map(fn($rt) => ['email' => $rt->getAddress()])->toArray();
        if (!empty($replyToFields)) {
            $payload['replyTo'] = $replyToFields[0]; // Brevo API prefers a single object or strict schema for replyTo
        }

        // 3. Fire the secure HTTPS API post
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