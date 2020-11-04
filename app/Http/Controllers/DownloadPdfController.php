<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\Transaction;
use App\Respuesta;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Auth;

class DownloadPdfController extends Controller
{


    public function download(Reserva $reserva)
    {

        $user = Auth()->user();

        if ($user->id == $reserva->user->id || $user->hasRole(['Admin','Dueño'])) {

        $transaction = Transaction::where('reserva_id', $reserva->id)->get();

        $codigoqr = QrCode::size(80)->generate($reserva->id);

        foreach ($transaction as $valor) {
            $responses = Respuesta::where('transaction_id', $valor->id)->get();
        }

        $pdf = \PDF::loadView(
            'pages.reserva-pdf',
            [
                'reserva' => $reserva,
                'responses' => $responses,
                'codigoqr' => $codigoqr
            ]
        );
        return $pdf->stream("Comprobante de pago $reserva->fecha.pdf");
    }
    abort(403);
    }    
    
}
