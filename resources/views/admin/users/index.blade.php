@extends('admin.layout')

@section('header')

<h1>
   Usuarios
    <small>Listado de Usuarios en la BD</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li class="active">Usuarios</li>
  </ol>
    
@endsection

@section('content')

<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Lista de Usuarios</h3>
      @can('Create Users')  
      <a href="{{route('admin.users.create')}}" class="button btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Usuario</a>
      @endcan
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="user-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Complejo</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->getRoleNames()->implode(' - ')}}</td>
                <td>{{$user->complejo->pluck('nombre')->implode(' - ')}}</td>
                
                <td>
                  @can('View Users')
                    <a href="{{route('admin.users.show', $user)}}" class="btn-xs btn-lg"><i class="fa fa-eye"></i></a> 
                  @endcan  
                  @can('Update Users')  
                    <a href="{{route('admin.users.edit', $user)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                  @endcan   
                  @can('Delete Users',$user)
                  @if ($user->id != 1)
                    <form method="POST" action="{{route('admin.users.destroy', $user)}}" style="display: inline">
                      {{csrf_field()}} {{  method_field('DELETE')}} 
                    <button  class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar este Usuario?')"><i class="fa fa-times"></i></button>
                    </form>
                  @endif
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

    $('#user-table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{route('admin.users.store')}}">
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
</div> --}}
@endpush