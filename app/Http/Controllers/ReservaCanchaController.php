<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancha;
use App\User;
use App\Reserva;
use App\Horario;
use App\Transaction;
use App\Respuesta;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;
use Carbon\Carbon;
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
    public function index(Cancha $cancha, User $user)
    {

        return view('canchas.calendario', compact('cancha', 'user'));
    }

    public function horarioCierre($cancha)
    {

        $horarios = Horario::where('cancha_id', $cancha)->get();


        $horariosCerrado = [];

        foreach ($horarios as $horario) {

            $horariosCerrado[] = [
                "id" => $horario->id,
                "start" => $horario->fecha . " " . $horario->hora_cierre,
                "end" => $horario->fecha . " " . $horario->hora_apertura,
                "title" => "Horario cerrado.",
                "textColor" => "#ffffff",
                "backgroundColor" => 'rgba(240,52,52,0.3)',
                "borderColor" => "red"
            ];
        }
        return response()->json($horariosCerrado);
    }

    public function listar($cancha)
    {

        $reserva = Reserva::where('cancha_id', $cancha)->get();
        $nuevaReserva = [];

        foreach ($reserva as $value) {
            $nuevaReserva[] = [
                "id" => $value->id,
                "classNames" => $value->cancha->complejo->nombre, 
                "start" => $value->fecha . " " . $value->hora_inicio,
                "end" => $value->fecha . " " . $value->hora_fin,
                "backgroundColor" => 'rgb(46, 204, 113,0.4)',
                "borderColor" => 'rgb(70, 204, 113,0.6)',
                "textColor" => 'rgb(1, 50, 67)'
            ];
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

    public function validarFecha($fecha, $horaInicial, $horaFinal)
    {
        $reserva = Reserva::select("*")
            ->where('fecha', $fecha)
            ->where('hora_inicio', [$horaInicial, $horaFinal])
            ->orWhere('hora_fin', [$horaInicial, $horaFinal])
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

        if ($this->validarFecha($input["txtFecha"], $input["txtHoraInicio"], $input["txtHoraFin"])) {

            $reserva = new Reserva;

            $reserva->fecha = $input["txtFecha"];
            $reserva->hora_inicio = $input["txtHoraInicio"];
            $reserva->hora_fin = $input["txtHoraFin"];
            $reserva->cancha_id = $cancha;
            $reserva->complejo_id = $canchas->complejo->id;
            $reserva->user_id = $usuario->id;
            $reserva->total = $canchas->precio;

            $reserva->save();

            return response()->json(["ok" => true]);
        } else {
            return response()->json(["ok" => false]);
        }
    }

    public function init_webpay(Request $request, $id)
    {
        $canchas = Cancha::findOrFail($id);
        $usuarioauth = Auth()->user()->id;
        $reserva = Reserva::where('user_id', auth()->id())->take(1)->first();


        /* if ($reserva->status != Reserva::STATUS_PENDING_PAYMENT)
        {
            return redirect()->route('pages.home');
        } */

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
        /* if (is_array($response))
        {
            $db_transaction->error = html_entity_decode($response['detail']);
            $db_transaction->save();
            $reserva->status = Reserva::STATUS_WP_NORMAL_INIT_ERROR;
            $reserva->save();
            return redirect()->route('pages.home');
        } */

        $db_transaction->token = $response->token;
        $db_transaction->save();
        $reserva->status = Reserva::STATUS_WP_NORMAL_INIT_SUCCESS;
        $reserva->save();



        return view('webpay.index', compact('response', 'reserva', 'db_transaction', 'canchas'));
    }

    public function return_webpay(Request $request)
    {
        $token = $request->input('token_ws');
        $db_transaction = Transaction::where('token', $token)->first();
        /* if (!$db_transaction || $db_transaction->reserva->status != Reserva::STATUS_WP_NORMAL_INIT_SUCCESS)
        {
            return redirect()->route('pages.home');
        } */

        $transaction = self::getTransaction();
        $response = $transaction->getTransactionResult($token);

        $db_response = new Respuesta();
        $db_response->transaction()->associate($db_transaction);

        /* if (is_array($response))
        {
            $db_response->error = html_entity_decode($response['detail']);
            $db_response->save();
            $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_ERROR;
            $db_transaction->reserva->save();
            return redirect()->route('pages.home');
        } */

        $db_response->buy_order = $response->buyOrder;
        $db_response->session_id = $response->sessionId;
        $db_response->accounting_date = Carbon::parse($response->accountingDate)->format('Y-m-d', 'America/Santiago');
        $db_response->transaction_date = Carbon::parse($response->transactionDate)->format('Y-m-d H:i:s', 'America/Santiago');
        $db_response->vci = $response->VCI;
        $db_response->card_number = $response->cardDetail->cardNumber;
        $db_response->amount = $response->detailOutput->amount;
        $db_response->authorization_code = $response->detailOutput->authorizationCode;
        $db_response->payment_type_code = $response->detailOutput->paymentTypeCode;
        $db_response->response_code = $response->detailOutput->responseCode;

        /* if (isset($response->detailOutput->responseDescription))
        {
        $db_response->response_description = $response->detailOutput->responseDescription;
        } */

        $db_response->shares_number = $response->detailOutput->sharesNumber;
        $db_response->save();

        /*  if (!$db_response->is_valid)
        {
            $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_INVALID;
            $db_transaction->reserva->save();
            return redirect()->route('pages.home');
        }  */

        $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_SUCCESS;
        $db_transaction->reserva->save();

        /* return redirect($response->url,$response->token); */

        return view('webpay.return', compact('response', 'token'));
    }

    public function final_webpay(Request $request)
    {
        $token = $request->input('token_ws', null) ?? $request->input('TBK_TOKEN', null);
        $session_id = $request->input('TBK_ID_SESION', null);
        $buy_order = $request->input('TBK_ORDEN_COMPRA', null);

        $db_transaction = null;
        if ($token) {
            $db_transaction = Transaction::where('token', $token)->first();
        } elseif ($buy_order && $session_id) {
            $buy_order_exploded = explode('_', $buy_order);
            $created_timestamp = array_pop($buy_order_exploded);
            $db_transaction = Transaction::where([
                ['reserva_id', $session_id],
                ['created_at', Carbon::createFromTimestamp($created_timestamp)]
            ])->first();
        }

        /* if (!$db_transaction)
        {
        return redirect()->route('pages.home');
        }  */

        switch ($db_transaction->reserva->status) {
            case Reserva::STATUS_WP_NORMAL_FINISH_SUCCESS:
                $response = $db_transaction->response;
                return view('webpay.final', compact('response'));
            case Reserva::STATUS_WP_NORMAL_INIT_SUCCESS:
                $db_response = new Respuesta;
                $db_response->transaction()->associate($db_transaction);
                $db_response->buy_order = $buy_order;
                $db_response->session_id = $session_id;
                $db_response->save();

                /* switch (count($request->all()))
                {
                    case 2:
                        $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_TIMEOUT;
                        break;
                    case 3:
                        $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_ABORT;
                        break;
                    case 4:
                        $db_transaction->reserva->status = Reserva::STATUS_WP_NORMAL_FINISH_FORM_FAULT;
                        break;    
                }
                $db_transaction->reserva->save();
                default:
                return redirect()->route('pages.home');   */
        }
    }

    public function destroy($id)
    {
        $reserva = Reserva::find($id);

        if ($reserva == null)
            return Response()->json([
                'message'   =>  'ERROR AL ELIMINAR EVENTO'
            ]);


        $reserva->delete();


        return Response()->json([
            'message'   =>  'EVENTO ELIMINADO EXITOSAMENTE.'
        ]);
    }
}
