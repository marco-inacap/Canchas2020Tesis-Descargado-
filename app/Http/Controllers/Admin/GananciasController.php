<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Reserva;
use App\Cancha;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

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

        return view('admin.ganancias.canchas', compact('canchas','complejo'));
    }

    public function lista_reservas(Cancha $cancha)
    {
        $reservas = Reserva::where('cancha_id', $cancha->id)->get();

        $totalReservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->where('reservas.cancha_id', '=', $cancha->id)
            ->where('status','=', 13)
            ->sum('reservas.total');
        
        $totalReservasDia = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('status','=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        $ar = CarbonImmutable::now()->locale('ar');
        $start = $ar->startOfWeek(Carbon::TUESDAY);
        $end = $ar->endOfWeek(Carbon::MONDAY);

        $totalReservasSemana = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereBetween('reservas.created_at', [$start, $end])
            ->where('status','=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        $totalReservasMes = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))
            ->where('status','=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');
            
        $totalReservasMesPasado = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m')-1)
            ->where('status','=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        return view('admin.ganancias.listareservas', compact('reservas', 
                                                            'cancha', 
                                                            'totalReservas',
                                                            'totalReservasDia',
                                                            'totalReservasSemana',
                                                            'totalReservasMes',
                                                            'totalReservasMesPasado'));
    }


    public function filtrar_fechas(Request $request, Cancha $cancha)
    {
        $this->validate($request,[
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
        ]);

        $reserva = Reserva::where('cancha_id', $cancha->id)->get();
        
        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        $reservas = Reserva::whereBetween('fecha', [$fecha_inicio, $fecha_final])
                            ->where('cancha_id','=',$cancha->id)
                            ->where('status', 13)
                            ->get(); 


    $totalReservas = DB::table('reservas')
                        ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')        
                        ->whereBetween('fecha', [$fecha_inicio, $fecha_final])
                        ->where('status','=', 13)
                        ->select('reservas.total')
                        ->where('cancha_id', '=', $cancha->id)
                        ->sum('total');  
                            
    return view('admin.ganancias.listareservas', compact('reservas', 'cancha', 'totalReservas'));                     
    }

    public function all(Request $request)
    {
        $usuarioauth = Auth()->user()->id;

        $canchas = Cancha::where('user_id', auth()->id())->get();

       /* foreach ($canchas as $cancha  ) {
           
        $reservas = $cancha->reservas()->get();
        dd($reservas);
       } */
        /* $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->select('canchas.precio','reservas.created_at')
            ->where('canchas.user_id', '=',$usuarioauth)->sum('canchas.precio')->orderby('created_at','ASC')->get(); */

        return response(json_encode($canchas), 200)->header('content-type', 'text/plain');
    }

    public function detalle_complejo(Complejo $complejo)
    {
        if ($complejo->canchas->count() > 0) {
            
            $reservas = Reserva::where('complejo_id',$complejo->id)->orderby('created_at', 'DESC')->get();
            
        }else{
            return redirect()->route('admin.ganancias.index')->with('alert', 'El complejo aún no tiene canchas');
        }

        $totalReservas = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->where('reservas.complejo_id', '=', $complejo->id)
            ->where('status','=', 13)
            ->sum('reservas.total');
        
        $totalReservasDia = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('status','=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

        $ar = CarbonImmutable::now()->locale('ar');
        $start = $ar->startOfWeek(Carbon::TUESDAY);
        $end = $ar->endOfWeek(Carbon::MONDAY);

        $totalReservasSemana = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereBetween('reservas.created_at', [$start, $end])
            ->where('status','=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

        $totalReservasMes = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))
            ->where('status','=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');
            
        $totalReservasMesPasado = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m')-1)
            ->where('status','=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');
        
        $reservasHoy = Reserva::where('complejo_id',$complejo->id)
            ->where('status', 13)
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))->orderby('created_at', 'DESC')->get();

        $numReservasHoy = Reserva::where('complejo_id',$complejo->id)
            ->where('status', 13)
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))->count();
        
        $numReservasSemana = Reserva::where('complejo_id',$complejo->id)
            ->where('status', 13)
            ->whereBetween('reservas.created_at', [$start, $end])->count();
            
        $numReservasMes = Reserva::where('complejo_id',$complejo->id)
            ->where('status', 13)
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))->count();  
            
        $numReservasTotal = Reserva::where('complejo_id',$complejo->id)->where('status', 13)
        ->count(); 

        $fechas_check = Reserva::where('complejo_id',$complejo->id)
        ->where('status',13)
        ->get();

        /* foreach ($fechas_check as $check) {
        $fecha_select = $check;
        } */
        
    return view('admin.ganancias.complejo-detalle',compact('complejo',
                                                            'reservas',
                                                            'totalReservas',
                                                            'totalReservasDia',
                                                            'totalReservasSemana',
                                                            'totalReservasMes',
                                                            'totalReservasMesPasado',
                                                            'reservasHoy',
                                                            'numReservasHoy',
                                                            'numReservasSemana',
                                                            'numReservasMes',
                                                            'numReservasTotal',
                                                            'fecha_select'
                                                        ));  
    }
}
