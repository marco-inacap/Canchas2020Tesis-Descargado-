@extends('new.layout2')

@section('content')

<header id="header" class="header2">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h1>TODAS TODITAS!</h1>
                    </div>

                    <!-- search -->
                    <div class="row no-gutters custom-search-input-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="custom-select-form">
                                    <select name="complejo_id" class="w-100 " name="city" id="city">
                                        <option value="">
                                            Seleeciona un Complejo </option>
                                        @isset($complejos)
                                        @foreach ($complejos as $complejo)
                                        <option value="{{$complejo->id}}">
                                            {{$complejo->nombre}}
                                        </option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input class="form-control search-slt" type="date" name="dates"
                                    placeholder="Seleccione fecha">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input class="form-control search-slt" type="time" name="dates"
                                    placeholder="Seleccione hora">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn_search btn btn-danger wrn-btn ripple"><span>BUSCAR
                                </span></button>
                        </div>
                    </div>

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->

<div id="services" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">CANCHAS</div>
                @if (isset($complejo))
                <a href="{{route('pages.todaslascanchas')}}">
                    <div class="section">Volver</div>
                </a>
                <p class="p-heading">Buscaste por</p>
                <h2>{{$complejo->nombre}}</h2>
                @endif
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



@endsection

@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet"
    href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=1.0">
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
<link rel="stylesheet" href="/search/styles.css">

@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script
    src="https://www.jqueryscript.net/demo/Customizable-Animated-Dropdown-Plugin-with-jQuery-CSS3-Nice-Select/js/jquery.nice-select.js">
</script>
<script src="/search/search.js"></script>
@endpush