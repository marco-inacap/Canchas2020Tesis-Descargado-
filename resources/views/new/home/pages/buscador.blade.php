<div class="col-lg-12">
    @foreach ($canchas as $cancha)
    <div class="card">
        <div class="card-image">
            <img class="img-fluid img-responsive" style="width: 600px; height: 200px;" src="{{ url($cancha->photos->first()->url) }}"
                alt="alternative">
        </div>
        <div class="card-body">
            <h3 class="card-title">{{$cancha->nombre}}</h3>
            <p>{{$cancha->descripcion}}</p>
            <ul class="list-unstyled li-space-lg">
                <li class="media">
                    <i class="fas fa-square"></i>
                    <div class="media-body">Nº Reservas: {{count($cancha->complejo->reservas)}}</div>
                </li>
                <li class="media">
                    <i class="fas fa-square"></i>
                    <a href="{{route('complejos.show', $cancha->complejo)}}">
                        <div class="media-body">{{$cancha->complejo->nombre}}</div>
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
</div>