@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Crear complejo</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.complejo.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
                        {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('imagen') ? 'has-error':''}}">
                        <label for="imagen">Seleecione una imágen:</label>
                        <img id="img" src="#" class="profile-user-img img-responsive img-circle" style="width:80px; height:80px;" alt="Imágen" >
                        <input type="file" name="imagen" id="imagen" class="form-control" value="{{old('imagen')}}">
                        {!!$errors->first('imagen','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('ubicacion') ? 'has-error':''}}">
                        <label for="ubicacion">Ubicación:</label>
                        <div class="input-group">
                        <input type="text" name="ubicacion" class="form-control" value="{{old('ubicacion')}}">
                        <span class="input-group-btn">
                            <a type="submit" id="buscar" class="btn btn-flat"><i class="fa fa-search"></i></a>
                        </span>
                        </div>
                        {!!$errors->first('ubicacion','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('telefono') ? 'has-error':''}}">
                        <label for="telefono">Nº de contacto:</label>
                        <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}" placeholder="+569 63732409">
                        {!!$errors->first('telefono','<span class="help-block">:message</span>')!!}
                    </div>
                    <button class="btn btn-primary btn-block">Crear complejo</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-body">
                <p>Mueve tu ubicación para mejor presición en el mapa.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('latitude') ? 'has-error':''}}">
                            <label for="latitude">Latitud:</label>
                            <input id="latitude" type="text" name="latitude" placeholder="-40.569770"
                                class="form-control" value="{{old('latitude')}}">
                            {!!$errors->first('latitude','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('longitude') ? 'has-error':''}}">
                            <label for="longitude">Longitud:</label>
                            <input id="longitude" type="text" name="longitude" placeholder="-73.172091"
                                class="form-control" value="{{old('longitude')}}">
                            {!!$errors->first('longitude','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-warning">
            <div class="box-body">
                <label for="ubicacion">Ubicación:</label>
                <div class="form-group">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />

<style>
    #mapid {
        height: 300px;
        box-shadow: 1px 1px 5px #888;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="/adminlte/js/Control.OSMGeocoder.js"></script>

<script>
        var map = L.map('mapid').setView([15.413083, -66.2136067], 3);
        var marker_actual; 
        var browserLat;
        var browserLong; 

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map); 

            L.control.scale().addTo(map);

        /*    $('#buscar').on('click', function(){

                var osmGeocoder = new L.Control.OSMGeocoder({placeholder: 'Buscar ubicación...'});
                map.addControl(osmGeocoder);
            }); */

           
                var osmGeocoder = new L.Control.OSMGeocoder({placeholder: 'Buscar ubicación...'});
                map.addControl(osmGeocoder);
           

            

            function updateMarker(lat, lng) {
                
                marker_actual
                .setLatLng([lat, lng])
                .bindPopup("Tu seleccionaste:  " + marker_actual.getLatLng().toString())
                .openPopup();
                return false;
            };
            

            navigator.geolocation.getCurrentPosition(function(position) {
            browserLat =  position.coords.latitude;
            browserLong = position.coords.longitude;

            marker_actual = L.marker([browserLat,browserLong]).addTo(map);
            marker_actual.bindPopup('<b>Hola ! </b><br>Tu estas aqui').openPopup();
            map.setView([browserLat,browserLong], 16);  
            
        }, function(err) {
            console.error(err);
        });

        map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }

    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);


    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imagen").change(function(){
    readURL(this);
});

</script>
@endpush