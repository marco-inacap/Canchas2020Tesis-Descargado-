<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reserva;
use App\Complejo;
use App\Cancha;
use Carbon\Carbon;
use DB;

class ChartsController extends Controller
{
    private function arrayAnos()
    {
        $fechaPrimero = Carbon::parse(Reserva::min('created_at'));
        $primerAnio = $fechaPrimero->year;

        $fechaUltimo = Carbon::parse(Reserva::max('created_at'));
        $ultimoAnio = $fechaUltimo->year;

        $anios = array();
        for ($i = $primerAnio; $i <= $ultimoAnio; $i++) {
            array_push($anios, $i);
        }

        return $anios;
    }

    private function arrayMeses()
    {
        $meses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
        return $meses;
    }

    private function nameMes($mes)
    {
        $meses = $this->arrayMeses();
        $nameMes = "";
        foreach ($meses as $key => $value) {
            if ($key == $mes) {
                $nameMes = $value;
            }
        }
        return $nameMes;
    }
    private function randomColor()
    {
        return sprintf('#%06X', mt_rand(0,16777215));
    }

    public function index(Request $request)
    {
        $this->authorize('view', new Complejo);

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
            $canchas = Cancha::all();
        } else {

            $complejos = $user->complejo()->get();
            $canchas = Cancha::where('user_id',$user->id)->get(); 
        }

        $years = $this->arrayAnos();

        return view('admin.charts.index', compact('complejos','canchas','years'));
    }

    public function chart_1(Request $request)
    {
        $complejo = Complejo::findOrFail($request->complejo_id);
        $meses = $this->arrayMeses();
        $datos = array();
        $gananciaTotal = 0;
        foreach ($meses as $key => $value) {
            $reservas = Reserva::where('complejo_id',$complejo->id)
            ->whereMonth('created_at', '=', $key)
            ->where('status', '=', 13)
            ->get();
            $gananciaMes = 0;
            foreach ($reservas as $reserva) {
                $gananciaMes += $reserva->total;
                $gananciaTotal += $reserva->total;
            }
            $proyectoMes = array(
                'Mes' => $value,
                'Total' => $gananciaMes
            );
            array_push($datos, $proyectoMes);
        }
        $proyectoTotal = array(
            'Complejo' => $complejo->nombre,
            'Total' => number_format($gananciaTotal, 0, ',', '.'),
            'ColorBG' => $this->randomColor()
        );
        return [$datos, $proyectoTotal];
    }

    public function index_2(Request $request)
    {
        $this->authorize('view', new Complejo);
        
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $canchas = Cancha::all();
        } else {

            $canchas = Cancha::where('user_id',$user->id)->get(); 
        }
        

        return view('admin.charts.index-2', compact('canchas'));
    }

    public function chart_2(Request $request)
    {
        $cancha = Cancha::findOrFail($request->cancha_id);
        $meses = $this->arrayMeses();
        $datos = array();
        $gananciaTotal = 0;
        foreach ($meses as $key => $value) {
            $reservas = Reserva::where('cancha_id',$cancha->id)
            ->whereMonth('created_at', '=', $key)
            ->where('status', '=', 13)
            ->get();
            $gananciaMes = 0;
            foreach ($reservas as $reserva) {
                $gananciaMes += $reserva->total;
                $gananciaTotal += $reserva->total;
            }
            $proyectoMes = array(
                'Mes' => $value,
                'Total' => $gananciaMes
            );
            array_push($datos, $proyectoMes);
        }
        $proyectoTotal = array(
            'Cancha' => $cancha->nombre,
            'Total' => number_format($gananciaTotal, 0, ',', '.'),
            'ColorBG' => $this->randomColor()
        );
        return [$datos, $proyectoTotal];
    }

    public function chart_3(Request $request)
    {
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        $datos = array();
        $meses = $this->arrayMeses();
        $ingresoTotal = 0;
        $gananciaTotal = 0;
        $ids = $complejos->pluck('id');
        
        foreach ($meses as $key => $value) {
            
            $reservas = Reserva::whereYear('created_at', '=', $request->year)
                ->whereMonth('created_at', '=', $key)
                ->whereIn('complejo_id', $ids)
                ->where('status', '=', 13)
                ->get();
                $ingreso = 0;
            
                foreach ($reservas as $reserva) {
                    $ingreso += $reserva->total;
                    $ingresoTotal += $reserva->total;
                    $gananciaTotal += $reserva->total;
                }
            
                $mes = array(
                    'Mes' => $value,
                    'Ingresos' => $ingreso,
                    'Complejo' => $complejos->pluck('nombre'),
                );
                array_push($datos, $mes);
        }
    
        $ganancias = array(
            'IngresoTotal' => number_format($ingresoTotal, 0, ',', '.'),
            'GananciaTotal' => number_format($gananciaTotal, 0, ',', '.'),
            'ColorBG' => $this->randomColor()
        );
        return [$datos, $ganancias];
    }
}
