@extends('admin.layout')

@section('header')

<h1>
    Roles
     <small>Listado de Roles en la BD</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
     <li class="active">Roles</li>
   </ol>
@endsection

@section('content')

<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Lista de Roles</h3>
      @can('Create Roles', $roles->first())
      <a href="{{route('admin.roles.create')}}" class="button btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Rol</a>
      @endcan
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="user-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Nom. Identificador</th>
          <th>Nombre</th>
          <th>Permisos</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->permissions->pluck('name')->implode(' - ')}}</td>
                <td> 
                  @can('Update Roles', $role)
                    <a href="{{route('admin.roles.edit', $role)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                    @if ($role->id !== 1)
                  @endcan 
                  @can('Delete Roles', $role) 
                    <form method="POST" action="{{route('admin.roles.destroy', $role)}}" style="display: inline">
                      {{csrf_field()}} {{  method_field('DELETE')}} 
                    <button  class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar este Rol?')"><i class="fa fa-times"></i></button>
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