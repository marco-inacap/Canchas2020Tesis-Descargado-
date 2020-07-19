@extends('admin.layout')

@section('header')

<h1>
    Complejos
     <small>Listado de mis Complejos</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
     <li class="active">Complejos</li>
   </ol>

@endsection

@section('content')
    @foreach ($complejos as $complejo)
    <div class="col-md-3">
        <div class="box box-primary">
            
            <div class="box-header with-border"></div>
            <form method="POST" action="{{route('admin.complejo.destroy',$complejo)}}">
                {{  method_field('DELETE')}} {{csrf_field()}}
                <button class="btn btn-danger btn-xs" style="position: absolute"> <i class="fa fa-remove"></i></button>
                <img class="profile-user-img img-responsive img-circle" style="width:90px; height:90px;"  src="{{ url($complejo->url_imagen) }}" onerror="this.src='/img/logo.png';">
            </form>
            <div class="box-body">  
            <h3 class="profile-username text-center">{{$complejo->nombre}}</h3>

            {{-- <p class="text-muted text-center">{{$user->getRoleNames()->implode(' - ')}}</p> --}}

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Ubicación</b> <a class="pull-right">{{$complejo->ubicacion}}</a>
                </li>
                <li class="list-group-item">
                    <b>Nº Contacto</b> <a class="pull-right">{{$complejo->telefono}}</a>
                </li>
                <li class="list-group-item">
                <b>Nº de canchas </b> <a class="pull-right">{{count($complejo->canchas)}}</a> 
                
                </li>
                {{-- @if ($user->roles->count())
                <li class="list-group-item">
                    <b>Roles</b> <a class="pull-right">{{$user->getRoleNames()->implode(' - ')}}</a>
                </li>
                @endif --}}
            </ul>
            <a href="{{route('admin.complejo.edit', $complejo)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
            
        </div>
    </div>
    @endforeach


@endsection