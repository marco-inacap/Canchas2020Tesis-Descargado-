<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reserva;
use App\Complejo;

class ChartsController extends Controller
{

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
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        return view('admin.charts.index', compact('complejos'));
    }

    public function chart_1(Request $request)
    {
        $complejo = Complejo::findOrFail($request->complejo_id);
        $meses = $this->arrayMeses();
        $datos = array();
        $gananciaTotal = 0;
        foreach ($meses as $key => $value) {
            $reservas = Reserva::where('complejo_id',$complejo->id)
            ->whereMonth('fecha', '=', $key)
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
}
