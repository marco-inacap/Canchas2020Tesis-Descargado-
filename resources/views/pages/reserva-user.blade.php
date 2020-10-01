@extends('new.layout2')

@section('meta-title')Reserva | Detalle @endsection

@section('content')
<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Reserva</h1>
        <p>Detalles de la reserva para la cancha </p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <section class="invoice">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="page-header ">
                            <i class="fa fa-globe"></i> #ReservaUnaCancha.cl
                        </h2>
                    </div>
                    <div class="col-md-4">
                        <h2 class="page-header ">
                            <small class="pull-right">Fecha hoy: {{ date('d-m-yy') }}</small>
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Nosotros
                        <address>
                            <strong>ReservaUnaCancha.cl</strong><br>
                            Bilbao #856<br>
                            Osorno, X Region<br>
                            Phone: 9 637 324 09<br>
                            Email: admin@tuscanchas.com
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        Tus Datos
                        <address>
                            <strong>{{$reserva->user->name}}</strong><br>
                            {{$reserva->user->email}}<br>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <br>
                        @foreach ($responses as $response)
                        <b>Nº de orden:</b> {{$response->buy_order}}<br>
                        <b>Fecha transacción:
                        </b>{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YY')}} {{Carbon\Carbon::parse($response->transaction_date)->isoFormat('HH:mm:ss')}}<br>
                        <b>Nº Tarjeta:</b> xxxxxxxxxxxx{{ $response->card_number }} <br>
                        <b>Estado de Transacción: </b>{{\App\reserva::STATUS_DESC[$reserva->status]}}<br>
                        <b>Cuotas:</b> {{ $response->shares_number }} <br>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
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
                                    <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('DD - MM - YY')}}</td>
                                    <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}</td>
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
                            <table class="table">
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
            </section>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
