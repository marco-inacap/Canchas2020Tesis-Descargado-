<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [

        'cancha_id', 'fecha', 'hora_cierre', 'hora_apertura'
    ];
    

    public function cancha()
    {
        return $this->hasOne(Cancha::class);
    }
}
