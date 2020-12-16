<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;
use App\Http\Requests\StoreComplejoRequest;
use Illuminate\Support\Facades\Storage;
use Image;

class ComplejoController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Complejo);

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
        $this->authorize('create', $complejo = new Complejo);

        return view('admin.complejos.create', compact('complejo'));
    }
    public function store(Request $request)
    {
        $this->authorize('create', new Complejo);

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
        $this->authorize('update', $complejo);
        return view('admin.complejos.edit', compact('complejo'));
        /* $user = Auth()->user();
        $complejos = $user->complejo()->get();
        $ids = $complejos->pluck('id');

        if ($user->hasRole('Admin')) {
            return view('admin.complejos.edit', compact('complejo'));
        }

        foreach ($ids as $id) {
            if ($complejo->id === $id) {
                return view('admin.complejos.edit', compact('complejo'));
            } else {
                abort(403);
            }
        } */

    }
    public function update(StoreComplejoRequest $request, Complejo $complejo)
    {
        $this->authorize('update', $complejo);


        if ($request->hasFile('imagen')) {

            $img = $request->file('imagen');

            $oldFileName = $complejo->url_imagen;
            Storage::delete($oldFileName);

            $oldFileName = str_replace('storage/', '', $oldFileName);
            Storage::disk('public')->delete($oldFileName);

            $complejo->update([
                $request->validated(),
                'url_imagen' => 'storage/' . $img->store('complejos', 'public')
            ]);
        }
        $complejo->update($request->validated());


        return redirect()->route('admin.complejo.edit', $complejo)->with('flash', 'El Complejo ha sido actualizado');
    }
    public function destroy(Complejo $complejo)
    {
        $this->authorize('delete', $complejo);

        $complejo->delete();

        return redirect()->route('admin.complejo.index')->with('flash', 'El Complejo ha sido eliminado');
    }
}
