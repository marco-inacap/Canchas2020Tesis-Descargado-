@extends('admin.layout')

@section('header')

<h1>
   Canchas
    <small>Horarios</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Canchas</li>
  </ol>
    
@endsection

@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Agrega horarios</h3>
    </div>
    <form method="POST" action="{{route('admin.horarios.store')}}">
        {{ csrf_field() }}
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="box-body">
                <div class="form-group {{$errors->has('cancha_id') ? 'has-error':''}}">
                    <label>Cancha</label>
                    <select name="cancha_id" class="form-control select2">   
                        <option value="">
                        Seleeciona Cancha </option>                    
                        @foreach ($canchas as $cancha)
                        <option value="{{$cancha->id}}"
                            {{old('cancha_id',$horario->cancha_id) == $cancha->id ? 'selected' : ''}}
                            >{{$cancha->nombre}}</option>
                        @endforeach
                        
                    </select>
                    {!!$errors->first('cancha_id','<span class="help-block">:message</span>')!!}
                </div>
          </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                <label>Fecha</label>
                <input name="fecha" type="date" class="form-control" value="{{old('fecha', $horario->fecha)}}">
            </div>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                <label>Hora cierre</label>
                <input name="hora_cierre" type="time" class="form-control"  value="{{old('hora_cierre', $horario->hora_cierre)}}">
            </div>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                <label>Hora Apertura</label>
                <input name="hora_apertura" type="time" class="form-control" value="{{old('hora_apertura', $horario->hora_apertura)}}">
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
      </form>
    
</div>

@endsection