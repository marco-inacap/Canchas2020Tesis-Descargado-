<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlantillaEmailReserva extends Mailable
{
    public $user_reserva;
    public $email_reserva; 

    use Queueable, SerializesModels;

    

    public function __construct($user_reserva, $email_reserva)
    {
        $this->user_reserva = $user_reserva;
        $this->email_reserva = $email_reserva; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.email-reserva')->subject('Comprobante de ReservaUnaCancha.cl');
    }
}
