@extends('new.layout2')

@section('content')

<div class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">REGISTRATE</div>
                    <h2>Registrate en nuestro sitio</h2>
                    <p style="color: white;">Obtendras opciones como:</p>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Reservar canchas</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Ver calendario de reservas</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Ver tus reservas</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Forma segura de reservar</div>
                        </li>
                    </ul>
                    {{-- <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol, OSORNO.</li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:office@aria.com">marcoignacio.96@hotmail.com</a></li>
                    </ul> --}}
                    <h3 style="color: white;">Siguenos en nuetras Redes Sociales</h3>

                    <span class="fa-stack">
                        <a target="_blank" href="https://www.facebook.com/Marco.Ignacio.9693/">
                            <span class="hexagon"></span>
                            <i style="color: white;" class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a target="_blank" href="https://www.instagram.com/marco.gonzalez.i/?hl=es-la">
                            <span class="hexagon"></span>
                            <i style="color: white;"class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                
                <!-- Contact Form -->
                <form class="form-horizontal" method="POST" action="{{ route('users.register') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control-input" name="name" value="{{ old('name') }}" required autofocus>
                        <label class="label-control" for="lname">Tu Nombre</label>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <div class="help-block with-errors white">{{ $errors->first('name') }}</div>
                            </span>
                        @endif    
                    </div>
                    
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control-input" name="email" value="{{ old('email') }}" required>
                        <label class="label-control" for="lname">Tu Email</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <div class="help-block with-errors white">{{ $errors->first('email') }}</div>
                            </span>
                        @endif 
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control-input" name="password" value="{{ old('password') }}" required>
                        <label class="label-control" for="lname">Tu Contraseña</label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <div class="help-block with-errors white">{{ $errors->first('password') }}</div>
                            </span>
                        @endif 
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control-input" name="password_confirmation" required>
                        <label class="label-control" for="lname">Confirma tu contraseña</label>
                    </div>
                    <div class="form-group checkbox">
                        <input  type="checkbox" id="cterms" value="Agreed-to-Terms" required>Acepto la <a href="privacy-policy.html">Política de Privacidad</a> y <a href="terms-conditions.html">Terminos y Condiciones</a> 
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">REGISTRARME</button>
                    </div>
                    <h6 style="color: white;" class="text-center">Registrate con</h6>
                    <div class="form-group text-center">
                        <span class="fa-stack">
                            <a href="">
                                <span class="hexagon"></span>
                                <i style="color: rgba(49,191,152);" class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a class="btn-google" href="{{ url('/auth/redirect/google') }}" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;">
                                <span class="hexagon"></span>
                                <i style="color: rgba(49,191,152);" class="fab fa-google fa-stack-1x"></i>
                            </a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection