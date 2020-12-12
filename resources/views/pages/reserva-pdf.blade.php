<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reserva | PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>

</head>

<body>
    
    {{-- <td rowspan="6"><img src="../public/new/images/logo.png"></td> --}}

    <div class="card">
        <img class="center" src="{{ public_path('new/images/logo.png') }}" style="width:50px; height:50px;">
        <div class="card-body text-center">
            <b>Comprobante de pago</b>
            <img style="float:right;" src="data:image/svg+xml;base64,{{ base64_encode($codigoqr) }}">
        </div>
    </div>
    <h6 style="font-size: 10px;"><b>Id reserva: {{$reserva->id}}</b></h6>
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
                <td>{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YY')}},
                    {{Carbon\Carbon::parse($response->transaction_date)->isoFormat('HH:mm:ss')}}</td>
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
                <th scope="row">Fecha de reserva:</th>
                <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('DD - MMMM - YYYY')}}</td>
            </tr>
            <tr>
                <th scope="row">Hora de reserva:</th>
                <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}
                </td>
            </tr>
            <tr>
                <th scope="row">Nombre de complejo:</th>
                <td>{{ $reserva->cancha->complejo->nombre}}</td>
            </tr>
            <tr>
                <th scope="row">Nombre de cancha:</th>
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
            <tr>
                
            </tr>
        </tbody>
    </table>
</body>

</html>