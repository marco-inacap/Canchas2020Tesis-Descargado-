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

<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
        <li><a href="#tab_hoy" data-toggle="tab">Hoy</a></li>
        <li class="pull-left header"><i class="fa fa-th"></i>Lista Reservas <b>{{$complejo->nombre}}</b></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_general">
          <div class="form-group text-center">
            <div id="fecha_1" class="tab-pane fade in active">
                <form class="form-inline float-right">
                    <b>Fecha Desde:</b>
                    <input class="form-control mr-sm-2" type="date" id="fecha_inicio" name="fecha_inicio" required>
                    <b>Hasta:</b>
                    <input class="form-control mr-sm-2" type="date" id="fecha_final" name="fecha_final" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="buscar">Buscar</button>
                </form>
            </div>
        </div>
          <!-- INICIO TAB GENERAL -->
          <table id="cancha-table2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Fecha a jugar</th>
                <th>H. Inicio / Fin</th>
                <th>Cancha</th>
                <th>Usuario</th>
                <th>Fecha de pago</th>
                <th>Estado de pago</th>
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
                <td>{{Carbon\Carbon::parse($reserva->created_at)->isoFormat('D - MMMM - YYYY')}}</td>
                <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
                <td>${{ number_format($reserva->total, 0, ',', '.' )}}</td>
                <td>
                  <a data-toggle="modal" data-target="#ModalShow{{$reserva->id}}" href="">Ver</a>

                  <!-- MODAL VER -->
                  <div class="modal fade" id="ModalShow{{$reserva->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detalle reserva</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table">
                            <tbody>
                              <h6 style="font-size: 10px;"><b>Id reserva: {{$reserva->id}}</b>
                              </h6>
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
                                <td><b>{{\App\reserva::STATUS_DESC[$reserva->status]}}</b></td>
                              </tr>
                              <tr>
                                <th scope="row">Fecha de reserva</th>
                                <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YY')}}
                                </td>
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
                                <td>{{Carbon\Carbon::parse($reserva->created_at)->isoFormat('D - MM - YY / HH:mm')}}
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Monto:</th>
                                <td colspan="2"></td>
                                <td>${{ number_format($reserva->total, 0, ',', '.') }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Total:</th>
                                <td colspan="2"></td>
                                <td><b>${{ number_format($reserva->total, 0, ',', '.') }}</b>
                                </td>
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
                  <!-- TERMINA MODAL -->
                  <a target="_blank" href="{{route('detalle.reserva.download', $reserva)}}">PDF</a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot class="">
              <tr>
                <th colspan="7" style="font-weight: bold; font-size: 20px">Monto total</th>
                <td colspan="0" style="font-weight: bold; font-size: 18px; color: green">$
                  {{number_format($totalReservas, 0, ',', '.' )}} </td>
              </tr>
            </tfoot>
          </table>


          <!-- FIN TAB GENERAL -->
        </div>

        <!-- INICIO TAB HOY -->
        <div class="tab-pane" id="tab_hoy">
          @if ($reservasHoy->count() > 0)
          <table id="cancha-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Fecha a jugar</th>
                <th>H. Inicio / Fin</th>
                <th>Cancha</th>
                <th>Usuario</th>
                <th>Fecha de pago</th>
                <th>Valor</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reservasHoy as $hoy)
              <tr>
                <td>{{ $hoy->id}}</td>
                <td>{{Carbon\Carbon::parse($hoy->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
                <td>{{  Carbon\Carbon::parse($hoy->hora_inicio)->isoFormat('HH:mm ') }} 
                  {{  Carbon\Carbon::parse($hoy->hora_fin)->isoFormat('HH:mm a') }}</td>
                  <td>{{ $hoy->cancha->nombre}}</td>
                <td>{{ $hoy->user->name}}</td>
                <td>{{Carbon\Carbon::parse($hoy->created_at)->isoFormat('D - MMMM - YYYY')}}</td>
                <td>${{ number_format($hoy->total, 0, ',', '.' )}}</td>
                <td>
                  <a data-toggle="modal" data-target="#ModalHoy{{$hoy->id}}" href="">Ver</a>
                  <!-- MODAL RESERVA HOY -->
                  <div class="modal fade" id="ModalHoy{{$hoy->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detalle reserva</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table">
                            <tbody>
                              <h6 style="font-size: 10px;"><b>Id reserva: {{$hoy->id}}</b>
                              </h6>
                              <tr>
                                <th scope="row">Nombre de usuario:</th>
                                <td>{{$hoy->user->name}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Email:</th>
                                <td>{{$hoy->user->email}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Estado de Transacción:</th>
                                <td><b>{{\App\reserva::STATUS_DESC[$hoy->status]}}</b></td>
                              </tr>
                              <tr>
                                <th scope="row">Fecha de reserva</th>
                                <td>{{Carbon\Carbon::parse($hoy->fecha)->isoFormat('D - MM - YY')}}
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Hora de reserva</th>
                                <td>
                                  {{Carbon\Carbon::parse($hoy->hora_inicio)->isoFormat('HH:mm')}}/{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm')}}
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Nombre de complejo</th>
                                <td>{{ $hoy->cancha->complejo->nombre}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Nombre de cancha</th>
                                <td>{{ $hoy->cancha->nombre}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Fecha de pago</th>
                                <td>{{Carbon\Carbon::parse($hoy->created_at)->isoFormat('D - MM - YY / HH:mm')}}
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Monto:</th>
                                <td colspan="2"></td>
                                <td>${{ number_format($hoy->total, 0, ',', '.') }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Total:</th>
                                <td colspan="2"></td>
                                <td><b>${{ number_format($hoy->total, 0, ',', '.') }}</b>
                                </td>
                              </tr>
                              <tr>
                                {!!QrCode::size(50)->generate($hoy->id) !!}
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- FIN MODAL HOY -->
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
        <!-- FIN TAB HOY  -->
      </div>
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
        "ordering": false,
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
        "ordering": false,
        "info": true,
        "autoWidth": false

        
      });
    });
</script>
@endpush