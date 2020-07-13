@extends('layout')

@section('content')

	
<section class="pages container">
    <div class="page page-about">
        <h1 class="text">No estas autorizado para estar aquí!</h1>
        <span style="color: red;">{{ $exception->getMessage()}}</span>
        
        <p><a href="{{ url()->previous()}}">Regresar</a></p>
        <div class="divider-2" style="margin: 35px 0;"></div>      
    </div>
</section>

@endsection