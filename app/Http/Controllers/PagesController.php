<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\User;
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
use App\Events\LlamanosEmail;
use App\Http\Requests\StoreUserRequest;

class PagesController extends Controller
{


    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {

        $canchas = Cancha::latest('total_visitas','DESC')->paginate(6);
        
        $complejos = Complejo::all();

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

    public function canchas_all(Request $request)
    {
    
        $complejos = Complejo::all();

        $canchas = Cancha::orderBy('created_at','desc')->simplePaginate(6);

        $complejo_req = $request->complejo;
        
        return view('new.home.pages.canchas', compact('canchas', 'complejos','complejo_req'));
    }

    public function buscador_canchas(Request $request)
    {
        $fecha_request = $request->fecha;
        $hora_request = $request->hora;

        $complejos = Complejo::all();

        $complejo_req = $request->complejo;
        $complejo = Complejo::findOrFail($complejo_req);
        
        
        if ($complejo->canchas->count() >= 1) {

            $canchas = Cancha::where('complejo_id','=',$complejo->id)->simplePaginate(1);
            return view('new.home.pages.canchas',compact('canchas','complejos','complejo_req'));
        }else{
            
            return redirect()->route('pages.todaslascanchas')->with('alert', 'No existen canchas para'." ".$complejo->nombre." ".':(');
        }    
    }

    public function buscador(Request $request)
    {

        $canchas = Cancha::where('nombre', 'like', $request->texto . '%')
            ->orWhere('precio', 'like', $request->texto . '%')
            ->paginate(3)
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
                ->simplePaginate(6);
        } else {
            $reservas = Reserva::where('user_id', auth()->id())
                ->where('status', '=', 13)
                ->orderby('created_at', 'DESC')->simplePaginate(6);
            /* return redirect()->route('pages.misreservas')->with('flash','La cancha ha sido guardada con éxito'); */
        }
            return view('pages.reservas', compact('reservas','request'));
        
        
    }

    public function detalle(Reserva $reserva)
    {
        //solo el usuario que hizo la reserva puede visualizarla.
        if (Auth::user()->id == $reserva->user->id ) {

            $transaction = Transaction::where('reserva_id', $reserva->id)->get();

        foreach ($transaction as $valor) {
            $responses = Respuesta::where('transaction_id', $valor->id)->get();
        }

        /* $codigoqr = QrCode::size(80)
            ->generate($reserva->id); */

        $codigoqr = QrCode::size(80)->generate(url('detalle/'.$reserva->id.'/download'));

        return view('pages.reserva-user', compact('reserva', 'responses', 'codigoqr'));
            
        }
        abort(403);
        
    }

    public function search()
    {
        $complejos = Complejo::all();


        return view('new.home.pages.search', compact('complejos'));
    }

    public function llamanos(Request $request)
    {

        $nombre = $request->nombre;
        $n_telefono = $request->n_telefono;
        $email = $request->email;
        $interes = $request->select;

        LlamanosEmail::dispatch($nombre,$n_telefono,$email,$interes);

        return redirect()->route('pages.home');

    }

    public function terminos_condiciones()
    {

        return view('new.home.politicas&privacidad');

    }

    public function mi_perfil(Request $request,User $user)
    {

        $n_reservas = Reserva::where('user_id',$user->id)->count();

        return view('new.auth.mi-perfil',compact('user','n_reservas'));
    }

    public function mi_perfil_editar(Request $request,User $user)
    {
        return view('new.auth.user-edit',compact('user'));
    }

    public function mi_perfil_update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required'
        ];

        if ($request->filled('password')) 
        {
            $rules['password'] = ['confirmed','min:6'];
        }

        $data = $request->validate($rules);

        $user->update($data);
        
        return redirect()->route('pages.mi_perfil', $user);
    }
}
