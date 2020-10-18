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
                    <!-- buscador -->
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input id="texto" class="form-control search-slt" type="text"
                                    placeholder="Buscar por cancha o precio...">
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
        <div class="row contenedor">
            <div class="basic-1">
                <div class="col-lg-12">
                    <div id="resultados"></div>
                    <div class="progress" style="height: 1px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="row contenedor">
            <div id="canchas" class="col-lg-12">
                {{-- @include('new.home.pages.buscador') --}}
                @include('new.home.pages.pagination') 
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


<script>
    
    window.addEventListener("load",function(){
    document.getElementById("texto").addEventListener("keyup",function(){
        if((document.getElementById("texto").value.length)>=3)
            fetch(`/canchitas/buscador?texto=${document.getElementById("texto").value}`,{
            method:'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
        else
            document.getElementById("resultados").innerHTML = ""
    });
});


let page = 2;
        window.onscroll = () => {
            if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
                const section = document.getElementById('canchas');
                
                // Pedir al servidor
                fetch(`/su-cancha-canchas/pagination?page=${page}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(htmlContent => {
                    // Respuesta en HTML
                    console.log(htmlContent);
                    section.innerHTML += htmlContent;
                    page += 1;
                })
                .catch(err => console.log(err));                                
            }
        };

</script>
@endpush