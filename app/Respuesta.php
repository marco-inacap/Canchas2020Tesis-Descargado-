<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $dates = ['transaction_date', 'accounting_date', 'card_expiration_date'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function getIsValidAttribute()
    {
        $valid_buy_order = $this->buy_order == $this->transaction->buy_order;
        $valid_session_id = $this->session_id == $this->transaction->reserva->id;
        $valid_amount = $this->amount == $this->transaction->reserva->amount;
        return $valid_buy_order && $valid_session_id && $valid_amount;
    }
}
