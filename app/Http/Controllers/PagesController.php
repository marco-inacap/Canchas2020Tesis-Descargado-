<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Transaction;
use App\Respuesta;
use Carbon\Carbon;
use Auth;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;

class PagesController extends Controller
{

    
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
        $fechaActual = Carbon::now()->format('y-m-d H:i:s');

        $canchas = Cancha::latest('created_at')->paginate(5);

        //aquí quede!

        /* foreach ($canchas as $cancha) {
        
            if ($fechaActual >= $cancha->reservas->hora_inicio && $fechaActual <= $cancha->reservas->hora_fin ) {

                $cancha->estado = 1;
                $cancha->save();
            }
        } */
        


        
        

        

        return view('pages.home', compact('canchas'));
    }

    public function contacto()
    {
        return view('pages.contacto');
    }

    public function reservas()
    {

        $reservas = Reserva::where('user_id', auth()->id())->orderby('created_at', 'DESC')->get();



        return view('pages.reservas', compact('reservas'));
    }

    public function detalle(Reserva $reserva)
    {

        $transaction = Transaction::where('reserva_id', $reserva->id)->get();


        foreach ($transaction as $valor) {
            $responses = Respuesta::where('transaction_id', $valor->id)->get();
        }


        return view('pages.reserva-user', compact('reserva', 'responses'));
    }
}
