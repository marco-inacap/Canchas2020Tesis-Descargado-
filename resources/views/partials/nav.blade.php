<html lang="{{ app()->getLocale() }}">
<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">
        <li><a href="{{ route('pages.home') }}"
                class="text-uppercase {{ request()->routeIs('pages.home') ? 'active' : ''}}">Inicio</a></li>
        @if (Auth::user() == true)
        <li><a href="{{ route('pages.misreservas') }}"
                class="text-uppercase {{ request()->routeIs('pages.misreservas') ? 'active' : ''}}">Mis Reservas</a>
        </li>
        @endif
        <li><a href="{{ route('complejos_map.index') }}"
                class="text-uppercase {{ request()->routeIs('complejos_map.index') ? 'active' : ''}}">Complejos</a></li>
        <li><a href="{{ route('pages.contacto') }}"
                class="text-uppercase {{ request()->routeIs('pages.contacto') ? 'active' : ''}}">Contacto</a></li>

        @role('Admin|Dueño')
        <li><a href="{{ route('dashboard') }}"
                class="text-uppercase {{ request()->routeIs('dashboard') ? 'active' : ''}}"
                style="color: red;">ADMIN</a></li>
        @endrole
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
            <li>
                <a href="{{ route('loginuser') }}"
                    class="text-uppercase {{ request()->routeIs('loginuser') ? 'active' : ''}}">Login</a>
            </li>
            <li>
                <a href="{{ route('users.register') }}"
                    class="text-uppercase {{ request()->routeIs('users.register') ? 'active' : ''}}">Registrarme</a>
            </li>
            @else
            <li class="dropdown">
                <a href="#" class="text-uppercase" data-toggle="dropdown" role="button" aria-expanded="false"
                    aria-haspopup="true" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endguest
        </ul>
    </ul>
</nav>