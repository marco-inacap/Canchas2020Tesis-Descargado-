@extends('admin.layout')

@section('header')

<h1>
    Gráficos
    <small>Reportes gráficos Canchas</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Reportes gráficos canchas</li>
</ol>

@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.charts.charts-2')

@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="/charts/chart-2.js"></script>

@endpush