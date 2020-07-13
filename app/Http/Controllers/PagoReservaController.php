<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\acknowledgeTransaction;
use App\Cancha;
use App\Reserva;
use Redirect;
use Auth;

class PagoReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cancha)
    {
    
    $usuarioauth = Auth()->user()->id;

    $reservas = DB::table('reservas')
        ->join('canchas','canchas.id','=','reservas.cancha_id')
        ->join('users','reservas.user_id','=','users.id')
        ->select('reservas.id',
                'reservas.fecha',
                'reservas.hora_inicio',
                'reservas.hora_fin',
                'canchas.nombre',
                'reservas.created_at',
                'canchas.precio')
        ->where('reservas.user_id', '=',$usuarioauth)->orderby('created_at','DESC')->take(1)->get();

        foreach ($reservas as $reserva) {
            $precioReserva = $reserva->precio;
        }

       /*  $session_id = $_COOKIE["laravel_session"]; */
        
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                        ->getNormalTransaction();

        $amount = $precioReserva;
        $sessionId = 'sessionId';
        $buyOrder = strval(rand(100000, 999999999));
     /*    $returnUrl = "http://127.0.0.1:8000/return"; */ 
        $returnUrl =  route('webpay.return');
        $finalUrl = route('webpay.final');
        
        $initResult = $transaction->initTransaction($amount,$sessionId, $buyOrder,$returnUrl,
        $finalUrl);
        
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;

        return view('webpay.index',compact('reservas','tokenWs','buyOrder','formAction','initResult'));

    }

    public function return(Request $request, Reserva $reserva)
    {
        
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                        ->getNormalTransaction();
                        
        $token = $request->input('token_ws');
                        
        $result = $transaction->getTransactionResult($token);
        
        $usuarioauth = Auth()->user()->id;

        $id_reserva = DB::table('reservas')
        ->join('canchas','canchas.id','=','reservas.cancha_id')
        ->join('users','reservas.user_id','=','users.id')
        ->select('reservas.id')
        ->where('reservas.user_id', '=',$usuarioauth)->take(1)->get();

        /* $reserva = Reserva::where('id',$id_reserva)->get();
        dd($reserva); */
        

       
        
        /* if($result->detailOutput->responseCode == 0)
        {
        
            foreach ($reserva as $value) {
                dd($value->estado_id);
    
                $value->estado_id = 2;
                $value->save();
            } */
        
            
            //guardar en bd
            /* $transaction->acknowledgeTransaction(); */
        
        /* $token = $request->input('token_ws');
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
        ->getNormalTransaction();
        $response = $transaction->getTransactionResult($token); */
        
        return Redirect::to($result->urlRedirection);
       
        
         /* return view('webpay.return', compact('result', 'tokenWs'));  */
      
        
        /* $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
        ->getNormalTransaction();


            $token = $request->input('token_ws');
            $response = $transaction->getTransactionResult($token);
            
            
            

                return view('webpay.return', compact('response', 'token')); */

            /* $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();

            $token = $request->input('token_ws');
            $result = $transaction->getTransactionResult($token);
        
            $output = $result->detailOutput;
    
        
        if ($output->responseCode == 0) {
            echo '<script>window.localStorage.clear();</script>';
            echo '<script>window.localStorage.setItem("authorizationCode",'. $output->authorizationCode .')</script>';
            echo '<script>window.localStorage.setItem("amount",'. $output->amount .')</script>';
            echo '<script>window.localStorage.setItem("responseCode",'. $output->responseCode .')</script>';
        }

        return view('webpay.return',compact('result','output','tokenWs'));   */
        
    }

    




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function final(Request $request)
    {

        
        
        return view('webpay.final');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
