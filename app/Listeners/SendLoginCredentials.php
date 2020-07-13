<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use App\Mail\LoginCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLoginCredentials
{
   

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        //enviar email con las credenciales de login
        Mail::to($event->user)->queue(
            new LoginCredentials($event->user, $event->password)
        );
    }
}
