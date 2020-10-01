<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva | PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
    <body>
        <img class="center" src="{{ public_path('new/images/logo.png') }}" style="width:50px; height:50px;">
        {{-- <td rowspan="6"><img src="../public/new/images/logo.png"></td> --}}
       
        <h4>Comprobante de pago</h4>
        <hr style="height: 2px; color: blue;">
        <h5 class="card-title">Detalle del pago realizado</h5>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Nombre:</th>
                    <td>{{$reserva->user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td>{{$reserva->user->email}}</td>
                </tr>
                @foreach ($responses as $response)
                <tr>
                    <th scope="row">Nº de orden:</th>
                    <td>{{$response->buy_order}}</td>
                </tr>
                <tr>
                    <th scope="row">Fecha de pago</th>
                    <td>{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YY')}}  {{Carbon\Carbon::parse($response->transaction_date)->isoFormat('HH:mm:ss')}}</td>
                </tr>
                <tr>
                    <th scope="row">Nº Tarjeta:</th>
                    <td>************{{ $response->card_number }} </td>
                        
                </tr>
                <tr>
                    <th scope="row">Nº Cuotas:</th>
                    <td>{{ $response->shares_number }}</td>
                </tr>
                @endforeach
                <tr>
                    <th scope="row">Estado de Transacción:</th>
                    <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
                </tr>
                <tr>
                    <th scope="row">Id Reserva</th>
                    <td>{{$reserva->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Fecha de reserva</th>
                    <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YY')}}</td>
                </tr>
                <tr>
                    <th scope="row">Hora de reserva</th>
                    <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}</td>
                </tr>
                <tr>
                    <th scope="row">Nombre de complejo</th>
                    <td>{{ $reserva->cancha->complejo->nombre}}</td>
                </tr>
                <tr>
                    <th scope="row">Nombre de cancha</th>
                    <td>{{ $reserva->cancha->nombre}}</td>
                </tr>
                <tr>
                    <th scope="row">Monto:</th>
                    <td colspan="2"></td>
                    <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th scope="row">Total:</th>
                    <td colspan="2"></td>
                    <td><b>${{ number_format($reserva->total, 0, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
</body>
</html>