<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function getBuyOrderAttribute()
    {
        return sprintf('tbk_%d_%d', $this->reserva_id, $this->created_at->timestamp);
    }
}
