<?php

namespace App\Http\Controllers;

use App\Complejo;
use Illuminate\Http\Request;

class ComplejoController extends Controller
{
    public function show(Complejo $complejo)
    {
        return view('pages.home',[
            'complejo' => $complejo,
            'canchas' => $complejo->canchas()->paginate(2)
        ]);
    }
}
