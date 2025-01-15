<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeEmail extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = config('app.url'). '/admin/dashboard';

        return (new MailMessage)
                ->subject('Welcome to CeritaKita')
                ->greeting('Halo! '. $notifiable->name)
                ->line(new HtmlString("Selamat bergabung menjadi bagian dari CeritaKita.<br>Berikut adalah detail akun anda:"))
                ->line(new HtmlString("<hr>"))
                ->line(new HtmlString('<ul><li>Username &ensp;:'. $notifiable->username .'</li><li>Password &ensp;&nbsp;: '. $notifiable->pass . '</li>'))
                ->line(new HtmlString("<hr>"))
                ->line('Silahkan login dengan menekan tombol dibawah dan ubah password default akun anda di pengaturan.')
                ->action('Masuk Dashboard', $url)
                ->salutation(new HtmlString("Salam,<br>". $notifiable->admin . " - ". config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
