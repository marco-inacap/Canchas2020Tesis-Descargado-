@extends('new.layout2')

@section('content')

<header id="header" class="header2">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h1>TODAS TODITAS!</h1>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->

<div id="services" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">CANCHAS</div>
                @if (isset($complejo))
                <a href="{{route('pages.todaslascanchas')}}"><div class="section">Volver</div></a>
                <p class="p-heading">Buscaste por</p><h2>{{$complejo->nombre}}</h2>
                @endif
            </div>
        </div>
        <div class="row contenedor">
            <div class="col-lg-12">
                @foreach ($canchas as $cancha)
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid img-responsive" src="{{ url($cancha->photos->first()->url) }}" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{$cancha->nombre}}</h3>
                        <p>{{$cancha->descripcion}}</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Nº Reservas: {{count($cancha->complejo->reservas)}}</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                            <a href="{{route('complejos.show', $cancha->complejo)}}"><div class="media-body">{{$cancha->complejo->nombre}}</div></a> 
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">{{$cancha->complejo->ubicacion}}</div>
                            </li>
                        </ul>
                        <p class="price">Precio <span>$ {{number_format($cancha->precio,0, ',', '.')}}</span></p>
                    </div>
                    <div class="button-container">
                        <a class="btn-solid-reg page-scroll" href="#callMe">Reservar</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="" class="section-title text-center">VER MÁS</a>
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection