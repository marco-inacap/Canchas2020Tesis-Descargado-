<?php

namespace App\Http\Controllers;


use App\Cancha;
use App\Photo;
use Illuminate\Http\Request;
use Cache;

class CanchaController extends Controller
{
    public function show(Cancha $cancha)
    {
        if($cancha->isPublished() || auth()->check())
        {
            $id = $cancha->id;
            $visitas = Cancha::find($id);
            
                if(Cache::has($id)==false){
                     Cache::add($id,'contador',0.30);
                $visitas->total_visitas++;
                $visitas->save();
        }

            return view('canchas.show', compact('cancha','visitas',$visitas));

        } 
        abort(404);  
    }
    public function like(Cancha $cancha)
    {
        $cancha->likeBy();

        return back();
    }

    public function unlike(Cancha $cancha)
    {
        $cancha->unlikeBy();

        return back();
    }

    public function dislike(Cancha $cancha)
    {
        $cancha->dislikeBy();

        return back();
    }

    public function undislike(Cancha $cancha)
    {
        $cancha->undislikeBy();

        return back();
    }

    
}
