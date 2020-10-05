<?php

namespace App\Http\Controllers\Admin;

use App\Cancha;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    public function store(Cancha $cancha)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048' //2048 //jpg png etc
        ]);

        /* $cancha->photos()->create([
            'url'   => request()->file('photo')->store('canchas','public'),
        ]);  */

        /* $photo = request()->file('photo')->store('canchas','public'); */

        Photo::create([
            'url' => 'storage/' . request()->file('photo')->store('canchas', 'public'),
            'cancha_id' => $cancha->id,
        ]);
    }

    public function destroy(Photo $photo)
    {

        $photo->delete();


        /* $photoPath = str_replace('storage',  $photo->url); 

        Storage::delete($photoPath);  */

        return back()->with('flash', 'Foto eliminada');
    }
}
