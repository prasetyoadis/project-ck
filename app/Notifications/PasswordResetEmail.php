<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PasswordResetEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = config('app.url'). '/admin';

        return (new MailMessage)
                ->subject('Password Reset Successfully')
                ->greeting('Halo! Staff '. $notifiable->name)
                ->line(new HtmlString('Password akun Anda telah berhasil di-reset. Berikut detail informasi akun Anda:'))
                ->line(new HtmlString('<hr>'))
                ->line(new HtmlString('<ul><li>Username &ensp;: '. $notifiable->username .'</li><li>Password &ensp;&nbsp;: '. $notifiable->pass . '</li></ul>'))
                ->line(new HtmlString('<hr>'))
                ->line('Harap segera login menggunakan password baru ini dan lakukan penggantian password jika diperlukan demi menjaga keamanan akun Anda.')
                ->line('Jika ada pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.')
                ->salutation(new HtmlString('Salam,<br>'. $notifiable->admin . ' - '. config('app.name')))
                ->action('Login Sekarang', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
