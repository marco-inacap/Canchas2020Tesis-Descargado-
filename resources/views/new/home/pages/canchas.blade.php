@extends('new.layout2')

@section('content')

<header id="header" class="header2">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h1>TODAS LAS CANCHAS</h1>
                        <p class="p-heading p-large">Buscala!</p>
                    </div>
                    <form action="{{route('pages.buscador')}}" method="GET">
                        <div class="row no-gutters custom-search-input-2">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <div class="custom-select-form">
                                        <select name="complejo" class="w-100 " id="city" required>
                                            <option value="">
                                                Seleeciona un Complejo </option>
                                            @isset($complejos)
                                            @foreach ($complejos as $complejo)
                                            <option value="{{$complejo->id}}"
                                                {{old('complejo',$complejo_req) == $complejo->id ? 'selected' : ''}}>
                                                {{$complejo->nombre}}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="submit"
                                    class="btn_search btn btn-danger wrn-btn ripple"><span>BUSCAR</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="cards-2">
    <div class="container">
        @if (session()->has('alert'))
        <div class="alert alert-light" role="alert">
            {{ session('alert')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div @if (Request::url() !=route('pages.buscador')) class="active" style="display: none;" @endif>
            <a class="nav-link" href="{{route('pages.todaslascanchas')}}"><i class="fa fa-arrow-circle-left fa-lg"
                    aria-hidden="true" style="color:#14bf98; width:6; height:6;"></i>&nbsp;Volver a todas las
                canchas</a>
        </div>
        <br>
        <div class="row">
            <div id="canchas-data" class="col-lg-12">
                @include('new.home.pages.new-canchas-all')
                {{$canchas->appends(Request::all())->links()}}
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

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script
    src="https://www.jqueryscript.net/demo/Customizable-Animated-Dropdown-Plugin-with-jQuery-CSS3-Nice-Select/js/jquery.nice-select.js">
</script>
<script src="/search/search.js"></script>

@endpush