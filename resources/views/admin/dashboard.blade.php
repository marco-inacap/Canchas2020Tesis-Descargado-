
@extends('admin.layout')

@section('header')


<h2>Bienvenido {{auth()->user()->name}}!</h2>

<small>Reservas de hoy {{Carbon\Carbon::now()->format('d - M - Y')}}</small>
    
@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box-body">
    <table id="cancha-table" class="table table-bordered table-striped active">
        <thead>
            <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Hora Inicio / Fin</th>
            <th>Usuario</th>
            <th>Cancha</th>
            <th>Valor</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
            <tr>
                <td>{{$reserva->id}}</td>
                <td>{{$reserva->fecha}}</td>
                <td>{{$reserva->hora_inicio}} - {{$reserva->hora_fin}}</td>
                <td>{{$reserva->name}}</td>
                <td>{{$reserva->nombre}}</td>
                <td>$ {{number_format($reserva->precio,0, ',', '.')}}</td>
                <td>
                    <a>ver</a>
                    <a>#</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot class="">

            <tr>
        
            <th colspan="5" style="font-weight: bold; font-size: 20px">Total</th>
        
            <td colspan="0" style="font-weight: bold; font-size: 18px">$ {{number_format($totalReservasDia,0, ',', '.')}} </td>
        
            </tr>
        
        </tfoot> 
    </table>   
    @include('admin.ganancias.grafico') 
    
</div>
@endsection

@push('styles')
{{-- <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
{{-- <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script> --}}
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


<script>
        var canchas=[];
        var precio=[];
        var cantidad_reservas=[];

        
        $(document).ready(function(){

            $.ajaxSetup({
                headers:{
                    'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'admin/ganancias/all',
                method: 'POST',
                data:{
                    id:1
                }
            }).done(function(res){
                var arreglo = JSON.parse(res);
                
                for(var x=0;x<arreglo.length;x++){
                    
                var nreservas =  cantidad_reservas.push(arreglo[x].reservas);
                    canchas.push(arreglo[x].nombre);
                    precio.push(arreglo[x].precio * nreservas );
                    
                }
                generarGrafica();

            })

        });
    
    function generarGrafica(){
        
        var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: canchas,
        datasets: [{
            label: 'Ganancia de mis canchas.',
            data: precio,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 0.5
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    }    
    
</script>

@endpush
