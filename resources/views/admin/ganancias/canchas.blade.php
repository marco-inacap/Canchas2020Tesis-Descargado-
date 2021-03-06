@extends('admin.layout')

@section('header')

<h1>
    Canchas 
    <small>Seleccione una Cancha</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Ganancias</li>
    <li class="active">{{$complejo->nombre}}</li>
  </ol>

@endsection

@section('content')

@foreach ($canchas as $cancha)
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
                <img class="profile-user-img img-responsive img-circle" style="width:120px; height:120px;"  src="{{ url($cancha->photos->first()->url) }}"alt="{{$cancha->nombre}}" onerror="this.src='/img/logo.png';">
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
                <b>Nº de Reservas</b> <a class="pull-right text-blue">{{count($cancha->reservas->where('status','=',13))}}</a>
            </li>
            <li class="list-group-item">
                <b>Precio Cancha</b> <a class="pull-right"> <span class="description-percentage text-black">${{number_format($cancha->precio, 0, ',', '.' )}}</span></a> 
            </li>
            <li class="list-group-item">
                <b>Ganancias Total </b> <a class="pull-right"> <span class="description-percentage text-green"><b>${{number_format($cancha->reservas->where('status','=',13)->sum('total'), 0, ',', '.' ) }}</b></span></a> 
            </div>  
            <a href="{{route('admin.ganancias.lista', $cancha)}}" class="btn bg-lightblue btn-flat margin"><b>Ver más</b></a>
        </div>
    </div>
    @endforeach

@endsection
