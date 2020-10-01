<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\Complejo;
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

        $canchas = Cancha::latest('created_at')->paginate(6);

        $complejos = Complejo::latest('created_at')->paginate(3);

        //aquí quede!

        /* foreach ($canchas as $cancha) {
        
            if ($fechaActual >= $cancha->reservas->hora_inicio && $fechaActual <= $cancha->reservas->hora_fin ) {

                $cancha->estado = 1;
                $cancha->save();
            }
        } */

        return view('new.home', compact('canchas', 'complejos'));
        /* return view('pages.home', compact('canchas')); */
    }

    public function canchas_all()
    {
        $canchas = Cancha::all();
        $complejos = Complejo::all();

        return view('new.home.pages.canchas', compact('canchas', 'complejos'));
    }

    public function buscador(Request $request)
    {

        $canchas = Cancha::where('nombre', 'like', $request->texto . '%')
                        ->orWhere('precio', 'like', $request->texto . '%')
            ->get();

        return view('new.home.pages.buscador', compact('canchas'));
    }

    public function complejos_all()
    {

        $complejos = Complejo::all();

        return view('new.home.pages.complejos', compact('complejos'));
    }

    public function complejos_nav()
    {
        $complejos = Complejo::all();

        return view('new.partials.nav2', compact('complejos'));
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

    public function search()
    {
        $complejos = Complejo::all();


        return view('new.home.pages.search', compact('complejos'));
    }
}
