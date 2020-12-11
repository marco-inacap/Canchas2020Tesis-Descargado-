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
    <img class="center" src="{{ public_path('new/images/logo.png') }}" style="width:50px; height:50px;">
    {{-- <td rowspan="6"><img src="../public/new/images/logo.png"></td> --}}

    <div class="card">
        <div class="card-body text-center">
            <b>Reporte de reservas</b>
        </div>
    </div>
    <hr style="height: 2px; color: blue;">
    <div class="card">
        <div class="card-body text-center">
            De {{Carbon\Carbon::parse($fecha_inicio)->isoFormat('D - MMMM - YYYY')}} a
            {{Carbon\Carbon::parse($fecha_fin)->isoFormat('D - MMMM - YYYY')}}
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
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
    {{-- <table class="table">
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
    </table> --}}
</body>

</html>