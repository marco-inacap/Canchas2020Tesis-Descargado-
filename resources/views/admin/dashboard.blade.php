
@extends('admin.layout')

@section('header')


<h2>Bienvenido <b>{{auth()->user()->name}}</b></h2>

<small>Reservas de hoy {{Carbon\Carbon::now()->format('d - M - Y')}}</small>
    
@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box-body">
    <table id="cancha-table" class="table table-bordered table-striped active">
        <thead>
            <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Hora Inicio / Fin</th>
            <th>Usuario</th>
            <th>Cancha</th>
            <th>Valor</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
            <tr>
                <td>{{$reserva->id}}</td>
                <td>{{$reserva->fecha}}</td>
                <td>{{$reserva->hora_inicio}} - {{$reserva->hora_fin}}</td>
                <td>{{$reserva->name}}</td>
                <td>{{$reserva->nombre}}</td>
                <td>${{number_format($reserva->total,0, ',', '.')}}</td>
                <td>
                    <a>ver</a>
                    <a>#</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot class="">
            <tr>
                <th colspan="5" style="font-weight: bold; font-size: 20px">Monto total</th>
                <td colspan="0" style="font-weight: bold; font-size: 18px; color: green">$ {{number_format($totalReservasDia,0, ',', '.')}} </td>
            </tr>
        </tfoot> 
    </table>   
</div>
@endsection

@push('styles')
{{-- <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
{{-- <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script> --}}
<script src="/charts/charts.js"></script>
<script>
  $(function () {

    $('#cancha-table').DataTable({

        "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


@endpush
