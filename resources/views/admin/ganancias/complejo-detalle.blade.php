@extends('admin.layout')

@section('header')

<h1>
  Complejo
  <small>{{$complejo->nombre}}</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Ganancias</li>
</ol>

@endsection

@section('content')

<div class="row">
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-calendar-check-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Reservas Hoy</span>
        <span class="info-box-number" style="font-size:25px;">{{$numReservasHoy}}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-check-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Reservas SEMANA</span>
        <span class="info-box-number" style="font-size:25px;">{{$numReservasSemana}}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-purple"><i class="fa fa-calendar-check-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Reservas MES</span>
        <span class="info-box-number" style="font-size:25px;">{{$numReservasMes}}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Reservas Total</span>
        <span class="info-box-number" style="font-size:25px;">{{$numReservasTotal}}</span>
      </div>
    </div>
  </div>
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Ganancias en CLP, <b>{{$complejo->nombre}}</b></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-footer">
    <div class="row">
      <div class="col-sm-2 col-xs-3">
        <div class="description-block border-righ">
          <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
          <h5 class="description-header">$ {{ number_format($totalReservasDia, 0, ',', '.') }}</h5>
          <span class="description-text">TOTAL DÍA</span>
        </div>
      </div>
      <div class="col-sm-2 col-xs-3">
        <div class="description-block border-right">
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
          <h5 class="description-header">$ {{number_format($totalReservasSemana,0, ',', '.')}}</h5>
          <span class="description-text">TOTAL SEMANA</span>
        </div>
      </div>
      <div class="col-sm-2 col-xs-3">
        <div class="description-block border-right">
          <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
          <h5 class="description-header">$ {{number_format($totalReservasMes,0, ',', '.')}}</h5>
          <span class="description-text">TOTAL MES</span>
        </div>
      </div>
      <div class="col-sm-3 col-xs-3">
        <div class="description-block border-right">
          <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
          <h5 class="description-header">$ {{number_format($totalReservasMesPasado,0, ',', '.')}}</h5>
          <span class="description-text">TOTAL MES PASADO</span>
        </div>
      </div>
      <div class="col-sm-3 col-xs-6">
        <div class="description-block border-right">
          <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
          <h5 class="description-header">$ {{number_format($totalReservas,0, ',', '.')}}</h5>
          <span class="description-text">TOTAL</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab">HOY</a></li>
    <li><a href="#tab_2" data-toggle="tab">General</a></li>
  </ul>
  <div class="tab-content">
    <div class="box-body tab-pane active" id="tab_1">
      @if ($reservasHoy->count() > 0)
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
          @foreach ($reservasHoy as $hoy)
          <tr>
            <td>{{ $hoy->id}}</td>
            <td>{{Carbon\Carbon::parse($hoy->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
            <td>{{  Carbon\Carbon::parse($hoy->hora_inicio)->isoFormat('HH:mm ') }} -
              {{  Carbon\Carbon::parse($hoy->hora_fin)->isoFormat('HH:mm a') }}</td>
            <td>{{ $hoy->user->name}}</td>
            <td>{{\App\reserva::STATUS_DESC[$hoy->status]}}</td>
            <td>$ {{ number_format($hoy->total, 0, ',', '.' )}}</td>
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
            <td colspan="0" style="font-weight: bold; font-size: 18px; color: green">$
              {{number_format($totalReservasDia, 0, ',', '.' )}} </td>
          </tr>
        </tfoot>
      </table>
      @else
      <h3 class="box-title">Aún no tienes reservas hoy :(</h3>
      @endif
    </div>
    <div class="tab-pane" id="tab_2">
      <table id="cancha-table2" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>H. Inicio / Fin</th>
            <th>Cancha</th>
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
            <td>{{  Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm ') }} -
              {{  Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a') }}</td>
            <td>{{ $reserva->cancha->nombre}}</td>
            <td>{{ $reserva->user->name}}</td>
            <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
            <td>${{ number_format($reserva->total, 0, ',', '.' )}}</td>
            <td>
              <a>ver</a>
              <a>#</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="">
          <tr>
            <th colspan="6" style="font-weight: bold; font-size: 20px">Monto total</th>
            <td colspan="0" style="font-weight: bold; font-size: 18px; color: green">$
              {{number_format($totalReservas, 0, ',', '.' )}} </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
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
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false

        
      });
    });
</script>
<script>
  $(function () {
  
      $('#cancha-table2').DataTable({

        "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false

        
      });
    });
</script>
@endpush