@extends('admin.layout')

@section('header')

<h1>
    Reservas 
     <small>Listado de reservas en "{{$cancha->nombre}}"</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
     <li class="active">{{$cancha->nombre}}</li> 
   </ol>

@endsection

@section('content')


<div class="box-body">
    <table id="cancha-table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>H. Inicio / Fin</th>
        <th>Usuario</th>
        <th>Estado Reserva</th>
        <th>Valor</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
          @foreach ($reservas as $reserva)
          <tr>
              <td>{{ $reserva->id}}</td>
              <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
              <td>{{  Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm ') }} - {{  Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a') }}</td>
              <td>{{ $reserva->user->name}}</td>
              <td>{{ $reserva->estado_id}}</td>
              <td>$ {{ $reserva->cancha->precio}}</td>
               <td>
                <a>ver</a>
                <a>exportar</a>
              </td> 
          </tr> 
          @endforeach
      </tbody>
      <tfoot class="">

        <tr>
    
        <th colspan="5" style="font-weight: bold; font-size: 20px">Monto total</th>
    
        <td colspan="0" style="font-weight: bold; font-size: 18px">$ {{$totalReservas}} </td>
    
        </tr>
    
    </tfoot> 
    </table>
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

        "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
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
