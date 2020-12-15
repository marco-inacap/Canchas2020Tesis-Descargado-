@extends('new.layout2')

@section('content')

<!-- Contact -->
<div class="slider">
    <div class="container">
        <div class="row">
            <div style="width: auto; margin: auto auto;" class="col-lg-6">
                <!-- Contact Form -->
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="profile-user-img img-responsive img-circle" style="width:80px; height:80px;"
                                src="" onerror="this.src='/img/logo.png';">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Mis datos</h5>
                                <p class="card-text"><b>Nombre:</b>&nbsp;&nbsp; {{$user->name}}</p>
                                <p class="card-text"><b>Email:</b>&nbsp;&nbsp; {{$user->email}}</p>
                                <p class="card-text"><b>Reservas en total:<a
                                            style="text-decoration: none; color: #222d32;"
                                            href="{{route('pages.misreservas')}}"></b>&nbsp;{{$n_reservas}}</p></a>
                                <p class="card-text"><b>Desde
                                        {{Carbon\Carbon::parse($user->created_at)->isoFormat('DD-MMMM-YYYY')}}</b></p>
                            </div>
                            <br>
                                <a class="btn-outline-reg" href="{{route('pages.mi_perfil.editar',$user)}}">Editar mis datos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end of contact form -->

@endsection