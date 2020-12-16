<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cancha;
use App\Complejo;
use App\Horario;
use App\Reserva;
use Illuminate\Support\Facades\DB;
use Auth;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('view', new Horario);

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        return view('admin.horarios.index', compact('complejos'));
    }

    public function lista_canchas(Complejo $complejo)
    {
        $canchas = $complejo->canchas()->get();

        return view('admin.horarios.listacanchashorario', compact('canchas'));
    }



    public function lista_horarios(Cancha $cancha)
    {

        $horarios = Horario::where('cancha_id', $cancha->id)->get();


        return view('admin.horarios.listahorario', compact('horarios', 'cancha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Horario $horario)
    {

        $this->authorize('create', new Horario);

        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

        $canchas = Cancha::where('user_id', auth()->id())->get();
        

        return view('admin.horarios.create', compact('canchas', 'complejos', 'horario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validarHorario(Request $request)
    {
        
        
    }


    public function store(Request $request)
    {
        $this->authorize('create', new Horario);

        
        $this->validate($request, [
            'complejo_id' => 'required',
            'cancha_id' => 'required',
            'fecha' => 'required',
            'hora_cierre' => 'required',
            'hora_apertura' => 'required',
        ]);

        $reserva = Reserva::where('cancha_id', $request->cancha_id)
        ->where('fecha',$request->fecha)
        ->where('hora_inicio','>=' ,$request->hora_cierre)
        ->where('hora_fin','<=',$request->hora_apertura)
        ->where('status', 13)
        ->count();

        if ($reserva > 0) {
            return redirect()->route('admin.horarios.create')->with('alert', 'No fue posible agregar el horario ya que existen reservas en el rango de fecha y hora seleccinado');   
        }else{
            $horario = Horario::create($request->all());
            return redirect()->route('admin.horarios.create')->with('flash', 'El horario se ha agregado');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        $this->authorize('update', $horario);

        $canchas = Cancha::where('user_id', auth()->id())->get();


        return view('admin.horarios.edit', compact('canchas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        $horario->update($request->all());

        return redirect()->route('admin.horarios.create')->with('flash','El horario se actualizo con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        $this->authorize('delete', new Horario);
        
        $horario->delete();
        
        return redirect()->route('admin.horarios.create')->with('flash','El horario a sido eliminada');
    }
}
