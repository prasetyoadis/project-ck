<?php

namespace App\Listeners;

use App\Notifications\WelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmailNotification
{
    
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        //send Email Welcome
        Notification::send($event->user, new WelcomeEmail($event));
    }
}
