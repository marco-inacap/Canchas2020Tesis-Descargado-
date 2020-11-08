<?php

namespace App\Http\Controllers;

use App\Complejo;
use Illuminate\Http\Request;

class ComplejoController extends Controller
{
    public function index()
    {
        $complejosQuery = Complejo::query();
        $complejosQuery->where('nombre', 'like', '%' . request('q') . '%');
        $complejos = $complejosQuery->paginate(25);


        return view('new.home.pages.complejos', compact('complejos'));
    }

    public function show(Request $request, Complejo $complejo)
    {
        $complejos = Complejo::all();
        $complejo_req = $complejo->id;

        return view('new.home.pages.canchas', [
            'complejo' => $complejo,
            'canchas' => $complejo->canchas()->paginate(2),
            'complejos' => $complejos,
            'complejo_req' => $complejo_req
        ]);
    }
}
