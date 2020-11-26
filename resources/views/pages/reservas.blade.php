@extends('new.layout2')

<title>Reservas</title>
@section('content')

<div id="contact" class="form-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <div class="section-title">MIS RESERVAS</div>
                    <h2>Lista de mis reservas.</h2>
                    <h6>Has reservado <b>{{count($reservas->where('status', '=', 13))}}</b> veces</h2>
                    <form class="form-inline float-right">
                        <b>Fecha Desde:</b>
                        <input class="form-control mr-sm-2" type="date" id="fecha_inicio" name="fecha_inicio" value="{{old('fecha_inicio',$request->fecha_inicio)}}" required>
                        <b>Hasta:</b>
                        <input class="form-control mr-sm-2" type="date" id="fecha_final" name="fecha_final" value="{{old('fecha_final',$request->fecha_final)}}" required>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="buscar">Buscar</button>
                    </form>
                    <div class="form-contact">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora Inicio / Fin</th>
                                    <th scope="col">Cancha</th>
                                    <th scope="col">Complejo</th>
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
                                    <td>{{$reserva->cancha->nombre}}</td>
                                    <td><b>{{$reserva->cancha->complejo->nombre}}</b></td>
                                    <td>${{number_format($reserva->total,0, ',', '.')}}</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-xs"><a style="text-decoration: none;" href="{{route('detalle.reserva', $reserva)}}">Ver</a></button>
                                        <a style="text-decoration: none;" target="_blank" href="{{route('detalle.reserva.download', $reserva)}}">PDF</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($reservas->count() < 1 ) <p>Aún no tienes reservas, que esperas!</p>@endif
                    </div>
                </div>
                {{$reservas->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush

@push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush