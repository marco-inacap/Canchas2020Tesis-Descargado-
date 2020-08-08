@extends('layout')

@section('content')

<section class="posts container">
	<ul class="container-flex space-center list-unstyled">
		@if (isset($complejo))
		<span>Buscaste por <a class="text-uppercase c-black" style="color: tomato; font-weight:bold; font-size: 22px">{{$complejo->nombre}}.</a> </span>

		@endif
	</ul>
	@foreach ($canchas as $cancha)
	<article class="post">
		@if ($cancha->photos->count() === 1)
		<figure><img src="{{ url($cancha->photos->first()->url) }}" style="width:20px; height:20px;" alt="" class="img-responsive"></figure>
		@elseif($cancha->photos->count() > 1)
		@include('canchas.carousel-preview')
		@elseif($cancha->iframe)
		<div class="video" width="100%" height="480">
			{!! $cancha->iframe !!}
		</div>
		@endif
		<div class="content-post">
			<form action="">
				@include('canchas.header')
				<h1>{{$cancha->nombre}}</h1>
				<div class="divider"></div>
				<p>{!!$cancha->descripcion!!}</p>
				<span>
					@if ($cancha->estado_id === 1)
					<div class="spinner-grow text-danger" role="status"></div>
					<span class="text-danger" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
					@elseif ($cancha->estado_id === 2)
					<div class="spinner-grow text-success" role="status"></div>
					<span class="text-success" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
					@elseif ($cancha->estado_id === 3)
					<div class="spinner-grow text-warning" role="status"></div>
					<span class="text-warning" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
					@endif
				</span>
				<h1 class="text-center" style="color: tomato">${{number_format($cancha->precio,0, ',', '.')}}</h1>
				<footer class="container-flex space-between">
					<div class="read-more">
						<a href="{{	route('canchas.show',$cancha)}}" class="text-uppercase c-green">Ver mas</a>
					</div>
					<div class="tags container-flex">
						<span class="tag c-gray-1 text-capitalize">#</span>
						<span class="tag c-gray-1 text-capitalize">#</span>
						<span class="tag c-gray-1 text-capitalize">#</span>
					</div>
				</footer>
				<div class="span class tag"></div>
		</div>
	</article>
	@endforeach

</section><!-- fin del div.posts.container -->


{{	$canchas->links()	}}
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
	integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
@endpush