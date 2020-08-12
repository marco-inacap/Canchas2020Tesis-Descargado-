@extends('new.layout2')

@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <img class="profile-user-img img-responsive img-circle" style="width:50px; height:50px;" src="/img/rechazada.webp">
                    <div class="section-title">Transferencia rechazada.</div>
                    <h2>No se hizo ningun cargo a tu tarjeta</h2>
                    <p>{{auth()->user()->name}}, tu transferencia pudo haber sido rechazada por estos motivos:</p>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Has utilizado un medio de pago sin la autorización de su propietario o del banco</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Hemos constatado incoherencias importantes en la información de pago y/o en tu comportamiento de compra</div>
                        </li>
                        <br>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Etc... </div>
                        </li>
                    </ul>
                    <p><a href="{{route('pages.home')}}">Regresar al inicio</a></p>
                    <h3>Cualquier duda contactanos</h3>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol, OSORNO.</li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:office@aria.com">marcoignacio.96@hotmail.com</a></li>
                    </ul>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div>
    </div>
</div>

@endsection

