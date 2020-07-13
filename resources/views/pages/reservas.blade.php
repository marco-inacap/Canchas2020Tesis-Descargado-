@extends('layout')

@section('content')

<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Reservas </h1>
        <p>Historial de mis reservas</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <form action="#">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cancha</th>
                            <th scope="col">Complejo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                        <tr>
                            <th scope="row">{{$reserva->id}}</th>
                            <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MMMM - YYYY')}}</td>
                            <td>{{$reserva->cancha->nombre}}</td>
                            <td>{{$reserva->cancha->complejo->nombre}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        
    </div>
</section>
    
@endsection
@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush