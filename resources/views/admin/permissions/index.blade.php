@extends('admin.layout')

@section('header')

<h1>
    Permisos
     <small>Listado de Permisos en la BD</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>
     <li class="active">Permisos</li>
   </ol>
@endsection

@section('content')

<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Lista de Permisos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="user-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td> 
                  @can('update',$permission)
                    <a href="{{route('admin.permissions.edit', $permission)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a>
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