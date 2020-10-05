@extends('new.layout2')

@section('content')

{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Recuperar contraseña</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Ingrese su E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar solicitud de recuperación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!-- Call Me -->
<div id="callMe" class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">Recuperación de contraseña</div>
                    <h2 class="white">Te olvidaste de tu contraseña?<br></h2>
                    <p class="white">Pasos:</p>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Ingrese su E-mail y haga click en ENVIAR</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Verifica en tu E-mail el correo que te hemos enviado</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Sigue los pasos para crear una nueva contraseña</div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->
            
            <div class="col-lg-6">
                <!-- Call Me Form -->
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control-input" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
                        @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">ENVIAR</button>
                    </div>
                    <div class="form-message">
                        <div id="lmsgSubmit" class="h3 text-center hidden"></div>
                    </div>
                </form>
                <!-- end of call me form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of call me -->
@endsection
