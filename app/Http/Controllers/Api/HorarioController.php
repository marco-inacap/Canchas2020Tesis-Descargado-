<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Cancha;

class HorarioController extends Controller
{

    public function byComplejo($id)
    {
        return Cancha::where('complejo_id', $id)->get();
    }
}
