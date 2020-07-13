@extends('layout')

@section('content')

<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Contáctate con nostros! </h1>
        <p>Ingresa tus datos y te responderemos</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <form action="#">
                <div class="input-container container-flex space-between">
                    <input type="text" placeholder="Tu Nombre" class="input-name">
                    <input type="text" placeholder="Email" class="input-email">
                </div>              
                <div class="input-container">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Texto"></textarea>
                </div>
                <div class="send-message">
                    <a href="#" class="text-uppercase c-green">Enviar</a>
                </div>
            </form>
        </div>
        
    </div>
</section>
    
@endsection

