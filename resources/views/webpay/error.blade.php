@extends('new.layout2')

@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <img class="profile-user-img img-responsive img-circle" style="width:50px; height:50px;" src="/img/rechazada.webp">
                    <div class="section-title">Orden de Compra XXXXXXX rechazada.</div>
                    <h2>No se hizo ningun cargo a tu tarjeta</h2>
                    <p>{{auth()->user()->name}}, las posibles causas de este rechazo son:</p>
                    <ul class="list-unstyled li-space-lg ">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad).</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Su tarjeta de Crédito o Débito no cuenta con saldo suficiente.</div>
                        </li>
                        <br>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Tarjeta aún no habilitada en el sistema financiero.</div>
                        </li>
                    </ul>
                    <p><a href="{{route('pages.home')}}">Regresar al inicio</a></p>
                    <h3>Cualquier duda contactanos</h3>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol, OSORNO.</li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:marcoignacio.96@hotmail.com">marcoignacio.96@hotmail.com</a></li>
                    </ul>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div>
    </div>
</div>

@endsection

