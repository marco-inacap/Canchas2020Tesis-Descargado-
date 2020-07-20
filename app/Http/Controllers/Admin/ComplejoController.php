<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Http\Requests\StoreComplejoRequest;
use Illuminate\Support\Facades\Storage;

class ComplejoController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }


        return view('admin.complejos.index', compact('complejos'));
    }
    public function create()
    {

        return view('admin.complejos.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:30|unique:complejos',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'ubicacion' => 'required|string|max:255',
            'telefono' => 'required|min:8|max:13|unique:complejos',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        Complejo::create([

            'nombre' => request('nombre'),
            'ubicacion' => request('ubicacion'),
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'telefono' => request('telefono'),
            'url_imagen' => 'storage/' . request()->file('imagen')->store('complejos', 'public'),

        ]);

        return redirect()->route('admin.complejo.index')->withFlash('El Complejo ha sido creado');
    }
    public function edit(Complejo $complejo)
    {

        return view('admin.complejos.edit', compact('complejo'));
    }
    public function update(StoreComplejoRequest $request, Complejo $complejo)
    {

        

            $complejo->update(
                $request->validated()
                
            );
        

        return redirect()->route('admin.complejo.edit', $complejo)->with('flash', 'El Complejo ha sido actualizado');
    }
    public function destroy(Complejo $complejo)
    {
        $complejo->delete();

        return redirect()->route('admin.complejo.index')->with('flash', 'El Complejo ha sido eliminado');
    }
}
