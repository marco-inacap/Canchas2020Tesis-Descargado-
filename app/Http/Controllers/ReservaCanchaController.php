<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\Complejo;
use App\Estado;
use App\User;
use App\Reserva;
use App\Horario;
use App\Transaction;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;
use Auth;

class ReservaCanchaController extends Controller
{

    private static function getTransaction(): WebPayNormal
    {
        $urlRepository = "https://raw.githubusercontent.com/TransbankDevelopers/transbank-webpay-credenciales/master/";
        $dirFiles = "integracion/Webpay%20Plus%20-%20CLP/597020000540";

        $contentPublicCert = file_get_contents($urlRepository . $dirFiles . ".crt");
        $contentPrivateKey = file_get_contents($urlRepository . $dirFiles . ".key");

        $configuration = new Configuration();
        $configuration->setCommerceCode(597020000540);
        $configuration->setEnvironment("INTEGRACION");
        $configuration->setPrivateKey($contentPrivateKey);
        $configuration->setPublicCert($contentPublicCert);
        $webpay = new Webpay($configuration);
        return $webpay->getNormalTransaction();
    }
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
        $canchas = Cancha::findOrFail($cancha); 
        
        $usuario = Auth::user();

        $input = $request->all();

        if($this->validarFecha($input["txtFecha"],$input["txtHoraInicio"],$input["txtHoraFin"])){
        
            $reserva = new Reserva;

            $reserva->fecha = $input["txtFecha"];
            $reserva->hora_inicio = $input["txtHoraInicio"];
            $reserva->hora_fin = $input["txtHoraFin"];
            $reserva->cancha_id = $cancha;
            $reserva->complejo_id = $canchas->complejo->id;
            $reserva->user_id = $usuario->id;
            $reserva->total = $canchas->precio;

            $reserva->save();

            return response ()->json(["ok"=>true]);

        }else{
            return response ()->json(["ok"=>false]);

        }
    }

    public function init_webpay(Request $request, $id)
    {
        $canchas = Cancha::findOrFail($id); 
        $usuarioauth = Auth()->user()->id;
        $reserva = Reserva::where('user_id',auth()->id())->take(1)->first();


        if ($reserva->status != Reserva::STATUS_PENDING_PAYMENT)
        {
            return redirect()->route('pages.home');
        }

        $db_transaction = new Transaction;
        $db_transaction->reserva()->associate($reserva);
        $db_transaction->save();

        $transaction = self::getTransaction();
        $returnUrl =  route('webpay.return');
        $finalUrl = route('webpay.final');

        $response = $transaction->initTransaction(
                $db_transaction->reserva->total,
                $db_transaction->buy_order,
                $db_transaction->reserva->id,
                $returnUrl,
                $finalUrl    
        );
        if (is_array($response))
        {
            $db_transaction->error = html_entity_decode($response['detail']);
            $db_transaction->save();
            $reserva->status = Reserva::STATUS_WP_NORMAL_INIT_ERROR;
            $reserva->save();
            return redirect()->route('pages.home');
        }   

        $db_transaction->token = $response->token;
        $db_transaction->save();
        $reserva->status = Reserva::STATUS_WP_NORMAL_INIT_SUCCESS;
        $reserva->save();
        
        return view('webpay.index',compact('response'));         

    }

    public function return_webpay(Request $request)
    {

    }

    public function final(Request $request)
    {

    }

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
