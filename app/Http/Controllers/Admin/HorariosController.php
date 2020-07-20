<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cancha;
use App\Complejo;
use App\Horario;
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
       
        $usuarioauth = Auth()->user()->id;

        $horarios = DB::table('horarios')
        ->join('canchas','canchas.id','=','horarios.cancha_id')
        ->select('canchas.nombre',
                'horarios.id',
                'horarios.fecha',
                'horarios.hora_cierre',
                'horarios.hora_apertura')
        ->where('canchas.user_id', '=',$usuarioauth)->get();  

        return view('admin.horarios.index',compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth()->user();

        if ($user->hasRole('Admin')) {
            $complejos = Complejo::all();
        } else {

            $complejos = $user->complejo()->get();
        }

         $canchas = Cancha::where('user_id',auth()->id())->get(); 
        

        return view ('admin.horarios.create',compact('canchas','complejos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha' => 'required|min:3',
        ]);

        $horario = Horario::create( $request->all() );
        
        return redirect()->route('admin.horarios.index')->with('flash','El horario se ha agregado');
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
        $canchas = Cancha::where('user_id',auth()->id())->get(); 

        
        return view('admin.horarios.edit',compact('canchas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
