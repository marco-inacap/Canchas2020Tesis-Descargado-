
@extends('layout')

@section('content')
<section class="pages container">
    <div class="page page-contact">
        <h1 class="text">Registrate para arrendar con nosotros! </h1>
        <p>Ingresa tus datos</p>
        <div class="divider-2" style="margin:25px 0;"></div>
        <div class="form-contact">
            <form class="form-horizontal" method="POST" action="{{ route('users.register') }}">
                {{ csrf_field() }}

                <div class="input-container container-flex space-between {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text" placeholder="Tu Nombre" class="form-control" name="name" value="{{ old('name') }}" required autofocus>  
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif                 
                </div>

                <div class="input-container container-flex space-between {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" placeholder="Email" class="input-email" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="input-container container-flex space-between {{ $errors->has('password') ? ' has-error' : '' }}" >                  
                    <input id="password" type="password" placeholder="Contraseña" class="form-control"  name="password"  required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif  
                </div>
                <br>
                <div class="input-container container-flex space-between">                  
                    <input id="password-confirm" type="password" placeholder="Confirma tu contraseña"class="form-control" name="password_confirmation" required> 
                </div>

                <div class="form-group row text-center sesion ">
                    <div class="col-md-12">
                        <a href="#" class="btn-face"><i class="fa fa-facebook"></i>Facebook</a>
                        <a  href="{{ url('/auth/redirect/google') }}"class="btn-google" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return true;">Google</a>
                        {{-- <a href="{{ route('social.auth', 'facebook') }}"> <i class="fab fa-facebook facebook"></i></a>
                        <a href="{{ url('/auth/redirect/google') }}"> <i class="fab fa-google google"></i></a> --}}
                    </div>
                </div>
                
                <div class="send-message">
                    <button  class="text-uppercase c-green">Registrarme</button>
                </div>
            </form>
        </div>
        
    </div>
</section>
@endsection
