<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reserva;

class EstadoReserva extends Model
{
    public function reserva(){
        return $this->hasMany(Reserva::class) ;
        }
}
