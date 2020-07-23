<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Transaction;
use App\Respuesta;
use Carbon\Carbon;
use Auth;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;

class PagesController extends Controller
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
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
        $fechaActual = Carbon::now()->format('y-m-d H:i:s');

        $canchas = Cancha::latest('created_at')->paginate(5);

        //aquí quede!

        foreach ($canchas as $cancha) {
        
            if ($fechaActual >= $cancha->reservas->hora_inicio && $fechaActual <= $cancha->reservas->hora_fin ) {

                $cancha->estado = 1;
                $cancha->save();
            }
        }
        


        
        

        

        return view('pages.home', compact('canchas'));
    }

    public function contacto()
    {
        return view('pages.contacto');
    }

    public function reservas()
    {

        $reservas = Reserva::where('user_id', auth()->id())->get();



        return view('pages.reservas', compact('reservas'));
    }

    public function detalle(Reserva $reserva)
    {

        $transaction = Transaction::where('reserva_id', $reserva->id)->get();


        foreach ($transaction as $valor) {
            $responses = Respuesta::where('transaction_id', $valor->id)->get();
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

        $db_transaction->token = $response->token;
        $db_transaction->save();
        $reserva->status = Reserva::STATUS_WP_NORMAL_INIT_SUCCESS;
        $reserva->save();

        return view('pages.reserva-user', compact('reserva', 'responses','response'));
    }
}
