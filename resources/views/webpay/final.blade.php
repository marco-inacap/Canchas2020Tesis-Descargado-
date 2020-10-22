@extends('new.layout2')

@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-container text-center">
                    <h5><img class="profile-user-img img-responsive img-circle" style="width:35px; height:35px;"
                            src="/img/ok.png">&nbsp;Tu pago ha sido realizado con éxito</h5>
                    Con fecha {{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YYYY')}} se ha
                    registrado el pago de una reserva por <b>${{ number_format($response->amount, 0, ',', '.') }}.</b>
                    <br><br>
                    <div class="section-title"><b>{{$reserva_datos->user->name}}</b>, hemos enviado un comprobante de tu
                        reserva a <b>{{$reserva_datos->user->email}}</b> como recordatorio.</div>
                    <b class="text-center">Tambien lo puedes ver en <a href="{{route('pages.misreservas')}}">Mis
                            Reservas.</a></b>
                </div>
                <br>
                <h6 class="text-center">Detalle de pago</h6>
                <div class="card border-success mb-3" style="width:22rem; margin:0 auto; ">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Nombre:</strong> &nbsp;{{$reserva_datos->user->name}}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Fecha de pago:</strong>
                            &nbsp;{{Carbon\Carbon::parse($response->transaction_date)->isoFormat('D-MM-YYYY, HH:mm:ss')}}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Orden de compra: </strong> &nbsp;{{ $response->buy_order }}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Nº de tarjeta:</strong> &nbsp;************{{ $response->card_number }}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Código de respuesta:</strong> &nbsp;{{ $response->response_code }}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>Nº de cuotas:</strong> &nbsp;{{ $response->shares_number }}
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item media">
                            <strong>TOTAL:</strong> &nbsp;<b>${{ number_format($response->amount, 0, ',', '.') }}</b>
                        </li>
                    </ul>
                </div>
                <p><a href="{{route('pages.home')}}">Regresar al inicio</a></p>
                <h3>Cualquier duda contactanos</h3>
                <ul class="list-unstyled li-space-lg">
                    <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol,
                        OSORNO.</li>
                    <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                    <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                    <li><i class="fas fa-envelope"></i><a href="mailto:office@aria.com">marcoignacio.96@hotmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection