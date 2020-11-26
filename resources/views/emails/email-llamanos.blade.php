@component('mail::message')
# Nuevo contacto.

<b>{{$nombre}}</b>, quiere conversar con nosotros.


@component('mail::panel')
    <b>Teléfono:</b> {{$n_telefono}} <br>
    <b>Email:</b> {{$email}} <br>
    <b>Interesado en:</b> {{$interes}}
@endcomponent

<b>{{ config('app.name') }}</b>
@endcomponent
