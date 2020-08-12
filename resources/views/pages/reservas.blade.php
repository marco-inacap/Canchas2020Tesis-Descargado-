@extends('new.layout2')

@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <div class="section-title">MIS RESERVAS</div>
                    <h2>Lista de mis reservas</h2>
                    <p>Puedes ver el detalle de tu reserva, filtrar por fecha y demás.</p>
                    <div class="form-contact">
                            <table id="reservas-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora Inicio/Fin</th>
                                        <th scope="col">Cancha</th>
                                        <th scope="col">Complejo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservas as $reserva)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
                                        <td>{{  Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm ') }} -
                                            {{  Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a') }}</td>
                                        <td><a href="">{{$reserva->cancha->nombre}}</a></td>
                                        <td><a href="">{{$reserva->cancha->complejo->nombre}}</a></td>
                                        <td>{{\App\reserva::STATUS_DESC[$reserva->status]}}</td>
                                        <td>${{number_format($reserva->total,0, ',', '.')}}</td>
                                        <td>
                                            <a href="{{route('detalle.reserva', $reserva)}}">ver</a>
                                            <a target="_blank"
                                                href="{{route('detalle.reserva.download', $reserva)}}">PDF</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($reservas->count() < 1 ) <p>Aún no tienes reservas, que esperas!</p>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

@endpush
@push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
  
      $('#reservas-table').DataTable({

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