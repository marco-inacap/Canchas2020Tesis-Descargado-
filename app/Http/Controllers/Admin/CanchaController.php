<?php

namespace App\Http\Controllers\Admin;

use App\Cancha;
use App\Complejo;
use App\Estado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCanchaRequest;
use Illuminate\Support\Facades\DB;
use Auth;

class CanchaController extends Controller
{

    public function index()
    {
        $this->authorize('view', new Cancha);

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            
            $canchas = Cancha::all();
        }else{
            $canchas = Cancha::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
            /* $canchas = auth()->user()->canchas; */
    
            /* $canchas = Cancha::allowed()->get();  */
        }

        return view('admin.canchas.index', compact('canchas'));
    }

    public function create()
    {

        $this->authorize('create', new Cancha);

        $complejos = Complejo::all();
        $estados = Estado::all();

        return view('admin.canchas.create', compact('complejos', 'estados'));
    }

    public function store(Request $request)
    {


        $this->authorize('create', new Cancha);

        $this->validate($request, [
            'nombre' => 'required|min:3',
        ]);
        /*  $cancha = Cancha::create( $request->only('nombre')); */
        $cancha = Cancha::create($request->all());



        /* $cancha = new Cancha;
        $cancha->nombre = $request->get('nombre'); */
        return redirect()->route('admin.cancha.edit', $cancha);
    }

    public function edit(Cancha $cancha)
    {
        /*         $usuarioauth = Auth()->user()->id;

        $complejos = DB::table('users')
        ->join('complejos','complejos.id','=','users.complejo_id')
        ->select('complejos.id')
        ->where('users.complejo_id', '=',$usuarioauth)->get();  */



        $this->authorize('update', $cancha);

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        return view(
            'admin.canchas.edit',
            [
                'cancha'    => $cancha,
                'estados'   => Estado::all(),
            ],
            compact('complejos')
        );
    }

    public function update(Cancha $cancha, StoreCanchaRequest $request)
    {
        $this->authorize('update', $cancha);

        $cancha->update($request->all());

        return redirect()->route('admin.cancha.edit', $cancha)->with('flash', 'La cancha ha sido guardada con éxito');
    }

    public function destroy(Cancha $cancha)
    {

        $this->authorize('delete', $cancha);
        // $cancha->photos()->delete();

        /* $cancha->photos->each->delete();  */

        $cancha->delete();

        return redirect()->route('admin.cancha.index')->with('flash', 'La cancha ha sido eliminada');
    }
}
