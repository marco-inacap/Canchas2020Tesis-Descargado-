<?php

namespace App\Http\Controllers;

use App\Complejo;
use Illuminate\Http\Request;

class ComplejoController extends Controller
{
    public function index()
    {
        $complejosQuery = Complejo::query();
        $complejosQuery->where('nombre', 'like', '%'.request('q').'%');
        $complejos = $complejosQuery->paginate(25);

        return view('pages.complejos',compact('complejos'));
    }

    public function show(Complejo $complejo)
    {
        return view('pages.home',[
            'complejo' => $complejo,
            'canchas' => $complejo->canchas()->paginate(2)
        ]);
    }
}
