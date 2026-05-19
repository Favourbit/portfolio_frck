<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http; // <--- THIS WAS MISSING! ADD THIS LINE
use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::post('/contact', function (Request $request) {
    // 1. Validate the incoming portfolio request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // 2. Fire a direct, standard HTTPS POST request straight to Brevo's endpoint
    $response = Http::withHeaders([
        'api-key' => env('BREVO_API_KEY'),
        'accept' => 'application/json',
        'content-type' => 'application/json',
    ])->post('https://api.brevo.com/v3/smtp/email', [
        'sender' => [
            'name' => 'Portfolio System',
            'email' => 'tekogmanain@gmail.com', // double check this matches your Brevo login email
        ],
        'to' => [
            [
                'email' => 'tekogmanain@gmail.com',
                'name' => 'Favour'
            ]
        ],
        'replyTo' => [
            'email' => $validated['email'],
            'name' => $validated['name']
        ],
        'subject' => 'New Portfolio Message from ' . $validated['name'],
        'htmlContent' => '
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> ' . e($validated['name']) . '</p>
            <p><strong>Email:</strong> ' . e($validated['email']) . '</p>
            <p><strong>Message:</strong></p>
            <p>' . nl2br(e($validated['message'])) . '</p>
        '
    ]);

    // 3. If Brevo says OK, return success to your frontend
    if ($response->successful()) {
        return response()->json(['success' => 'Message sent successfully! ']);
    }

    // Otherwise, return what Brevo explicitly said went wrong so you can see it instantly
    return response()->json([
        'error' => 'Brevo rejected request',
        'details' => $response->json()
    ], 500);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';