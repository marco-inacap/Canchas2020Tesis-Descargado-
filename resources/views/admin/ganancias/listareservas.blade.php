@extends('admin.layout')

@section('header')

<h1>
  Reservas
  <small>Listado de reservas en "{{$cancha->nombre}}"</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Ganancias</li>
  <li class="active">{{$cancha->complejo->nombre}}</li>
  <li class="active">{{$cancha->nombre}}</li>
</ol>

@endsection

@section('content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Reporte en CLP, <b>{{$cancha->nombre}}</b></h3>
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

<div class="box-body">
  <label>Filtrar por fechas de reserva a jugar.</label>
  <form class="form-inline float-right">
    <b>Fecha Desde:</b>
    <input class="form-control mr-sm-2" type="date" id="fecha_inicio" name="fecha_inicio" value="{{old('fecha_inicio',$request->fecha_inicio)}}" required>
    <b>Hasta:</b>
    <input class="form-control mr-sm-2" type="date" id="fecha_final" name="fecha_final" value="{{old('fecha_final',$request->fecha_final)}}" required>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="buscar">Buscar</button>
  </form>

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
        <td>{{  Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm ') }} -
          {{  Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a') }}</td>
        <td>{{ $reserva->user->name}}</td>
        @if ($reserva->status === 13)
        <td><span class="label label-success">{{\App\reserva::STATUS_DESC[$reserva->status]}}</span></td>
        @elseif($reserva->status <= 12) <td><span
            class="label label-warning">{{\App\reserva::STATUS_DESC[$reserva->status]}}</span></td>
          @elseif($reserva->status >= 14)
          <td><span class="label label-danger">{{\App\reserva::STATUS_DESC[$reserva->status]}}</span></td>
          @endif
          <td>$ {{ number_format($reserva->total, 0, ',', '.' )}}</td>
          <td>
            <a data-toggle="modal" data-target="#ModalShow{{$reserva->id}}" href="">Ver</a>

            <div class="modal fade" id="ModalShow{{$reserva->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Detalle reserva jaja</h5>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <tbody>
                        <h6 style="font-size: 10px;"><b>Id reserva: {{$reserva->id}}</b></h6>
                        <tr>
                          <th scope="row">Nombre de usuario:</th>
                          <td>{{$reserva->user->name}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Email:</th>
                          <td>{{$reserva->user->email}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Estado de Transacción:</th>
                          <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Fecha de reserva</th>
                          <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YY')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Hora de reserva</th>
                          <td>
                            {{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Nombre de complejo</th>
                          <td>{{ $reserva->cancha->complejo->nombre}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Nombre de cancha</th>
                          <td>{{ $reserva->cancha->nombre}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Fecha de pago</th>
                          <td>{{Carbon\Carbon::parse($reserva->created_at)->isoFormat('D - MM - YY / HH:mm')}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Monto:</th>
                          <td colspan="2"></td>
                          <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                          <th scope="row">Total:</th>
                          <td colspan="2"></td>
                          <td><b>${{ number_format($reserva->total, 0, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                          {!!QrCode::size(50)->generate($reserva->id) !!}
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <a target="_blank" href="{{route('detalle.reserva.download', $reserva)}}">PDF</a>
          </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot class="">
      <tr>
        <th colspan="5" style="font-weight: bold; font-size: 20px">Monto total</th>
        <td colspan="0" style="font-weight: bold; font-size: 18px; color: #2aa65a;">$
          {{number_format($totalReservas, 0, ',', '.' )}} </td>
      </tr>
    </tfoot>
  </table>
  @if ($reservas->count() < 1 ) <b style="color: red;">No existen reservas.</b>@endif
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
@endpush