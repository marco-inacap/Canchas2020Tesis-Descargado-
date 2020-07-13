@component('mail::message')
# Tus credenciales para acceder a #TusCanchas

Utiliza esta contraseña para acceder a la pagina web.

@component('mail::table')

| Email | Contraseña |
|:----------|:------------|
| {{$user->email}} | {{$password}}
    
@endcomponent

@component('mail::button', ['url' => url('login')])
Ingresar 
@endcomponent

Gracias,<br>
TusCanchas
@endcomponent
