@extends('new.layout')

@section('content')

<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Terminos & Condiciones</h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->

<div class="ex-basic-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <h3>¿Que son los terminos y condiciones de un sitio web?</h3>
                    <p>
                        Son las condiciones en que se lleva el sitio web y me
                        proporciona protección ante cualquier reclamación en contra de la empresa. Quiero decir, que
                        los términos y condiciones son básicamente el contrato con el cliente que quiera registrarse e
                        ingresar datos personales al sitio web, los cuales serán almacenados en Base de datos.</p>
                    <p>La misión de los términos y condiciones, es la de proporcionar
                        información sobre el contenido de tu sitio y de cómo los visitantes y clientes están y no están
                        autorizados a usarlo.
                        <p>Algúnos puntos importantes de los Terminos & Condiciones de uso:</p>
                        <ul class="list-unstyled li-space-lg indent">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Sobre el uso del sitio web
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Sobre las garantías y las devoluciones
                                </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Sobre el uso no autorizado de datos</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Uso de sus datos, especificando los fines de ellos</div>
                            </li>
                        </ul>
                </div> <!-- end of text-container -->
                <a class="btn-outline-reg" href="{{route('pages.home')}}">Volver al inicio</a>
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic -->

@endsection