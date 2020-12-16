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
<br>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  Agrega un horario en el que estará cerrada la cancha. (Será visualizada como "CERRADA" en el calendario de reservas y
  no se podra reservar en ese horario)
  tareas programadas laravel
</div>

@endsection

@section('content')
<form method="POST" action="{{route('admin.horarios.store')}}" onsubmit="return ValidarFechas()">
  {{ csrf_field() }}
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Agrega un horario de cierre.</h3>
      </div>
      <div class="box-body">
        <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
          <label>Complejo</label>
          <select name="complejo_id" class="form-control select2" id="complejo">
            <option value="">
              Seleeciona un Complejo </option>
            @foreach ($complejos as $complejo)
            <option value="{{$complejo->id}}"
              {{old('complejo_id',$horario->complejo_id) == $complejo->id ? 'selected' : ''}}>
              {{$complejo->nombre}}
            </option>
            @endforeach
          </select>
          {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
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
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body">
        <div class="form-group {{$errors->has('fecha') ? 'has-error':''}}">
          <label>Fecha</label>
          <input id="fecha" name="fecha" type="date" class="form-control" value="{{old('fecha', $horario->fecha)}}">
        </div>
        {!!$errors->first('fecha','<span class="help-block">:message</span>')!!}
      </div>
      <div class="box-body">
        <div class="form-group {{$errors->has('hora_cierre') ? 'has-error':''}}">
          <label>Hora de Comienzo (Cierre)</label>
          <input id="hora_cierre" name="hora_cierre" type="time" class="form-control"
            value="{{old('hora_cierre', $horario->hora_cierre)}}">
        </div>
        {!!$errors->first('hora_cierre','<span class="help-block">:message</span>')!!}
      </div>
      <div class="box-body">
        <div class="form-group {{$errors->has('hora_apertura') ? 'has-error':''}}">
          <label>Hora de Termino (Cierre)</label>
          <input id="hora_apertura" name="hora_apertura" type="time" class="form-control"
            value="{{old('hora_apertura', $horario->hora_apertura)}}">
        </div>
        {!!$errors->first('hora_apertura','<span class="help-block">:message</span>')!!}
      </div>
    </div>
  </div>
  <div style="text-align: center;" class="modal-footer">
    <button class="btn btn-danger btn-lg text-center">Agregar Horario</button>
  </div>
</form>

<div class="box box-primary">
  <div class="box-body">
    <table id="cancha-table" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Cancha</th>
          <th>Fecha</th>
          <th>Inicio de cierre</th>
          <th>Fin de cierre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($canchas as $cancha)
        @foreach ($cancha->horario as $horario)
        <tr>
          <td>{{ $horario->id}}</td>
          <td>{{ $horario->cancha->nombre}}</td>
          <td>{{Carbon\Carbon::parse($horario->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
          <td>{{ $horario->hora_cierre}}</td>
          <td>{{ $horario->hora_apertura}}</td>
          <td class="text-center">
            <a class="btn-xs btn-info" data-toggle="modal" data-target="#ModalShow{{$horario->id}}" href=""><i
                class="fa fa-pencil"></i></a>
            <form method="POST" action="{{route('admin.horarios.destroy', $horario)}}" style="display: inline">
              {{csrf_field()}} {{  method_field('DELETE')}}
              <button class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar este horario?')"><i
                  class="fa fa-times"></i></button>
            </form>

            <!-- Modal-->
            <div class="modal fade " id="ModalShow{{$horario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <form method="POST" action="{{route('admin.horarios.update',$horario)}}" onsubmit="return ValidarFechasNav()">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="exampleModalLabel">Horario de <b>{{$horario->cancha->nombre}}</b></h5>
                    </div>
                    <div class="modal-body">
                      <div class="box-body">
                        <div class="form-group">
                          <label>Fecha</label>
                          <input id="fecha_nav" name="fecha" type="date" class="form-control"
                            value="{{old('fecha', $horario->fecha)}}">
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                          <label>Hora de Comienzo (Cierre)</label>
                          <input id="hora_cierre_nav" name="hora_cierre" type="time" class="form-control"
                            value="{{old('hora_cierre', $horario->hora_cierre)}}">
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group ">
                          <label>Hora de Termino (Cierre)</label>
                          <input id="hora_apertura_nav" name="hora_apertura" type="time" class="form-control"
                            value="{{old('hora_apertura', $horario->hora_apertura)}}">
                        </div>
                      </div>
                    </div>
                    <div style="text-align: center;" class="modal-footer">
                      <button class="btn btn-danger btn-lg text-center">Editar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
  </div>
  </td>
  </tr>
  @endforeach
  @endforeach
  </tbody>
  </table>
</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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


    function ValidarFechas()
    {
      var hoy = new Date();

      var fecha = $('#fecha').val();
      var fechainicial = document.getElementById("hora_cierre").value;
      var fechafinal = document.getElementById("hora_apertura").value;

      var fechaFormulario = Date.parse(fecha);

      if (hoy > fechaFormulario) {
        Swal.fire({
            icon:'warning',
            text:'No puedes agregar un horario de cierre en una fecha que ya paso.'})
            return false;
      }else if (fechafinal < fechainicial){
        Swal.fire({
            icon:'warning',
            text:'La hora 2 tienes que ser mayor a la 2'})
            return false;
      }
      console.log("Ok");
      return true;
    }


    function ValidarFechasNav()
    {
      var hoy = new Date();

      var fecha = $('#fecha_nav').val();
      var fechainicial = document.getElementById("hora_cierre_nav").value;
      var fechafinal = document.getElementById("hora_apertura_nav").value;

      var fechaFormulario = Date.parse(fecha);

      if (hoy > fechaFormulario) {
        Swal.fire({
            icon:'warning',
            text:'No puedes agregar un horario de cierre en una fecha que ya paso.'})
            return false;
      }else if (fechafinal < fechainicial){
        Swal.fire({
            icon:'warning',
            text:'La hora 2 tienes que ser mayor a la 2'})
            return false;
      }
      console.log("Ok");
      return true;
    }

</script>

@endpush