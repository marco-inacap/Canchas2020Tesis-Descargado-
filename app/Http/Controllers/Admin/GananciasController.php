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

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }
        /* $id = $complejos->pluck('id'); */

        foreach ($complejos as $complejo) {

            $reservas = Reserva::where('complejo_id', $complejo->id)->get();
        }

        return view('admin.ganancias.index', compact('complejos', 'reservas'));
    }

    public function ganancias_canchas(Complejo $complejo)
    {
        if ($complejo->canchas->count() > 0) {
            $canchas = $complejo->canchas()->get();
        } else {
            return redirect()->route('admin.ganancias.index')->with('alert', 'El complejo aún no tiene canchas');
        }

        return view('admin.ganancias.canchas', compact('canchas'));
    }

    public function lista_reservas(Cancha $cancha)
    {
        $reservas = Reserva::where('cancha_id', $cancha->id)->get();


        

        $totalReservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->where('reservas.cancha_id', '=', $cancha->id)
            ->sum('reservas.total');

        return view('admin.ganancias.listareservas', compact('reservas', 'cancha', 'totalReservas'));
    }


    public function filtrar_fechas(Request $request, Cancha $cancha)
    {
        $reserva = Reserva::where('cancha_id', $cancha->id)->get();

        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        $reservas = Reserva::whereBetween('fecha', [$fecha_inicio, $fecha_final])
                            ->where('cancha_id','=',$cancha->id)
                            ->get(); 


                            $totalReservas = DB::table('reservas')
                            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')        
                            ->whereBetween('fecha', [$fecha_inicio, $fecha_final])
                            ->select('reservas.total')
                            ->where('cancha_id', '=', $cancha->id)
                            ->sum('total');  
                            
                           

                            
        return view('admin.ganancias.listareservas', compact('reservas', 'cancha', 'totalReservas'));                     
    }

    public function all(Request $request)
    {

        $usuarioauth = Auth()->user()->id;

        $canchas = Cancha::where('user_id', auth()->id())->get();





        /* $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->select('canchas.precio','reservas.created_at')
            ->where('canchas.user_id', '=',$usuarioauth)->sum('canchas.precio')->orderby('created_at','ASC')->get(); */



        return response(json_encode($canchas), 200)->header('content-type', 'text/plain');
    }
}
