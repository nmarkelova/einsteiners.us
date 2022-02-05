<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->from('info@einsteiners.us', 'Einsteiners Service')
                ->greeting('Hello! Einsteiners.us')
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    }
}

 /*
    ->attach('/path/to/file', [
        'as' => 'name.pdf',
        'mime' => 'application/pdf',
    ]);
    */
/*
return (new MailMessage)->view(
    ['emails.name.html', 'emails.name.plain'],
    ['invoice' => $this->invoice]
);
*/
