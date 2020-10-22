<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <h4 class="card-title">LOGIN</h4>
                <p>Por favor ingresa tu correo y contraseña para ingresar.</p>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="{{ route('logg') }}" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group" {{ $errors->has('email') ? 'has-error' : '' }} has-feedback">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="Correo electronico"
                            required autofocus>
                        <div class="invalid-feedback">
                            Por favor ingrese un correo valido
                        </div>
                        @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group" {{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                            placeholder="Contraseña" required>
                        <div class="invalid-feedback">
                            Por favor ingresa una contraseña
                        </div>
                        @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <span class="fa-stack">
                            <a href="">
                                <span class="hexagon"></span>
                                <i style="color: rgba(66, 104, 173);" class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a class="btn-google" href="{{ url('/auth/redirect/google') }}">
                                <span class="hexagon"></span>
                                <i style="color: rgba(222, 45, 44);" class="fab fa-google fa-stack-1x"></i>
                            </a>
                        </span>
                        <div class="container">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-solid-lg">Ingresar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  