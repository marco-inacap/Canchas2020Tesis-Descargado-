<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Reserva;
use App\Cancha;
use Illuminate\Support\Facades\DB;

class GananciasController extends Controller
{
    
    public function index()
    {
        $user = Auth()->user();

        if($user->hasRole('Admin'))
        {
            $complejos = Complejo::all();
            
        }else{
            
            $complejos = $user->complejo()->get(); 
           
        }

        $id = $complejos->pluck('id');
        
        $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->join('complejos','complejos.id','=','canchas.complejo_id')
            ->select('canchas.precio')
            ->where('canchas.complejo_id', '=', $id)->sum('canchas.precio');
    
        return view('admin.ganancias.index',compact('complejos','totalReservas'));
    }

    public function ganancias_canchas(Complejo $complejo)
    {
        if ($complejo->canchas->count() > 0) {
            $canchas = $complejo->canchas()->get();
        }else{
            return redirect()->route('admin.ganancias.index')->with('alert','El complejo aún no tiene canchas');
        }

        return view('admin.ganancias.canchas',compact('canchas'));
    }

    public function lista_reservas(Cancha $cancha)
    {
        $reservas = Reserva::where('cancha_id',$cancha->id)->get();

        $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->select('canchas.precio')
            ->where('reservas.cancha_id', '=',$cancha->id)->sum('canchas.precio');

            

        return view('admin.ganancias.listareservas',compact('reservas','cancha','totalReservas'));
    }

    public function all(Request $request)
    {
        
        $usuarioauth = Auth()->user()->id;

        $canchas = Cancha::where('user_id',auth()->id())->get(); 
        
        
        


        /* $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->select('canchas.precio','reservas.created_at')
            ->where('canchas.user_id', '=',$usuarioauth)->sum('canchas.precio')->orderby('created_at','ASC')->get(); */

    

        return response(json_encode($canchas),200)->header('content-type','text/plain');
    }

    
}
