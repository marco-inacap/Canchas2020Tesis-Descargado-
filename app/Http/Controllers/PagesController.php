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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $canchas = Cancha::paginate(3);
        $complejos = Complejo::all();

        return view('new.home.pages.canchas', compact('canchas', 'complejos'));
    }

    public function pagination()
    {
        $canchas = Cancha::paginate(3);

        return view('new.home.pages.pagination', compact('canchas'));   
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

    function index()
    {
        return view('pages.reservas');
    }

    public function reservas(Request $request)
    {



        $fecha_inicio = $request->fecha_inicio;
        $fecha_final = $request->fecha_final;

        if ($fecha_inicio != '' && $fecha_final != '') {

            $reservas = Reserva::whereBetween('fecha', array($request->fecha_inicio, $request->fecha_final))
                ->where('user_id', auth()->id())
                ->where('status', '=', 13)
                ->orderby('created_at', 'DESC')
                ->get();
        } else {
            $reservas = Reserva::where('user_id', auth()->id())
                ->where('status', '=', 13)
                ->orderby('created_at', 'DESC')->get();
            /* return redirect()->route('pages.misreservas')->with('flash','La cancha ha sido guardada con éxito'); */
        }

       
            return view('pages.reservas', compact('reservas'));
        
        
    }

    public function detalle(Reserva $reserva)
    {
        $transaction = Transaction::where('reserva_id', $reserva->id)->get();

        foreach ($transaction as $valor) {
            $responses = Respuesta::where('transaction_id', $valor->id)->get();
        }

        $codigoqr = QrCode::size(80)
            ->generate($reserva->id);

        return view('pages.reserva-user', compact('reserva', 'responses', 'codigoqr'));
    }

    public function search()
    {
        $complejos = Complejo::all();


        return view('new.home.pages.search', compact('complejos'));
    }
}
