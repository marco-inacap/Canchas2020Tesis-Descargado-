<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva | PDF</title>

    <style>

        body{
            line-height: 200%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .titulo{
            text-align: center;
            font-size: 20px;
        }
        .titulo2{
            text-align: center;
        }
        .datosuser{
            text-align: center
        }
        .fechahoy{
            text-align: right;
        }

        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 5px;
        text-align: left;
        }

    </style>
    
</head>

<body>
    <img src=" {{asset('/img/logo.png')}}" alt="" style="width:50px; height:50px;">
    <h1 class="text titulo">Detalle de pago.</h1>
    <div class="divider-2" style="margin:25px 0;"></div>
    <div class="row">
        <div class="col-md-6 titulo2">
            <strong>#TusCanchas</strong><br>
        </div>
        <div class="col-md-6 fechahoy">
            <small>Fecha hoy: {{ date('d-m-yy') }}</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="top10">
                <strong>Nosotros</strong><br>
                <address>
                    Bilbao #856<br>
                    Osorno, X Region<br>
                    Phone: 9 637 324 09<br>
                    Email: admin@tuscanchas.com
                </address>
            </div>
        </div>
        <div class="col-md-4 datosuser">
            <strong>Tus datos</strong><br>
                <address>
                    {{$reserva->user->name}}<br>
                    {{$reserva->user->email}}<br>
                </address>
        </div>
        <div class="col-md-4">
            <strong>Detalle</strong><br>
            <address>
                @foreach ($responses as $response)
                <b>Nº de orden:</b> {{$response->buy_order}}<br>
                <b>Fecha transacción:
                </b>{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YY')}}<br>
                <b>Hora transacción:
                </b>{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('HH:mm:ss')}}<br>
                <b>Estado de Transacción: </b>{{\App\reserva::STATUS_DESC[$reserva->status]}}<br>
                @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table egt">
                <thead>
                    <tr>
                        <th>Id Reserva</th>
                        <th>Fecha de reserva</th>
                        <th>Hora</th>
                        <th>Cancha</th>
                        <th>Complejo</th>
                        <th>Usuario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $reserva->id}}</td>
                        <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YY')}}</td>
                        <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}
                        </td>
                        <td>{{ $reserva->cancha->nombre}}</td>
                        <td>{{ $reserva->cancha->complejo->nombre}}</td>
                        <td>{{auth()->user()->name }}</td>
                        <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="egt">
                    <tr>
                        <th style="width:50%">Subtotal pagado:</th>
                        <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total pagado:</th>
                        <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>