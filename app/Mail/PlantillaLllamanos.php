<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlantillaLllamanos extends Mailable
{
    public $nombre;
    public $n_telefono;
    public $email;
    public $interes;


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $n_telefono, $email, $interes)
    {
        $this->nombre = $nombre;
        $this->n_telefono = $n_telefono;
        $this->email = $email;
        $this->interes = $interes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.email-llamanos')->subject('Solicitud de contacto');
    }
}
