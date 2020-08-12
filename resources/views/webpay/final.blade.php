@extends('new.layout2')

@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <img class="profile-user-img img-responsive img-circle" style="width:50px; height:50px;"
                        src="/img/ok.png">
                    <div class="section-title">Transferencia exitosa!</div>
                    <h2>Te esperamos :)</h2>
                    <p>{{auth()->user()->name}}, por favor guarda este documento, es tu respaldo para ingresar al
                        Complejo :) <br> <b>Tambien lo puedes ver en <a href="{{route('pages.misreservas')}}">Mis
                                Reservas.</a> </b> </p>
                    <h5>Datos de transacción</h5>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media"><strong>Orden de compra:</strong> {{ $response->buy_order }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Identificador de sesión:</strong> {{ $response->session_id }}</div>
                        </li>
                        <br>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Fecha de la transacción:</strong> {{ $response->transaction_date }}
                            </div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Fecha contable:</strong> {{ $response->accounting_date }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">VCI:</strong> {{ $response->vci }}</div>
                        </li>
                    </ul>
                    <h5>Datos de tu tarjeta</h5>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Número de tarjeta:</strong> {{ $response->card_number }}
                            </div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Expiración de tarjeta:</strong>
                                {{ $response->card_expiration_date }}</div>
                        </li>
                    </ul>
                    <h5>Resultado de transacción</h5>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Código de respuesta:</strong> {{ $response->response_code }}
                            </div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Descripción de la respuesta:</strong>
                                {{ $response->response_description }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Código de comercio:</strong> {{ $response->commerce_code }}
                            </div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Monto:</strong>
                                ${{ number_format($response->amount, 0, ',', '.') }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Código de autorización:</strong>
                                {{ $response->authorization_code }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Tipo de pago de la transacción:</strong>
                                {{ $response->payment_type_code }}</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body"><strong>Cantidad de cuotas:</strong> {{ $response->shares_number }}
                            </div>
                        </li>
                    </ul>
                    <p><a href="{{route('pages.home')}}">Regresar al inicio</a></p>
                    <h3>Cualquier duda contactanos</h3>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol,
                            OSORNO.</li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-envelope"></i><a
                                href="mailto:office@aria.com">marcoignacio.96@hotmail.com</a></li>
                    </ul>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div>
    </div>
</div>
@endsection