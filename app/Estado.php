<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function cancha(){
        return $this->hasMany(Cancha::class) ;
        }
}
