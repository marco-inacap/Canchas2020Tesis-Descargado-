<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{

    public const PAYMENT_TYPE_CODE_NORMAL = 'VN';
    public const PAYMENT_TYPE_CODE_2_CUOTAS_SIN_INTERES = 'S2';
    public const PAYMENT_TYPE_CODE_3_CUOTAS_SIN_INTERES = 'SI';
    public const PAYMENT_TYPE_CODE_N_CUOTAS_SIN_INTERES= 'NC';
    public const PAYMENT_TYPE_CODE_2_CUOTAS_NORMALES= 'VC';
    public const PAYMENT_TYPE_CODE_DEBITO_REDCOMPRA = 'VD';
    public const PAYMENT_TYPE_CODE_PREPAGO = 'VP';

    public const STATUS_DESC = [
        self::PAYMENT_TYPE_CODE_NORMAL => 'Pago en 1 cuota',
        self::PAYMENT_TYPE_CODE_2_CUOTAS_SIN_INTERES => '2 cuotas iguales sin interés',
        self::PAYMENT_TYPE_CODE_3_CUOTAS_SIN_INTERES => '3 cuotas iguales sin interés',
        self::PAYMENT_TYPE_CODE_N_CUOTAS_SIN_INTERES => 'El comercio recibe el pago en un número de cuotas iguales y sin interés',
        self::PAYMENT_TYPE_CODE_2_CUOTAS_NORMALES => 'El emisor ofrece al tarjetahabiente entre 2 y 48 cuotas',
        self::PAYMENT_TYPE_CODE_DEBITO_REDCOMPRA => 'Pago con tarjeta de débito Redcompra',
        self::PAYMENT_TYPE_CODE_PREPAGO => 'Pago con tarjeta de débito Redcompra.',
        
    ];

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
