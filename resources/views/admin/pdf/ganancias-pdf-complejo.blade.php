<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reserva | PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <img class="center" src="{{ public_path('new/images/logo.png') }}" style="width:50px; height:50px;">
    {{-- <td rowspan="6"><img src="../public/new/images/logo.png"></td> --}}

    <h4>Reporte de reservas en mis complejos.</h4>
    <hr style="height: 2px; color: blue;">
    <h5 class="card-title">Fecha de <b style="color: #CD5C5C;">{{Carbon\Carbon::parse($fecha_inicio)->isoFormat('D-MMMM-YYYY')}}</b> hasta <b style="color: #CD5C5C;">{{Carbon\Carbon::parse($fecha_fin)->isoFormat('D-MMMM-YYYY')}}</b></h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">FECHA PAGO</th>
                <th scope="col">COMPLEJO</th>
                <th scope="col">CANCHA</th>
                <th scope="col">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=0;
            @endphp
            @foreach ($reservas as $reserva)
            
            @php
                $i++;
            @endphp
            <tr>
                
                <th scope="row">{{$i}}</th>
                <td>{{Carbon\Carbon::parse($reserva->created_at)->isoFormat('D / MM / YY')}}</td>
                <td>{{$reserva->complejo->nombre}}</td>
                <td>{{$reserva->cancha->nombre}}</td>
                <td>${{number_format($reserva->total, 0, ',', '.' )}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="font-weight: bold; font-size: 20px">TOTAL</th>
                <td colspan="0" style="font-weight: bold; font-size: 18px; color: green">
                    ${{number_format($totalReservas, 0, ',', '.' )}} </td>
            </tr>
            </tr>
        </tfoot>
    </table>
</body>

</html>

