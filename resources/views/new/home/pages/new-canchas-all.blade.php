@foreach ($canchas as $cancha)
<div class="card">
    <div class="card-image">
        @if ($cancha->photos->count() === 0)
        <img class="img-fluid img-responsive img-circle" style="width: 600px; height: 200px;"  src="/img/sin-imagen.png" alt="alternative" onerror="this.src='/img/logo.png';">
        @elseif ($cancha->photos->count() === 1)
            <img class="img-fluid img-responsive" style="width: 600px; height: 300px;"  src="{{ url($cancha->photos->first()->url) }}" alt="alternative" onerror="this.src='/img/logo.png';">
        @elseif($cancha->photos->count() > 1)
            @include('new.home.carousel-2')
        @endif
    </div>
    <div class="card-body">
        <h3 class="card-title">{{$cancha->nombre}}</h3>
        <p>{{$cancha->descripcion}}</p>
        <ul class="list-unstyled li-space-lg">
            <li class="media">
                <i class="fas fa-square"></i>
                <div class="media-body"><b>{{count($cancha->reservas->where('status','=',13))}}</b> reservas</div>
            </li>
            <li class="media">
                <i class="fas fa-square"></i>
                <a href="{{route('complejos.show', $cancha->complejo)}}">
                    <div class="media-body"><b>{{$cancha->complejo->nombre}}</b></div>
                </a>
            </li>
            <li class="media">
                <i class="fas fa-square"></i>
                <div class="media-body">{{$cancha->complejo->ubicacion}}</div>
            </li>
        </ul>
        <p class="price">Precio <span>${{number_format($cancha->precio,0, ',', '.')}}</span></p>
    </div>
    <div class="button-container">
        <a class="btn-solid-reg page-scroll" href="{{route('reservar.cancha',$cancha)}}">Reservar</a>
    </div>
</div>
@endforeach