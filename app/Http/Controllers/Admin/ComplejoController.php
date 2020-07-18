<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Http\Requests\StoreComplejoRequest;

class ComplejoController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        if($user->hasRole('Admin'))
        {
            $complejos = Complejo::all();
            
        }else{
            
            $complejos = $user->complejo()->get(); 
            
        }


        return view('admin.complejos.index',compact('complejos'));
    }
    public function create()
    {

        return view('admin.complejos.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:30|unique:complejos',
            'imagen' => 'required',
            'ubicacion' => 'required|string|max:255',
            'telefono' => 'required|min:8|max:10|unique:complejos',
            'latitude'=>'nullable',
            'longitude'=>'nullable',
        ]);

        if($request->file('imagen')){
            $path = Storage::disk('public')->put('complejos',$request->file('imagen'));

            $data->fill(['imagen'=> asset($path)])->save();
        }

        $complejo = Complejo::create($data);

        return redirect()->route('admin.complejo.index')->withFlash('El Complejo ha sido creado');

    }
    public function edit(Complejo $complejo)
    {

        return view('admin.complejos.edit',compact('complejo'));
    }
    public function update(StoreComplejoRequest $request, Complejo $complejo)
    {
        
        
        $complejo->update($request->validated());

        return redirect()->route('admin.complejo.edit', $complejo)->with('flash','El Complejo ha sido actualizado');

    }
    public function destroy(Complejo $complejo)
    {
        $complejo->delete();
        
        return redirect()->route('admin.complejo.index')->with('flash','El Complejo ha sido eliminado');
    }

}
