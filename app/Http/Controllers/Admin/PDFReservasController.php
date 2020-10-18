<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Reserva;
use App\Cancha;

class PDFReservasController extends Controller
{
    

    public function vista_Filtros()
    {

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        return view('admin.pdf.filtros',compact('complejos'));
    }

    public function export_pdf(Request $request, Reserva $reserva)
    {
        $complejo_req = $request->complejo_id;
        $cancha_req = $request->cancha_id;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        $complejo = Complejo::findOrFail($complejo_req);
        $cancha = Cancha::findOrFail($cancha_req);

        if ($fecha_inicio != '' && $fecha_fin != '') {

            $reservas = Reserva::whereBetween('fecha', array($request->fecha_inicio, $request->fecha_fin))
                ->where('complejo_id', $complejo->id)
                ->where('cancha_id', $cancha->id)
                ->where('status', '=', 13)
                ->orderby('fecha', 'ASC')
                ->get();

            $totalReservas = $reservas->where('status', '=', 13)->sum('total');
        
        }

        $pdf = \PDF::loadView(
            'admin.pdf.ganancias-pdf',
            [
                'complejo' => $complejo,
                'cancha' => $cancha,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'reservas' => $reservas,
                'totalReservas' => $totalReservas
            ]   
        );

        return $pdf->stream("Reporte/$complejo->nombre/$cancha->nombre/$fecha_inicio/$fecha_fin.pdf");
        
    }
}
