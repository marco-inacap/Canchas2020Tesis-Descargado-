@extends('new.layout')

@section('meta-title')Error 403 @endsection

@section('content')

<div class="form-1">
    <div class="container">
        <h1 class="text" style="color: white;">UPS! No estas autorizado para estar aquí.</h1>
        <span style="color: red;">{{ $exception->getMessage()}}</span>
        <p><a style="color: white; " href="{{ url()->previous()}}">Regresar</a></p>
        <div class="divider-2" style="margin: 35px 0;"></div>      
    </div>
</div>

@endsection