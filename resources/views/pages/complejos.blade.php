@extends('layout')

@section('content')

<div class="row">
    <div class="col-12">

    </div>

</div>

<section class="footer">
    <div class="page page-mapa">
        <div class="img-responsive" id="mapid"></div>
    </div>
</section>

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