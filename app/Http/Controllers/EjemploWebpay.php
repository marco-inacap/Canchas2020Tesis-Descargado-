<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;

use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;

class EjemploWebpay extends Controller
{
    

    public function pagar(Cancha $cancha)
    {

        $session_id = $_COOKIE["laravel_session"];
        
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();

        $amount = $cancha->precio;
        $sessionId = 'sessionId';
        $buyOrder = strval(rand(100000, 999999999));
        $returnUrl = route('webpay.return');
        $finalUrl = route('webpay.final');
        
        $initResult = $transaction->initTransaction(
        $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);

        $formAction = $initResult->url;
        $tokenWs = $initResult->token;

            
      
            return redirect($formAction);

        /* return view('pages.pagar',compact($formAction)); */
       
        
    }
   
    public function return()
    {

    }
    public function final()
    {

    }
}
