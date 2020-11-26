<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LlamanosEmail
{
    use Dispatchable, SerializesModels;

    public $nombre;
    public $n_telefono;
    public $email;
    public $interes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nombre,$n_telefono,$email,$interes)
    {
        $this->nombre = $nombre;
        $this->n_telefono = $n_telefono;
        $this->email = $email;
        $this->interes = $interes;
    }
}
