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
                        <img class="img-fluid img-responsive" src="{{ url($cancha->photos->first()->url) }}"
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
                        <p class="price">Precio <span>$ {{number_format($cancha->precio,0, ',', '.')}}</span></p>
                    </div>
                    <div class="button-container">
                        {{-- <a  href="" data-toggle="modal" data-target="#modalRedireccion" class="btn-solid-reg page-scroll">Reservar</a> --}}
                        <a href="{{route('reservar.cancha',$cancha)}}" class="btn-solid-reg page-scroll">Reservar</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{route('pages.todaslascanchas')}}" class="section-title text-center">VER
                        MÁS</a>
                </div>
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