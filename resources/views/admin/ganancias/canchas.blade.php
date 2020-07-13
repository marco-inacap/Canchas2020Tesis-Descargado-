@extends('admin.layout')

@section('header')

<h1>
    Canchas 
     <small>Seleccione una Cancha</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
     <li class="active">{{$complejo->nombre}}</li> 
   </ol>

@endsection


@section('content')


@foreach ($canchas as $cancha)
    <div class="col-md-3">
        <div class="box box-primary">
            
            <div class="box-header with-border"></div>
                <img class="profile-user-img img-responsive img-circle" src="/img/logo.png" alt="{{$cancha->nombre}}">
            <div class="box-body">  
            <h3 class="profile-username text-center">{{$cancha->nombre}}</h3>
                
            <div class="progress-group">
                <span class="progress-text">Total Visitas</span>
                <span class="progress-number"><b>{{$cancha->total_visitas}}</b></span>
                <div class="progress sm">
                <div class="progress-bar progress-bar-green"  style="width: {{ 10/100 * $cancha->total_visitas}}%"></div>
                </div>
            </div>
            
            <ul class="list-group list-group-unbordered">
            <li class="list-group-item">              
                <b>Nº de Reservas</b> <a class="pull-right">{{count($cancha->reservas)}}</a>
            </li>
            <li class="list-group-item">
                <b>Precio Cancha</b> <a class="pull-right"> <span class="description-percentage text-green">$ {{$cancha->precio}}</span></a> 
            </li>
            <li class="list-group-item">
                <b>Ganancias Total </b> <a class="pull-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> $ {{$cancha->precio * count($cancha->reservas) }}</span></a> 
            </li>
            {{$variable->total_visitas}}
            </ul>
            <a href="{{route('admin.ganancias.lista', $cancha)}}" class="btn btn-primary btn-block"><b>Ver más</b></a>
            </div>
            
        </div>
    </div>
    @endforeach

@endsection
