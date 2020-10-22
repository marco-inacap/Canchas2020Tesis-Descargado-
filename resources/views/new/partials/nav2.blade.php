<nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
    <a class="navbar-brand logo-image"  href="{{route('pages.home')}}"><img src="/new/images/logo2.png" style="width:50px; height:50px;" alt="alternative"></a>
    
    <!-- Mobile Menu Toggle Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link page-scroll" href="{{route('pages.home')}}">HOME <span class="sr-only">(current)</span></a>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle page-scroll" href="{{route('pages.todosloscomplejos')}}" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">COMPLEJOS</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($complejos as $complejo)
                        <a class="dropdown-item" href="{{route('complejos.show', $complejo)}}"><span class="item-text">{{$complejo->nombre}}</span></a>
                        <div class="dropdown-items-divide-hr"></div>
                    @endforeach
                </div> 
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">OSORNO SOCCER</span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">MATICES</span></a>
                        
                </div>
            </li> --}}
            <li class="nav-item">
                <a href="{{route('pages.todosloscomplejos')}}" class="nav-link page-scroll" href="#services">COMPLEJOS</a>
            </li>
            <li class="nav-item">
                <a href="{{route('pages.todaslascanchas')}}" class="nav-link page-scroll" href="#services">CANCHAS</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle page-scroll" id="navbarDropdown" role="button" aria-haspopup="true"
                    aria-expanded="false"><i class="fas fa-user fa-stack-1xs"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @guest
                    <a data-toggle="modal" data-target="#LoginModal" class="dropdown-item" href="#"><span class="item-text">INGRESAR</span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a class="dropdown-item" href="{{route('users.register')}}"><span
                            class="item-text">REGISTRARME</span></a>
                    @else
                </div>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="" class="dropdown-item"><span class="item-text">{{ Auth::user()->name }} </span></a>
                    <div class="dropdown-items-divide-hr"></div>
                    <a href="{{route('pages.misreservas')}}" class="dropdown-item"><span class="item-text">Mis reservas</span></a>
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
        </ul>
        <span class="nav-item social-icons">
            <span class="fa-stack">
                <a href="#your-link">
                    <span class="hexagon"></span>
                    <i class="fab fa-facebook-f fa-stack-1x"></i>
                </a>
            </span>
            <span class="fa-stack">
                <a href="#your-link">
                    <span class="hexagon"></span>
                    <i class="fab fa-instagram fa-stack-1x"></i>
                </a>
            </span>
        </span>
    </div>
</nav>

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

@if($errors->any())
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