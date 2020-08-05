<div id="services" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">CANCHAS</div>
                <h2>Las 6 canchas más reservadas</h2>
            </div>
        </div>
        <div class="row contenedor">
            <div class="col-lg-12">
                @foreach ($canchas as $cancha)
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid img-responsive" src="{{ url($cancha->photos->first()->url) }}" alt="alternative">
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
                                <div class="media-body">{{$cancha->complejo->nombre}}</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">{{$cancha->complejo->ubicacion}}</div>
                            </li>
                        </ul>
                        <p class="price">Precio <span>$ {{number_format($cancha->precio,0, ',', '.')}}</span></p>
                    </div>
                    <div class="button-container">
                        <a class="btn-solid-reg page-scroll" href="#callMe">Reservar</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="" class="section-title text-center">VER MÁS</a>
                </div>
            </div>
        </div>
    </div>
</div>

