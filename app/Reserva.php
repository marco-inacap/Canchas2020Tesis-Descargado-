<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cancha;
use App\EstadoReserva;
use Illuminate\Support\Facades\DB;

class Reserva extends Model
{
    protected $fillable = [

        'fecha', 'hora_inicio', 'hora_fin', 'cancha_id', 'user_id'
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
