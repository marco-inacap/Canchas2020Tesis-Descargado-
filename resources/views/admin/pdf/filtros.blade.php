@extends('admin.layout')


@section('header')
<h1>
    Exportar reservas.
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Filtros</li>
</ol>

@endsection


@section('content')
<div class="row">
    <form target="_blank" method="POST" action="{{route('vista.filtros-complejo.export')}}" onsubmit="return ValidarFechas()">
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Exportar por complejo</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
                        <label>Complejo</label>
                        <select multiple="multiple" name="complejo_id[]" class="form-control select2" required>
                            <option value="">
                                Seleeciona un Complejo </option>
                            @foreach ($complejos as $complejo)
                            <option value="{{$complejo->id}}">
                                {{$complejo->nombre}}
                            </option>
                            @endforeach
                        </select>
                        {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Fechas de reservas</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Desde</label>
                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Hasta</label>
                        <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success btn-solid-lg center-block">Generar PDF</button>
        </div>
    </form>
</div>





<div class="row">
    <form target="_blank" method="POST" action="{{route('vista.filtros.export')}}" onsubmit="return ValidarFechas()">
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Exportar por complejo y cancha</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
                        <label>Complejo</label>
                        <select name="complejo_id" class="form-control select2" id="complejo" required>
                            <option value="">
                                Seleeciona un Complejo </option>
                            @foreach ($complejos as $complejo)
                            <option value="{{$complejo->id}}">
                                {{$complejo->nombre}}
                            </option>
                            @endforeach
                        </select>
                        {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('cancha_id') ? 'has-error':''}}">
                        <label>Cancha</label>
                        <select name="cancha_id" class="form-control select2" id="cancha" required>
                            <option value="">Seleccione Cancha</option>
                        </select>
                        {!!$errors->first('cancha_id','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Fechas de reservas</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Desde</label>
                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Hasta</label>
                        <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger btn-solid-lg  center-block">Generar PDF</button>
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
        var fecha1 = $('#fecha_inicio').val();
        var fecha2= $('#fecha_fin').val();
        
        var fechaFormulario1 = Date.parse(fecha1);
        var fechaFormulario2 = Date.parse(fecha2);
                        
            if (hoy <= fechaFormulario1) {
                    Swal.fire({
                        icon:'warning',
                        text:'No puedes buscar en una fecha futura.'})
                        return false;
            } else if (fechaFormulario1 > fechaFormulario2) {
                Swal.fire({
                    icon:'warning',
                    text:'La fecha 1 tiene que ser menor a la 2'})
                    return false;
            }
                console.log("Ok");
                return true;
    }

</script>

@endpush