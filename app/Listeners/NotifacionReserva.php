<?php

namespace App\Listeners;

use App\Events\ReservaEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaEmailReserva;

class NotifacionReserva
{


    /**
     * Handle the event.
     *
     * @param  ReservaEmail  $event
     * @return void
     */
    public function handle(ReservaEmail $event)
    {
        Mail::to($event->user_reserva)->queue(

            //trengo que pasarle el email tambien

            new PlantillaEmailReserva($event->user_reserva, $event->email_reserva)
        );
    }
}
