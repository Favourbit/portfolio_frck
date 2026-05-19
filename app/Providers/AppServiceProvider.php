<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL; // <--- ADD THIS IMPORT
use App\Services\BrevoTransportManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Force HTTPS production URLs to eliminate Mixed Content blocking
        if (config('app.env') === 'production' || env('FORCE_HTTPS') === true) {
            URL::forceScheme('https');
        }

        // 2. Bind our custom HTTPS Brevo transport to the 'brevo' mailer keyword
        Mail::extend('brevo', function (array $config) {
            return new BrevoTransportManager();
        });
    }
}