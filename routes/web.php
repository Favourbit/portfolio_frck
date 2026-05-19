<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// --- NEW: Route to handle the portfolio contact form submission ---
Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

  
    Mail::to('tekogmanain@gmail.com')
        ->send(new ContactMessage(
            $validated['name'],
            $validated['email'],
            $validated['message']
        ));

    return response()->json(['success' => 'Message sent successfully!']);
})->name('contact.send');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';