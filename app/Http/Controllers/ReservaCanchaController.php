<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\Complejo;
use App\Estado;
use App\User;
use App\Reserva;
use App\Horario;
use Auth;

class ReservaCanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cancha $cancha,User $user)
    {
        
        return view('canchas.calendario',compact('cancha','user'));
    }

    public function horarioCierre($cancha){
        
        $horarios = Horario::where('cancha_id',$cancha)->get(); 
        

        $horariosCerrado = [];

        foreach ($horarios as $horario ) {
            
            $horariosCerrado[] = [
                "id"=>$horario->id,
                "start"=>$horario->fecha." ".$horario->hora_cierre,
                "end"=>$horario->fecha." ".$horario->hora_apertura,
                "title"=>"Horario cerrado.",
                "textColor"=>"#ffffff",
                "backgroundColor"=> 'rgba(240,52,52,0.3)', 
                "borderColor"=> "red"
            ];
        }
        return response()->json($horariosCerrado);
    }

    public function listar($cancha){
        
        $reserva = Reserva::where('cancha_id',$cancha)->get();
        $nuevaReserva = [];

        
         foreach ($reserva as $value) {

            if ($value->estado_id == 1) {
                $nuevaReserva[] = [
                    "id"=>$value->id,
                    "classNames"=>$value->cancha->complejo->nombre,
                    "start"=>$value->fecha." ".$value->hora_inicio,
                    "end"=>$value->fecha." ".$value->hora_fin,
                    "title"=>$value->user->name,
                    "backgroundColor"=> 'rgb(245, 215, 110,0.4)',
                    "borderColor" =>'rgb(70, 204, 113,0.6)',
                    "textColor"=> 'rgb(1, 50, 67)'    
                ];
                    
            }if ($value->estado_id == 2) {
                $nuevaReserva[] = [
                    "id"=>$value->id,
                    "classNames"=>$value->cancha->complejo->nombre,
                    "start"=>$value->fecha." ".$value->hora_inicio,
                    "end"=>$value->fecha." ".$value->hora_fin,
                    "title"=>$value->user->name,
                       
                    "backgroundColor"=> 'rgb(46, 204, 113,0.5)',
                    "borderColor" =>'rgb(70, 204, 113,0.6)',
                    "textColor"=> 'rgb(1, 50, 67)'
                    
                ];
                
            } else {
                $nuevaReserva[] = [
                    "id"=>$value->id,
                    "classNames"=>$value->cancha->complejo->nombre,
                    "start"=>$value->fecha." ".$value->hora_inicio,
                    "end"=>$value->fecha." ".$value->hora_fin,
                    "title"=> "Rechazada",
                    "backgroundColor"=> 'rgb(217, 30, 24,0.4)',
                    "borderColor" =>'rgb(70, 204, 113,0.6)',
                    "textColor"=> 'rgb(1, 50, 67)'  
                    
                ];
            }
             
            
        } 
        return response()->json($nuevaReserva);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validarFecha($fecha,$horaInicial,$horaFinal)
    {
        $reserva = Reserva::select("*")
            ->where('fecha',$fecha)
            ->where('hora_inicio',[$horaInicial,$horaFinal])
            ->orWhere('hora_fin',[$horaInicial,$horaFinal])
            ->first();
        /* whereDate
        WhereBetween
        orWhereBetween */

        return $reserva == null ? true : false;
    }

    public function store(Request $request, $cancha)
    {
        
        $usuario = Auth::user();

        $input = $request->all();

        if($this->validarFecha($input["txtFecha"],$input["txtHoraInicio"],$input["txtHoraFin"])){
        
            $reserva = new Reserva;

            $reserva->fecha = $input["txtFecha"];
            $reserva->hora_inicio = $input["txtHoraInicio"];
            $reserva->hora_fin = $input["txtHoraFin"];
            $reserva->estado_id = 1;
            $reserva->cancha_id = $cancha;
            $reserva->user_id = $usuario->id;

            $reserva->save();

            return response ()->json(["ok"=>true]);

        }else{
            return response ()->json(["ok"=>false]);

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
    public function edit($id)
    {
        //
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
        $reserva = Reserva::find($id);
        
        if($reserva == null)
            return Response()->json([
                'message'   =>  'ERROR AL ELIMINAR EVENTO'
            ]);
            

        $reserva->delete();
        

        return Response()->json([
            'message'   =>  'EVENTO ELIMINADO EXITOSAMENTE.'
        ]);


        
    }
}
