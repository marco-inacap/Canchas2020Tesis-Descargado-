@extends('layout')

@section('content')

<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Reserva</h1>
        <p>Detalles de la reserva</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <i class="fa fa-globe"></i> #Tuscanchas
                      <small class="pull-right">Fecha: {{ date('d-m-yy') }}</small>  
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Nosotros
                    <address>
                      <strong>Tus Canchas</strong><br>
                      Bilbao #856<br>
                      Osorno, X Region<br>
                      Phone: 9 637 324 09<br>
                      Email: admin@tuscanchas.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Tus Datos
                    <address>
                     
                      <strong>{{auth()->user()->name }}</strong><br>
                      {{auth()->user()->email }}<br>
                      
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <br>
                    <b>Nº de orden:</b> {{$buyOrder}}<br>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
          
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Id Reserva</th>
                        <th>Fecha de reserva</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Termino</th>
                        <th>Cancha</th>
                        <th>Complejo</th>
                        <th>Usuario</th>
                        <th>Total</th>
                      </tr>
                      </thead>
                      {{-- <td>{{Carbon\Carbon::parse($ultimareserva->hora_inicio)->isoFormat('HH:mm')}}</td>
                        <td>{{Carbon\Carbon::parse($ultimareserva->hora_fin)->isoFormat('HH:mm')}}</td>
                        <td>{{Carbon\Carbon::parse($ultimareserva->fecha)->isoFormat('D - MMMM - YYYY')}}</td>   --}}
                      <tbody>
                    @foreach ($reservas as $reserva)
                      <tr>
                          <td>{{ $reserva->id}}</td>
                          <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YYYY')}}</td>              
                          <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm a')}}</td>
                          <td>{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a')}}</td>
                          <td>{{ $reserva->nombre}}</td>
                          <td>{{ $reserva->cancha->complejo->nombre}}</td>
                          <td>{{auth()->user()->name }}</td>
                          <td>${{ $reserva->precio}}</td>
                          <td>
                              
                            {{--  <a href="{{route('admin.horarios.edit', $horario->id)}}" class="btn-xs btn-info"><i class="fa fa-pencil"></i></a> --}}
                              {{-- <form method="POST" action="{{route('admin.canchas.destroy', $cancha)}}" style="display: inline">
                              {{csrf_field()}} {{  method_field('DELETE')}} 
                              <button  class="btn-xs btn-danger" onclick="return confirm('¿Estas seguro de eliminar esta cancha?')"><i class="fa fa-times"></i></button>
                              </form> --}}
                          </td> 
                      </tr> 
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
          
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">
                    <p class="lead">Metodos de Pago:</p>
                    <img src="/adminlte/img/credit/webpay.png" alt="Visa" style="width: 150px; height: 70px;">
          
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      Estos datos son de suma importancia y bla bla bla bla 
                      Estos datos son de suma importancia y bla bla bla bla 
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-6">
                    <p class="lead">Monto a la fecha del {{ date('d-m-yy') }}</p>
          
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$ {{ $reserva->precio}}</td>
                        </tr>      
                        <tr>
                          <th>Total:</th>
                          <td>$ {{ $reserva->precio + 2000}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
          
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-md-6">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                      <i class="fa fa-download"></i> Generar PDF
                    </button>
                  </div>
                  <div class="col-md-6">
                    <form method="POST" action="{{$response->url}}">
                      @csrf
                      <input type="hidden" name="token_ws" value="{{$response->token}}">
                    <button target="_blank" class="btn btn-default"><i class="fa fa-print"></i> PAGAR</button>
                    </form>
                  </div>
                </div>
              </section>

        </div>
        
    </div>
</section>
    
@endsection
@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
