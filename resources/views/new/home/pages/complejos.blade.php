@extends('new.layout2')

@section('content')

<header id="header" class="header3">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h1>COMPLEJOS</h1>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->

<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Los complejos registrados en nuestro sitio</h2>
                <p class="p-heading">Si quieres buscar canchas de un complejo, solo selecciona su imágen.</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Card Slider -->
                <div class="slider-container">
                    <div class="swiper-container card-slider">
                        <div class="swiper-wrapper">
                            @foreach ($complejos as $complejo)
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="{{route('complejos.show', $complejo->url)}}"><img class="card-image" src="{{ url($complejo->url_imagen) }}" onerror="this.src='/img/logo.png';" alt="alternative"></a>
                                    <div class="card-body">
                                        <div class="testimonial-text">{{$complejo->ubicacion}}</div>
                                        <div class="testimonial-author">{{$complejo->nombre}}</div>
                                        <div class="testimonial-text">+56 {{$complejo->telefono}}</div>
                                    </div>
                                </div>        
                            </div>  
                            @endforeach                     
                        </div> 
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>    
                    </div> <!-- end of swiper-container -->
                </div> <!-- end of sliedr-container -->
                <!-- end of card slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider -->

<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Ubicación de nuestros complejos</h2>
                <p class="p-heading">Selecciona el complejo y obtendras todas sus canchas.</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="img-responsive" id="mapid"></div>
        </div>
    </div>
</div>

@endsection

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />

<style>
    #mapid {

        height: 400px;
        width: 1280px;

    }
</style>
    
@endpush

@push('scripts')

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var map = L.map('mapid').setView([15.413083, -66.2136067], 3);
            var marker_actual; 
            var browserLat;
            var browserLong; 
    
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map); 
    
                L.control.scale().addTo(map);
    
                navigator.geolocation.getCurrentPosition(function(position) {
                browserLat =  position.coords.latitude;
                browserLong = position.coords.longitude;
                var greenIcon = new L.Icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
    
                marker_actual = L.marker([browserLat,browserLong],{icon: greenIcon}).addTo(map);
                marker_actual.bindPopup('<b>Hola! </b><br>Tu estas aquí').openPopup();
                map.setView([browserLat,browserLong], 13);  
                
            }, function(err) {
                console.error(err);
            });
    
            axios.get('{{ route('api.complejos.index') }}')
        .then(function (response) {
            L.geoJSON(response.data, {
                pointToLayer: function(geoJsonPoint, latlng) {
                    return L.marker(latlng);
                }
            })
            .bindPopup(function (layer) {
                return layer.feature.properties.map_popup_content;
            }).addTo(map);
        })
        .catch(function (error) {
            console.log(error);
        });
    
    </script>

@endpush