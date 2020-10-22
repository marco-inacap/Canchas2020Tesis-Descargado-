<div id="services" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">CANCHAS</div>
                <h2>Las 6 canchas más visitadas</h2>
            </div>
        </div>
        <div class="row contenedor">
            <div class="col-lg-12">
                @foreach ($canchas as $cancha)
                <div class="card">
                    <div class="card-image">
                        @if ($cancha->photos->count() === 0)
                        <img class="img-fluid img-responsive img-circle" style="width: 600px; height: 200px;"  src="/img/sin-imagen.png" alt="alternative" onerror="this.src='/img/logo.png';">
                        @elseif ($cancha->photos->count() === 1)
                            <img class="img-fluid img-responsive" style="width: 600px; height: 200px;"  src="{{ url($cancha->photos->first()->url) }}" alt="alternative" onerror="this.src='/img/logo.png';">
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
                        {{-- <a  href="" data-toggle="modal" data-target="#modalRedireccion" class="btn-solid-reg page-scroll">Reservar</a>  --}}
                        <a href="{{route('reservar.cancha',$cancha)}}" class="btn-solid-reg page-scroll">Reservar</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('pages.todaslascanchas')}}" class="btn btn-solid-reg-vermas btn-lg btn-block"><b class="text-center">VER TODAS</b></a>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalRedireccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selecciona el proceso de reserva que quieres</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="button-container">
                    <div class="row center">
                        <div class="col-md-6">
                            <a href="{{route('newReserva.init',$cancha)}}" class="btn-solid-reg page-scroll">Modo
                                rápido</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('reservar.cancha',$cancha)}}" class="btn-solid-reg page-scroll">Con
                                Calendario</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>