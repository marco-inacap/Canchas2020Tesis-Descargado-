<html lang="{{ app()->getLocale() }}">
<nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
    <a class="navbar-brand logo-image" href="{{route('pages.home')}}"><img src="/new/images/logo2.png"
            style="width:50px; height:50px;" alt="alternative"></a>

    <!-- Mobile Menu Toggle Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
    </button>
    <!-- end of mobile menu toggle button -->
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            @if (Auth::user())
                @if (Auth::user()->hasRole(['Admin','Dueño']))
                    <div class="button-container">
                        <a href="{{route('dashboard')}}" class="btn-solid-reg page-scroll">ADMIN</a>
                    </div>
                @endif
            @endif
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#header">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#intro">LO QUE TENEMOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#services">CANCHAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="#callMe">LLAMANOS</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle page-scroll" id="navbarDropdown" role="button" aria-haspopup="true"
                    aria-expanded="false"><i class="fas fa-user fa-stack-1xs"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @guest
                    <a data-toggle="modal" data-target="#LoginModal" class="dropdown-item" href="#"><span
                            class="item-text">INGRESAR</span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a class="dropdown-item" href="{{route('users.register')}}"><span
                            class="item-text">REGISTRARME</span></a>
                    @else
                </div>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{route('pages.mi_perfil',Auth::user()->id )}}" class="dropdown-item"><span class="item-text">{{ Auth::user()->name }} </span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a href="{{route('pages.misreservas')}}" class="dropdown-item"><span class="item-text">Mis
                            reservas</span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item"><span class="item-text">Cerrar sesión</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                @endguest
            </li>
            <!-- end of dropdown menu -->
        </ul>
            {{-- <span class="fa-stack">
                <a id="app-whatsapp" target="_blanck"
                        href="https://api.whatsapp.com/send?phone=+56963732409&amp;text=Hola!&nbsp;me&nbsp;pueden&nbsp;apoyar?">
                        <i class="fab fa-whatsapp"></i>
                    </a>
            </span> --}}
        </span>
    </div>
</nav> <!-- end of navbar -->

{{-- <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form class="form-horizontal" method="POST" action="{{ route('logg') }}">
    {{ csrf_field() }}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="card-body">
                    <h4 class="card-title">LOGIN</h4>
                    <p>Ingresa tu correo y contraseña para autenticarte.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" {{ $errors->has('email') ? 'has-error' : '' }} has-feedback">
                    <input type="email" class="form-control-input" id="email" placeholder="Email" name="email"
                        value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group" {{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password" class="form-control-input" id="password" placeholder="Contraseña"
                        name="password" required>
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
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-solid-lg page-scroll">Ingresar</button>
            </div>
        </div>
    </div>
</form>
</div>  --}}

@include('new.partials.modal-login')


@push('styles')

<style>
    .invalid input:required:invalid {
        background: #BE4C54;
    }

    .invalid input:required:valid {
        background: #17D654;
    }
</style>

@endpush

@push('scripts')

{{-- @if($errors->any())
    <script>
        $('#LoginModal').modal('show');
    </script>
@endif  --}}

@if (session('openLogin') || Session::has('errors'))
        <script>
            $('#LoginModal').modal('show');
        </script>
@endif



<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
 (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

@endpush