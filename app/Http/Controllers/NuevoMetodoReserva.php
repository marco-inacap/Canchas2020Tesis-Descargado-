<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\Horario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NuevoMetodoReserva extends Controller
{
    public function init(Request $request,Cancha $cancha)
    {
     
        $horarios = Horario::where('cancha_id',$cancha->id)->get();

        

        return view('new.home.reserva.modal-reserva',compact('cancha'));
    }
}
