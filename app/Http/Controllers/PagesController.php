<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use Auth;

class PagesController extends Controller
{
    public function spa()
    {
        return view('pages.spa');
    }
    
    public function home()
    {
        $canchas = Cancha::latest('created_at')->paginate(5);

        return view ('pages.home',compact('canchas'));
    }

    public function contacto()
    {
        return view('pages.contacto');

    }

    public function reservas(){

        $reservas = Reserva::where('user_id',auth()->id())->get();


        return view('pages.reservas',compact('reservas'));

    }
}
