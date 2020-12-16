<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Reserva;
use App\Cancha;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DB;


class GananciasController extends Controller
{

    public function index()
    {   
        $this->authorize('view', new Complejo);

        $user = Auth()->user();
        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }
        /* $id = $complejos->pluck('id'); */


        return view('admin.ganancias.index', compact('complejos'));
    }

    public function ganancias_canchas(Complejo $complejo)
    {
        $this->authorize('view', new Complejo);

        if ($complejo->canchas->count() > 0) {
            $canchas = $complejo->canchas()->get();
        } else {
            return redirect()->route('admin.ganancias.index')->with('alert', 'El complejo aún no tiene canchas');
        }
        return view('admin.ganancias.canchas', compact('canchas', 'complejo'));

    }

    public function lista_reservas(Cancha $cancha, Request $request)
    {

        $this->authorize('view', new Complejo);
        /* $reservas = Reserva::where('cancha_id', $cancha->id)->get();   */

        //procedimiento almacenado
        /* $reservas = collect(DB::select('call totalReservas()',array($cancha)))
        ->where('cancha_id',$cancha->id)->sortByDesc('created_at');  */



        $totalReservasDia = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('status', '=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        $ar = CarbonImmutable::now()->locale('ar');
        $start = $ar->startOfWeek(Carbon::TUESDAY);
        $end = $ar->endOfWeek(Carbon::MONDAY);

        $totalReservasSemana = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereBetween('reservas.created_at', [$start, $end])
            ->where('status', '=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        $totalReservasMes = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))
            ->where('status', '=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');

        $totalReservasMesPasado = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m') - 1)
            ->where('status', '=', 13)
            ->where('reservas.cancha_id', '=', $cancha->id)->sum('reservas.total');


        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        if ($fecha_inicio != '' && $fecha_final != '') {

            $reservas = Reserva::whereBetween('fecha', array($request->fecha_inicio, $request->fecha_final))
                ->where('cancha_id', $cancha->id)
                //lo comente para que el administrador pueda ver las reservas nulas o las erroneas.
                /* ->where('status', '=', 13) */
                ->orderby('fecha', 'ASC')
                ->get();

            $totalReservas = $reservas->sum('total');
        } else {

            $reservas = Reserva::where('cancha_id', $cancha->id)
                ->where('status', '=', 13)
                ->orderby('fecha', 'ASC')->get();

            $totalReservas = $reservas->sum('total');
        }

        return view('admin.ganancias.listareservas', compact(
            'reservas',
            'cancha',
            'totalReservas',
            'totalReservasDia',
            'totalReservasSemana',
            'totalReservasMes',
            'totalReservasMesPasado',
            'request'
        ));
    }
    /* public function filtrar_fechas(Request $request, Cancha $cancha)
    {
        $this->validate($request, [
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
        ]);

        $reserva = Reserva::where('cancha_id', $cancha->id)->get();

        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        $reservas = Reserva::whereBetween('fecha', [$fecha_inicio, $fecha_final])
            ->where('cancha_id', '=', $cancha->id)
            ->where('status', 13)
            ->get();

        $totalReservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->whereBetween('fecha', [$fecha_inicio, $fecha_final])
            ->where('status', '=', 13)
            ->select('reservas.total')
            ->where('cancha_id', '=', $cancha->id)
            ->sum('total');

        return view('admin.ganancias.listareservas', compact('reservas', 'cancha', 'totalReservas','totalReservasDia'));
    } */

    public function all()
    {
        $usuarioauth = Auth()->user()->id;

        $canchas = Cancha::where('user_id', auth()->id())->get();
        $ids = $canchas->pluck('id');
        $reservas = Reserva::whereIn('cancha_id', $ids)
            ->where('status', '=', 13)
            ->get();

        /* foreach ($canchas as $cancha  ) {
        $reservas = $cancha->reservas()->get();
        dd($reservas);
       } */
        /* $totalReservas = DB::table('reservas')
            ->join('canchas','canchas.id','=','reservas.cancha_id')
            ->select('canchas.precio','reservas.created_at')
            ->where('canchas.user_id', '=',$usuarioauth)->sum('canchas.precio')->orderby('created_at','ASC')->get(); */

        return response(json_encode($reservas), 200)->header('content-type', 'text/plain');
    }

    public function detalle_complejo(Complejo $complejo, Request $request)
    {
        $this->authorize('view', new Complejo);
        /* if ($complejo->canchas->count() > 0) {

            $reservas = Reserva::where('complejo_id', $complejo->id)->orderby('created_at', 'DESC')->get();
        } else {
            return redirect()->route('admin.ganancias.index')->with('alert', 'El complejo aún no tiene canchas');
        } */

        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        $fecha_pagos_inicio = $request->fecha_pago_inicio;
        $fecha_pagos_final = $request->fecha_pago_final;



        if ($fecha_inicio != '' && $fecha_final != '') {

            $reservas = Reserva::whereBetween('fecha', array($request->fecha_inicio, $request->fecha_final))
                ->where('complejo_id', $complejo->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $totalReservas = $reservas->where('status', '=', 13)->sum('total');
        } else {
            $reservas = Reserva::where('complejo_id', $complejo->id)
                ->where('status', '=', 13)
                ->orderBy('created_at', 'desc')
                ->get();

            $totalReservas = $reservas->where('status', '=', 13)->sum('total');
        }


        //arreglar

        /* if ($fecha_pagos_inicio != '' && $fecha_pagos_final != '') {

            $reservas = Reserva::whereBetween('created_at', array($request->fecha_pago_inicio, $request->fecha_pago_final))
                ->where('complejo_id', $complejo->id)
                ->orderby('created_at', 'DESC')
                ->get();

            $totalReservas = $reservas->where('status', '=', 13)->sum('total');
        } */

        /* $totalReservas = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->where('reservas.complejo_id', '=', $complejo->id)
            ->where('status', '=', 13)
            ->sum('reservas.total'); */

        $totalReservasDia = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('status', '=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

            $totalReservasDiaAnterior = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at','<', Carbon::now()->format('d'))
            ->where('status', '=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

            

        $ar = CarbonImmutable::now()->locale('ar');
        $start = $ar->startOfWeek(Carbon::TUESDAY);
        $end = $ar->endOfWeek(Carbon::MONDAY);

        $totalReservasSemana = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereBetween('reservas.created_at', [$start, $end])
            ->where('status', '=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

        $totalReservasMes = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))
            ->where('status', '=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');

        $totalReservasMesPasado = DB::table('reservas')
            ->join('complejos', 'complejos.id', '=', 'reservas.complejo_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m') - 1)
            ->where('status', '=', 13)
            ->where('reservas.complejo_id', '=', $complejo->id)->sum('reservas.total');


            /* $valor_inicial = $totalReservasMesPasado;
            $valor_final = $totalReservasMes;
            
            $incremento = $valor_inicial - $valor_final;
            $valor = $incremento/$valor_inicial*100;

            dd($valor); */

        $reservasHoy = Reserva::where('complejo_id', $complejo->id)
            ->where('status', 13)
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))->orderby('created_at', 'DESC')->get();

        $numReservasHoy = Reserva::where('complejo_id', $complejo->id)
            ->where('status', 13)
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))->count();

        $numReservasSemana = Reserva::where('complejo_id', $complejo->id)
            ->where('status', 13)
            ->whereBetween('reservas.created_at', [$start, $end])->count();

        $numReservasMes = Reserva::where('complejo_id', $complejo->id)
            ->where('status', 13)
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))->count();

        $numReservasTotal = Reserva::where('complejo_id', $complejo->id)->where('status', 13)
            ->count();

        $fechas_check = Reserva::where('complejo_id', $complejo->id)
            ->where('status', 13)
            ->get();

        return view('admin.ganancias.complejo-detalle', compact(
            'complejo',
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
            'request'
            /* 'fecha_select' */
        ));
    }
}
