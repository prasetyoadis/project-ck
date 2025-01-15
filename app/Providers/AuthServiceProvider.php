<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\HtmlString;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email')
                ->greeting('Halo! '. $notifiable->name)
                ->line('Klik tombol di bawah untuk verifikasi akun email Anda.')
                ->action('Verifikasi Sekarang', $url)
                ->line('Jika Anda tidak membuat akun baru, abaikan email verifikasi ini.')
                // ->lines('Salam', 'Seobacklink')
                // ->markdown(['subcopy' => $subcopy ])
                ->salutation(new HtmlString("Salam,<br>". config('app.name'). "" ));
                // ->outroLines('');
        });
    }
}
