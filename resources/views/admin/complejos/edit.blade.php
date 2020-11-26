@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar {{$complejo->nombre}}</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.complejo.update',$complejo)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{old('nombre',$complejo->nombre)}}">
                        {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('imagen') ? 'has-error':''}}">
                        <label for="imagen">Seleecione una imágen:</label>
                        <input type="file" name="imagen" class="form-control" value="{{old('imagen',$complejo->url_imagen)}}">
                        {!!$errors->first('imagen','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('ubicacion') ? 'has-error':''}}">
                        <label for="ubicacion">Ubicación:</label>
                        <div class="input-group">
                        <input type="text" id="ubicacion" name="ubicacion" placeholder="Peldehue 1847, Osorno" class="form-control" value="{{old('ubicacion',$complejo->ubicacion)}}">
                            <span class="input-group-btn">
                                <a type="submit" id="buscar" onclick="copy_address()" class="btn btn-flat"><i class="fa fa-search"></i></a>
                            </span>
                        </div>
                        {!!$errors->first('ubicacion','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('telefono') ? 'has-error':''}}">
                        <label for="telefono">Nº de contacto:</label>
                        <input type="text" name="telefono" class="form-control"
                            value="{{old('telefono',$complejo->telefono)}}">
                        {!!$errors->first('telefono','<span class="help-block">:message</span>')!!}
                    </div>
                    <button class="btn btn-primary btn-block">Actualizar</button>
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
                                class="form-control" value="{{old('latitude',$complejo->latitude)}}">
                            {!!$errors->first('latitude','<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('longitude') ? 'has-error':''}}">
                            <label for="longitude">Longitud:</label>
                            <input id="longitude" type="text" name="longitude" placeholder="-73.172091"
                                class="form-control" value="{{old('longitude',$complejo->longitude)}}">
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
        box-shadow: 5px 5px 5px #888;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="/adminlte/js/Control.OSMGeocoder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>

        
        var mapCenter = [{{ $complejo->latitude }}, {{ $complejo->longitude }}];
        var mapid = L.map('mapid').setView(mapCenter, 15);

        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
        }).addTo(mapid);

        L.control.scale().addTo(mapid);

        var osmGeocoder = new L.Control.OSMGeocoder({placeholder: 'Buscar ubicación...'});
        mapid.addControl(osmGeocoder);

        var marker = L.marker(mapCenter).addTo(mapid);

        marker.bindPopup("<b>{{$complejo->nombre}}</b><br>{{$complejo->telefono}}.").openPopup();


        function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Tu seleccionaste:  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    

    mapid.on('click', function(e) {
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

    function copy_address() {
    
    document.getElementById('buscador').value = document.getElementById('ubicacion').value;

    document.getElementById("ir").click();
}

    </script>

@endpush