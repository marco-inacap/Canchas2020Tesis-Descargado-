@extends('layout')

@section('content')
    <section class="pages container">
        <div class="page page-contact">
            <h1 class="text">Transferencia exitosa!</h1>
            <p>Detalle de tu reserva.</p>
            <p>{{auth()->user()->name}}, por favor guarda este documento, es tu respaldo para ingresar al Complejo :)</p>
            <div class="divider-2" style="margin:25px 0;"></div>
            <div class="form-contact">
                <img class="profile-user-img img-responsive img-circle" style="width:50px; height:50px;" src="/img/ok.png">
                Transacción aprobada!
            </div>
            <h5>Datos de transacción</h5>
        <ul>
            <li><strong>Orden de compra:</strong> {{ $response->buy_order }}</li>
            <li><strong>Identificador de sesión:</strong> {{ $response->session_id }}</li>
            <li><strong>Fecha de la transacción:</strong> {{ $response->transaction_date }}</li>
            <li><strong>Fecha contable:</strong> {{ $response->accounting_date }}</li>
            <li><strong>VCI:</strong> {{ $response->vci }}</li>
        </ul>
        <h5>Datos de tarjeta</h5>
        <ul>
            <li><strong>Número de tarjeta:</strong> {{ $response->card_number }}</li>
            <li><strong>Expiración de tarjeta:</strong> {{ $response->card_expiration_date }}</li>
        </ul>
        <h5>Resultado de transacción</h5>
        <ul>
            <li><strong>Código de respuesta:</strong> {{ $response->response_code }}</li>
            <li><strong>Descripción de la respuesta:</strong> {{ $response->response_description }}</li>
            <li><strong>Código de comercio:</strong> {{ $response->commerce_code }}</li>
            <li><strong>Monto:</strong> ${{ number_format($response->amount, 0, ',', '.') }}</li>
            <li><strong>Código de autorización:</strong> {{ $response->authorization_code }}</li>
            <li><strong>Tipo de pago de la transacción:</strong> {{ $response->payment_type_code }}</li>
            <li><strong>Cantidad de cuotas:</strong> {{ $response->shares_number }}</li>
        </ul>

        </div>
    </section>
@endsection