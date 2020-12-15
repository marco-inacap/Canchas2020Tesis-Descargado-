@extends('new.layout')

@section('meta-title')Error 404 @endsection

@section('content')

<div class="form-1">
    <div class="container">
        <h1 class="text" style="color: white;">UPS! Pagina no encontrada.</h1>
        <span style="color: red;">{{ $exception->getMessage()}}</span>
        <p><a style="color: white; " href="{{ url()->previous()}}">Regresar al ininicio</a></p>
        <div class="divider-2" style="margin: 35px 0;"></div>
        <p style="color: white;">Quizás escribiste mal la dirección.</p>
    </div>
</div>

@endsection