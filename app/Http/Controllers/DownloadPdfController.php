<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\Transaction;
use App\Respuesta;

class DownloadPdfController extends Controller
{
    

    public function download(Reserva $reserva)
    {
        $transaction = Transaction::where('reserva_id',$reserva->id)->get();  
    
    
    foreach ($transaction as $valor) {
        $responses = Respuesta::where('transaction_id',$valor->id)->get(); 
            
        
    }
    $pdf = \PDF::loadView('pages.reserva-pdf',
        [
        'reserva'=> $reserva,
        'responses' => $responses
            ]);

        return $pdf->stream("TusCanchas$reserva->fecha.pdf");
    }
}
