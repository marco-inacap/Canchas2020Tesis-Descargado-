@extends('new.layout2')

@section('content')
{{-- <section class="pages container">
  <div class="page page-contact">
    <h1 class="text">Reserva</h1>
    <p>Detalles de la reserva para la cancha {{$canchas->nombre}}</p>
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

          <strong>{{$reserva->user->name}}</strong><br>
          {{$reserva->user->email}}<br>

        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <br>
        <b>Nº de orden:</b> {{$db_transaction->buy_order}}<br>
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
          <tbody>
            <tr>
              <td>{{ $reserva->id}}</td>
              <td>{{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MM - YYYY')}}</td>
              <td>{{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm a')}}</td>
              <td>{{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a')}}</td>
              <td>{{ $reserva->cancha->nombre}}</td>
              <td>{{ $reserva->cancha->complejo->nombre}}</td>
              <td>{{auth()->user()->name }}</td>
              <td>${{ number_format($reserva->cancha->precio, 0, ',', '.') }}</td>
            </tr>
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
              <td>${{ number_format($reserva->cancha->precio, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>${{ number_format($reserva->cancha->precio, 0, ',', '.') }}</td>
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
        <form action="{{$response->url}}" method="post">
          @csrf
          <input type="hidden" name="token_ws" value="{{$response->token}}">
          <button target="_blank" class="btn-solid-reg page-scroll"><i class="fa fa-dollar-sign"></i> PAGAR</button>
        </form>
      </div>
    </div>
  </section>
</div>

</div>
</section> --}}


<div class="form-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>
        <h6 class="text-center"><b>Tu reserva</b></h6>
        <div class="card border-transparent mb-3" style="width:22rem; margin:0 auto; ">
          <ul class="list-group list-group-flush">
            <li class="list-group-item media">
              <strong>A nombre de:</strong> &nbsp; {{$reserva->user->name}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Tu email:</strong> {{$reserva->user->email}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Complejo:</strong> {{$reserva->complejo->nombre}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Cancha:</strong> {{$reserva->cancha->nombre}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Dirección:</strong> {{$reserva->complejo->ubicacion}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Fecha a jugar:</strong> {{Carbon\Carbon::parse($reserva->fecha)->isoFormat('D - MMMM - YYYY')}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media ">
              <strong>Hora:</strong> {{Carbon\Carbon::parse($reserva->hora_inicio)->isoFormat('HH:mm')}} /
              {{Carbon\Carbon::parse($reserva->hora_fin)->isoFormat('HH:mm a')}}
            </li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item media">
              <strong><b>TOTAL:</b></strong> &nbsp;<b>${{ number_format($reserva->cancha->precio, 0, ',', '.') }}</b>
            </li>
          </ul>
        </div>
        <div class="col-xs-6 text-center">
          <p>Unico metodo de pago (Por ahora)</p>
          <img src="/adminlte/img/credit/webpay.png" alt="Visa" style="width: 150px; height: 70px;">
        </div>
        <br>
        <div class="text-center">
          <form action="{{$response->url}}" method="post">
            @csrf
            <input type="hidden" name="token_ws" value="{{$response->token}}">
            <button style="width:24rem; margin:0 auto; " target="_blank" class="btn-solid-reg">PAGAR</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@endsection
@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush