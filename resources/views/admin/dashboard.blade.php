@extends('admin.layout')

@section('header')


<h2>Bienvenido <b>{{auth()->user()->name}}</b></h2>


@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box-body">

</div>
@endsection

@push('styles')
{{-- <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
{{-- <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script> --}}
<script src="/charts/charts.js"></script>
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
      "autoWidth": false,
    });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


@endpush