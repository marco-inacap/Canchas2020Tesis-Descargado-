@extends('new.layout2')

@section('content')
<div class="counter">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xl-6">
                <div class="image-container">
                    @if ($cancha->photos->count() === 1)
                    <figure><img src="{{ $cancha->photos->first()->url }}" alt="" class="img-fluid img-responsive">
                    </figure>
                    @elseif($cancha->photos->count() > 1)
                    @include('canchas.carousel')
                    @elseif($cancha->iframe)
                    <div class="video" width="100%" height="480">
                        {!! $cancha->iframe !!}
                    </div>
                    @endif
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6 col-xl-6">
                <div class="text-container">
                    <div class="section-title">RESERVA</div>
                    <div class="card wizard-card" data-color="orange" id="wizardProfile">
                        <form action="" method="">
                            <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

                            <div class="wizard-header text-center">
                                <h3 class="wizard-title">Metodo rápido de reserva.</h3>
                                <p class="category">Reservando {{$cancha->nombre}}</p>
                            </div>

                            <div class="wizard-navigation">
                                <div class="progress-with-circle">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1"
                                        aria-valuemax="3" style="width: 21%;"></div>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#about" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-agenda"></i>
                                            </div>
                                            Fecha
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#account" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-time"></i>
                                            </div>
                                            Horario
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#address" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-money"></i>
                                            </div>
                                            Address
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Seleccione Fecha</label>
                                                <input name="firstname" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <h5 class="info-text">Seleccione hora</h5>
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-offset-2">
                                            <div class="col-sm-4">
                                            <input type="checkbox">19:00
                                            <input type="checkbox">17:00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="address">
                                    <h5 class="info-text">Metodo de pago</h5>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="col-sm-4">
                                                <div class="choice" data-toggle="wizard-checkbox">
                                                    <input type="checkbox" name="jobb" value="Design">
                                                    <div class="card card-checkboxes card-hover-effect">
                                                        <i class="ti-money"></i>
                                                        <p>Webpay</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next'
                                        value='Siguiente' />
                                    <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd'
                                        name='finish' value='Reservar' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous'
                                        value='Anterior' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>



                    <!-- Counter -->
                    <div id="counter">
                        <div class="cell">
                            <div class="counter-value number-count" data-count="{{$cancha->total_visitas}}">1</div>
                            <div class="counter-info">Total<br>Visitas</div>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" data-count="121">1</div>
                            <div class="counter-info">Nº<br>Reservas</div>
                        </div>
                    </div>
                    <!-- end of counter -->
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of counter -->
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">

<!--   modal reserva   -->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="/assets/css/demo.css" rel="stylesheet" />
<link href="/assets/css/themify-icons.css" rel="stylesheet">
</head>
@endpush


@push('scripts')
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="/js/twitter-bootstrap.js"></script>


<!--   modal reserva   -->
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="/assets/js/demo.js" type="text/javascript"></script>
<script src="/assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="/assets/js/jquery.validate.min.js" type="text/javascript"></script>
@endpush