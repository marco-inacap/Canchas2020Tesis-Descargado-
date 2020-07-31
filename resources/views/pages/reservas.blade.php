@extends('layout')

@section('content')

<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Reservas </h1>
        <p>Historial de mis reservas</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <form action="#">
                tengo que hacer un if, para mostrar solo las reservas con estado:Pago con Webpay Normal finalizado y Pago con Webpay Normal iniciado'
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Cancha</th>
                            <th scope="col">Complejo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>                       
                        @foreach ($reservas as $reserva)
                        <tr>
                            <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
                            <td>{{  Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm ') }} -
                                {{  Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a') }}</td>
                            <td>{{$reserva->cancha->nombre}}</td>
                            <td>{{$reserva->cancha->complejo->nombre}}</td>
                            <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
                            <td>${{number_format($reserva->total,0, ',', '.')}}</td>
                            <td>
                                <a href="{{route('detalle.reserva', $reserva)}}">ver</a>
                                <a target="_blank" href="{{route('detalle.reserva.download', $reserva)}}">PDF</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($reservas->count() < 1 )
                <p>Aún no tienes reservas, que esperas!</p>
                @endif
            </form>
        </div>
    </div>
</section>

@endsection
@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
@push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush
