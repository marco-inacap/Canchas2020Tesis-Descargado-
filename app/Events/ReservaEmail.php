<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReservaEmail
{
    use Dispatchable, SerializesModels;

    public $user_reserva;
    public $email_reserva;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_reserva,$email_reserva)
    {
        $this->user_reserva = $user_reserva;
        $this->email_reserva = $email_reserva;
    }

}
