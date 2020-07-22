@extends('admin.layout')

@section('header')

<h1>
   Canchas
    <small>Listado de Canchas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Canchas</li>
  </ol>
    
@endsection

@section('content')

<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Lista de Canchas</h3>
      @can('Create Cancha',$cancha)
      <div class="button btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Cancha</div>
      @endcan
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="cancha-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Complejo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($canchas as $cancha)
            <tr>
                <td>{{ $cancha->id}}</td>
                <td>{{$cancha->nombre}}</td>
                <td>$ {{number_format($cancha->precio)}}</td>
                <td>{{ optional($cancha->complejo)->nombre }}</td>
                <td class="badge badge-primary">{{optional($cancha->estado)->nombre }}</td>
                <td>
                    <a href="{{route('canchas.show', $cancha)}}" class="btn-xs btn-lg" target="_blank"><i class="fa fa-eye"></i></a>
                    @can('Update Cancha',$cancha)
                    <a href="{{route('admin.cancha.edit', $cancha)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('Delete Cancha',$cancha)
                    <form method="POST" action="{{route('admin.canchas.destroy', $cancha)}}" style="display: inline">
                      {{csrf_field()}} {{  method_field('DELETE')}} 
                    <button  class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar esta cancha?')"><i class="fa fa-times"></i></button>
                    </form>
                    @endcan
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{route('admin.cancha.store')}}">
    {{ csrf_field() }}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
              <label>Nombre de la Cancha </label>
              <input name="nombre" type="text" class="form-control" placeholder="Ingresa aquí el nombre de la Cancha" value="{{old('nombre')}}" required>
              {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
  </form>
</div>
@endpush