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
        $this->authorize('view', new Complejo);
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        return view('admin.pdf.filtros', compact('complejos'));
    }

    public function export_pdf(Request $request)
    {
        $this->authorize('view', new Complejo);

        $complejo_req = $request->complejo_id;
        $cancha_req = $request->cancha_id;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        $complejo = Complejo::findOrFail($complejo_req);
        $cancha = Cancha::findOrFail($cancha_req);

        if ($fecha_inicio != '' && $fecha_fin != '') {

            $reservas = Reserva::whereBetween('created_at', array($request->fecha_inicio, $request->fecha_fin))
                ->where('complejo_id', $complejo->id)
                ->where('cancha_id', $cancha->id)
                ->where('status', '=', 13)
                ->orderBy('created_at', 'ASC')
                ->get();

            $totalReservas = $reservas->where('status', '=', 13)->sum('total');

            if ($reservas->count() > 0) {
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
            } else {
                /* return response()->json(["ok" => false ]); */
                return redirect()->route('vista.filtros')->with('alert', 'No existen reservas.');
            }
        }
    }

    public function export_pdf_complejo(Request $request)
    {
        $this->authorize('view', new Complejo);

        $complejo_req = $request->complejo_id;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;



        $complejo = Complejo::findOrFail([$complejo_req]);

        if ($fecha_inicio != '' && $fecha_fin != '') {

            $reservas = Reserva::whereBetween('created_at', array($request->fecha_inicio, $request->fecha_fin))
                ->whereIn('complejo_id', $complejo_req)
                ->where('status', '=', 13)
                ->orderBy('created_at', 'ASC')
                ->get();


            $totalReservas = $reservas->where('status', '=', 13)->sum('total');

            if ($reservas->count() > 0) {
                $pdf = \PDF::loadView(
                    'admin.pdf.ganancias-pdf-complejo',
                    [
                        'complejo' => $complejo,
                        'fecha_inicio' => $fecha_inicio,
                        'fecha_fin' => $fecha_fin,
                        'reservas' => $reservas,
                        'totalReservas' => $totalReservas
                    ]
                );
                return $pdf->stream("Reporte/$fecha_inicio/$fecha_fin.pdf");
            } else {
                /* return response()->json(["ok" => false ]); */
                return redirect()->route('vista.filtros')->with('alert', 'No existen reservas.');
            }
        }
    }
}
