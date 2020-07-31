<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cancha;
use App\User;
use App\Reserva;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        /* $this->authorize($user->hasPermissionTo('Primer Acceso')); */
        $usuarioauth = Auth()->user()->id;

        $reservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->join('users', 'reservas.user_id', '=', 'users.id')
            ->select(
                'users.name',
                'reservas.id',
                'reservas.fecha',
                'reservas.hora_inicio',
                'reservas.hora_fin',
                'canchas.nombre',
                'canchas.descripcion',
                'canchas.precio',
                'canchas.complejo_id',
                'reservas.user_id',
                'reservas.total',
                'reservas.created_at'
            )
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('status','=', 13)
            ->where('canchas.user_id', '=', $usuarioauth)
            ->get();


        $totalReservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->where('canchas.user_id', '=', $usuarioauth)->sum('reservas.total');

        $totalReservasMes = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m'))
            ->where('canchas.user_id', '=', $usuarioauth)->sum('reservas.total');

        $totalReservasMesPasado = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereMonth('reservas.created_at', Carbon::now()->format('m') - 1)
            ->where('canchas.user_id', '=', $usuarioauth)->sum('reservas.total');

        /* Carbon::setWeekStartsAt(Carbon::MONDAY);
    Carbon::setWeekEndsAt(Carbon::SUNDAY); */

        $ar = CarbonImmutable::now()->locale('ar');

        $start = $ar->startOfWeek(Carbon::TUESDAY);
        $end = $ar->endOfWeek(Carbon::MONDAY);

        $totalReservasSemana = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereBetween('reservas.created_at', [$start, $end])
            ->where('canchas.user_id', '=', $usuarioauth)->sum('reservas.total');

        $totalReservasDia = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('reservas.total')
            ->whereDay('reservas.created_at', Carbon::now()->format('d'))
            ->where('canchas.user_id', '=', $usuarioauth)->sum('reservas.total');
            /* $reservas = Auth::user()->id ===  ; */

            /* $reservas = Reserva::where($cancha,auth()->id())->get();  */
        return view('admin.dashboard', compact(
            'reservas',
            'totalReservas',
            'totalReservasMes',
            'totalReservasMesPasado',
            'totalReservasSemana',
            'totalReservasDia'
        ));
    }

    public function grafico()
    {
        $usuarioauth = Auth()->user()->id;

        $totalReservas = DB::table('reservas')
            ->join('canchas', 'canchas.id', '=', 'reservas.cancha_id')
            ->select('canchas.precio')
            ->where('canchas.user_id', '=', $usuarioauth)->sum('canchas.precio');


        return view('admin.ganancias.grafico', compact('totalReservas'));
    }
}
