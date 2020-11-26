<?php

namespace App\Listeners;

use App\Events\LlamanosEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaLllamanos;

class DatosContacto
{

    /**
     * Handle the event.
     *
     * @param  LlamanosEmail  $event
     * @return void
     */
    public function handle(LlamanosEmail $event)
    {
        Mail::to('marcoignacio.9637@gmail.com')->queue(

            new PlantillaLllamanos($event->nombre, $event->n_telefono, $event->email, $event->interes)
        );
    }
}
