<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cancha;
use App\EstadoReserva;
use Illuminate\Support\Facades\DB;

class Reserva extends Model
{
    public const STATUS_PENDING_PAYMENT = 0;
    // Webpay Plus Normal status
    public const STATUS_WP_NORMAL_INIT_SUCCESS = 11;
    public const STATUS_WP_NORMAL_INIT_ERROR = 12;
    public const STATUS_WP_NORMAL_FINISH_SUCCESS = 13;
    public const STATUS_WP_NORMAL_FINISH_INVALID = 14;
    public const STATUS_WP_NORMAL_FINISH_ERROR = 15;
    public const STATUS_WP_NORMAL_FINISH_ABORT = 16;
    public const STATUS_WP_NORMAL_FINISH_TIMEOUT = 17;
    public const STATUS_WP_NORMAL_FINISH_FORM_FAULT = 18;

    public const STATUS_DESC = [
        self::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
        self::STATUS_WP_NORMAL_INIT_SUCCESS => 'Pago con Webpay Normal iniciado',
        self::STATUS_WP_NORMAL_INIT_ERROR => 'Error al inciar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_SUCCESS => 'Pago con Webpay Normal finalizado',
        self::STATUS_WP_NORMAL_FINISH_INVALID => 'Error de validación al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ERROR => 'Error al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ABORT => 'Pago con Webpay Normal abortado',
        self::STATUS_WP_NORMAL_FINISH_TIMEOUT => 'Pago con Webpay Normal cancelado por timeout',
        self::STATUS_WP_NORMAL_FINISH_FORM_FAULT => 'Pago con Webpay Normal con error en formulario de pago',
    ];


    protected $fillable = [

        'fecha', 'hora_inicio', 'hora_fin', 'cancha_id','complejo_id','user_id','total'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function complejo()
    {
        return $this->belongsTo(Complejo::class);
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }
    public function estadoReserva(){ //$cancha->estado->nombre
        return $this->belongsTo(EstadoReserva::class); //Pertenece solo a un estado.
    }
    
    public function scopeAllowed($query)
    {
        /* $cancha = Cancha::where('user_id')->first(); */
        /* $cancha = DB::table('canchas')->select('user_id')->first() */; 
        $canchas = DB::table('canchas')->get();


        foreach ($canchas as $cancha => $user_id) {
            # code...
        }
 
        
        if(auth()->user()->can('view',$this))
        {
           /*  $canchas = Cancha::all(); */
        return $query;
        }
        else
        {
            /*  $canchas = Cancha::where('user_id',auth()->id())->get();  */
           /*  $canchas = auth()->user()->canchas; */
        return $query->where($cancha,'===',auth()->id());
        }
    }
}
