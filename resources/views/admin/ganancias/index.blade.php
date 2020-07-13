@extends('admin.layout')

@section('header')

<h1>
    Complejos
     <small>Seleccione un Complejo</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
     <li class="active">Ganancias</li>
   </ol>

@endsection

@section('content')
    

    @foreach ($complejos as $complejo)
    <div class="col-md-4">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="/img/logo.png" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{$complejo->nombre}}</h3>
                <h5 class="widget-user-desc">Contacto: {{$complejo->telefono}}</h5>
            </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              <li><a >Nº Canchas <span class="pull-right badge bg-blue">{{count($complejo->canchas)}}</span></a></li>
              <li><a href="#">Nº Reservas <span class="pull-right badge bg-aqua">{{count($complejo->canchas[0]->reservas)}}</span></a></li>
              <li><a href="#">Ganancias Total<span class="pull-right badge bg-green"> $ {{number_format($complejo->canchas[0]->precio,0)}}</span></a></li>
            </ul>
          </div>
          <a href="{{route('admin.ganancias.canchas', $complejo)}}" class="btn bg-lightblue btn-flat margin"><b>Ver más</b></a>
        </div>     
      </div>
      @endforeach

      

@endsection

