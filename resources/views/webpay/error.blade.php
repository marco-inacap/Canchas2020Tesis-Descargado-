@extends('layout')

@section('content')


<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Transferencia rechazada.</h1>
        <p>{{auth()->user()->name}}, tu transferencia pudo haber sido rechazada por estos motivos:</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <img class="profile-user-img img-responsive img-circle" style="width:50px; height:50px;" src="/img/rechazada.webp">
        </div>
        <ul>
            <li>Has utilizado un medio de pago sin la autorización de su propietario o del banco</li>
            <li>Hemos constatado incoherencias importantes en la información de pago y/o en tu comportamiento de compra</li>
            <li>Etc...</li>
        </ul>
        <p><a href="{{ url()->previous()}}">Regresar</a></p>
        <div class="divider-2" style="margin: 35px 0;"></div>   
    </div>
</section>

@endsection

