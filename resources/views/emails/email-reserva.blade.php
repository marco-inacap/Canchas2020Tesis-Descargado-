@component('mail::message')
# Comprobante de reserva de hora.

<b>{{$email_reserva->user->name}}</b>, esta es la hora que acabas de reservar.

@component('mail::table')

| Fecha  | Hora  | Complejo  | Cancha  |
|:-------|:------|:----------|:--------|
|{{\Carbon\Carbon::parse($email_reserva->fecha)->format('d-m-Y')}}| {{\Carbon\Carbon::parse($email_reserva->hora_inicio)->format('H:i')}}/{{\Carbon\Carbon::parse($email_reserva->hora_fin)->format('H:i a')}} | {{$email_reserva->complejo->nombre}} | {{$email_reserva->cancha->nombre}}

@endcomponent

{{-- @component('mail::button', ['url' => 'detalle/'.$email_reserva->id, 'color' => 'success'])
MAS DETALLES
@endcomponent --}}

Ubicación de <b>{{$email_reserva->complejo->nombre}}</b>: {{$email_reserva->complejo->ubicacion}}. 

@component('mail::button', ['url' => url('detalle/'.$email_reserva->id), 'color' => 'success'])
MAS DETALLES
@endcomponent

Gracias por reservar con nosotros.<br>
<b>{{ config('app.name') }}</b>
@endcomponent
