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
            <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
              <label>Complejo</label>
              <select name="complejo_id" class="form-control select2" id="complejo">
                <option value="">
                  Seleeciona un Complejo </option>
                @foreach ($complejos as $complejo)
                <option value="{{$complejo->id}}"
                  {{old('complejo_id',$horario->complejo_id) == $complejo->id ? 'selected' : ''}}>{{$complejo->nombre}}
                </option>
                @endforeach
              </select>
              {!!$errors->first('cancha_id','<span class="help-block">:message</span>')!!}
            </div>
          </div>
          <div class="box-body">
            <div class="form-group {{$errors->has('cancha_id') ? 'has-error':''}}">
              <label>Cancha</label>
              <select name="cancha_id" class="form-control select2" id="cancha">
                <option value="">Seleccione Cancha</option>
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
              <input name="hora_cierre" type="time" class="form-control"
                value="{{old('hora_cierre', $horario->hora_cierre)}}">
            </div>
          </div>
          <div class="box-body">
            <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
              <label>Hora Apertura</label>
              <input name="hora_apertura" type="time" class="form-control"
                value="{{old('hora_apertura', $horario->hora_apertura)}}">
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

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  $(".select2").select2();

  $(function(){

    $('#complejo').on('change',onSelectComplejoChange);

  });

  function onSelectComplejoChange()
  {
    var complejo_id = $(this).val();


  if(! complejo_id)
    $('#cancha').html(html_select);

    $.get('/api/complejo/'+complejo_id+'/canchas',function(data){

      var html_select = '<option value="">Seleccione Cancha</option>' 
      for (var i=0; i<data.length; ++i) 
        html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>'       
        $('#cancha').html(html_select);  
    });
  }

</script>

@endpush