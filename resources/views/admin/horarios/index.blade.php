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
      <h3 class="box-title">Horarios de mis canchas</h3>
      <div class="button btn btn-primary pull-right"><a class="fa fa-plus"></a> Agregar Horario</div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="cancha-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Cancha</th>
          <th>Fecha</th>
          <th>Cierre Inicio</th>
          <th>Cierre Final</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
            <tr>
                <td>{{ $horario->id}}</td>
                <td>{{ $horario->nombre}}</td>              
                <td>{{Carbon\Carbon::parse($horario->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
                <td>{{ $horario->hora_cierre}}</td>
                <td>{{ $horario->hora_apertura}}</td>
                <td>
                    
                    <a href="{{route('admin.horarios.edit', $horario->id)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                    {{-- <form method="POST" action="{{route('admin.canchas.destroy', $cancha)}}" style="display: inline">
                    {{csrf_field()}} {{  method_field('DELETE')}} 
                    <button  class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar esta cancha?')"><i class="fa fa-times"></i></button>
                    </form> --}}
                </td> 
            </tr>
                
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush
@push('scripts')
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {

    $('#cancha-table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endpush