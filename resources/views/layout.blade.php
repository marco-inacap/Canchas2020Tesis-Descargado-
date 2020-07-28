<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('meta-title','SuCancha')</title>
	<meta name="description" content="@yield('meta-description', 'Arrienda Tus Canchas')">
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	@stack('styles')
</head>

<body>
	<div id="app">
	<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<a href="{{route('pages.home')}}" class="logo"><img src="/img/logo.png" alt="" style="width:50px; height:50px;"></a>
			@include('partials.nav')
		</div>
    </header>

    @yield('content')
    
    <section class="footer">
		<footer>
			<div class="container">
				<figure class="logo"><img src="/img/logo.png" alt=""></figure>
				<nav>
					<ul class="container-flex space-center list-unstyled">
						<li><a href="{{route('pages.home')}}" class="text-uppercase c-white">Inicio</a></li>
						<li><a href="{{route('pages.misreservas')}}" class="text-uppercase c-white">Mis Reservas</a></li>
						<li><a href="{{route('complejos_map.index')}}" class="text-uppercase c-white">Complejos</a></li>
						<li><a href="{{route('pages.contacto')}}" class="text-uppercase c-white">Contacto</a></li>
					</ul>
				</nav>
				<div class="divider-2"></div>
				<p>Hola po olvidona</p>
				<div class="divider-2" style="width: 80%;"></div>
				<p>© 2020 - Marco González. Todos los derechos reservados by <span class="c-white">Marco González</span></p>
				<ul class="social-media-footer list-unstyled">
					<li><a href="#" class="fb"></a></li>
					<li><a href="#" class="tw"></a></li>
					<li><a href="#" class="in"></a></li>
					<li><a href="#" class="pn"></a></li>
				</ul>
			</div>
		</footer>
	
	</section>
</div>
	
	<script src="{{ mix('js/app.js')}}"></script>
	@stack('scripts')

</body>
</html>