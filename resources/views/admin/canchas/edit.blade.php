@extends('admin.layout')

@section('header')

<h1>
    Canchas
    <small>Crear nueva Cancha</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{route('admin.cancha.index')}}"><i class="fa fa-list"></i> Canchas</a></li>
    <li class="active">Crear</li>
</ol>
@endsection

@section('content')
<div class="row">
    @if ($cancha->photos->count())
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    @foreach ($cancha->photos as $photo)
                    <form method="POST" action="{{route('admin.photos.destroy',$photo)}}">
                        {{  method_field('DELETE')}} {{csrf_field()}}
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-xs" style="position: absolute"> <i
                                    class="fa fa-remove"></i></button>
                            <img class="img-responsive" style="width:90%; max-height:100px" src="{{url($photo->url)}}"
                                alt="">
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    <form method="POST" action="{{route('admin.cancha.update',$cancha)}}">
        {{ csrf_field() }} {{ method_field('PUT') }}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear una Cancha</h3>
                </div>


                <div class="box-body">
                    <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}">
                        <label>Nombre de la Cancha </label>
                        <input name="nombre" type="text" class="form-control"
                            placeholder="Ingresa aquí el nombre de la Cancha"
                            value="{{old('nombre', $cancha->nombre)}}">
                        {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->has('precio') ? 'has-error':''}}">
                        <label>Precio de la Cancha </label>
                        <input name="precio" type="number" class="form-control"
                            placeholder="Ingresa aquí el precio de la Cancha" value="{{old('precio',$cancha->precio)}}">
                        {!!$errors->first('precio','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Descripción de la Cancha </label>
                        <textarea id="editor" name="descripcion" class="form-control"
                            placeholder="Ingresa aquí alguna descripción de la Cancha">{{old('descripcion',$cancha->descripcion)}}</textarea>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{$errors->has('iframe') ? 'has-error':''}}">
                        <label>Ingresa un link de Youtube</label>
                        <input name="iframe" type="text" class="form-control" placeholder='width="100%" height="480"'
                            value="{{old('iframe', $cancha->iframe)}}">
                        {!!$errors->first('iframe','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
            </div>
        </div>
        <!-- segunda -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
                        <label>Complejo</label>
                        <select name="complejo_id" class="form-control select2">
                            <option value="">
                                Seleeciona un Complejo </option>
                            @foreach ($complejos as $complejo)
                            <option value="{{$complejo->id}}"
                                {{old('complejo_id',$cancha->complejo_id) == $complejo->id ? 'selected' : ''}}>
                                {{$complejo->nombre}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('estado_id') ? 'has-error':''}}">
                        <label>Estado</label>
                        <select name="estado_id" class="form-control select2">
                            <option value="">
                                Seleeciona un Estado </option>
                            @foreach ($estados as $estado)
                            <option value="{{$estado->id}}"
                                {{old('estado_id',$cancha->estado_id) == $estado->id ? 'selected' : ''}}>
                                {{$estado->nombre}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first('estado_id','<span class="help-block">:message</span>')!!}
                    </div>

                    <div class="form-group">
                        <p>Por favor selecciona un color, para que se identifique en el calendario de reservas.</p>
                        <i>(No colores tan fuertes)</i>

                        <input type="color" name="color" class="center-block" value="{{old('color',$cancha->color)}}">
                    </div>

                    <div class="dropzone">
                    </div>


                    <div class="form-group">
                        <button id="guardar" name="guardar" class="btn btn-primary btn-block">Guardar Cancha</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/bootstrapformhelpers/bootstrap-formhelpers.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="/bootstrapformhelpers/bootstrap-formhelpers.js"></script>

<script>
    $(".select2").select2();
    CKEDITOR.replace('editor');


     
    var myDropzone = new Dropzone('.dropzone',{

        url: '/admin/canchas/{{ $cancha->url}}/photos',
        paramName: 'photo',
        acceptedFiles: 'image/*',
        maxFilesize: 2, //mb
        headers:{
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        dictDefaultMessage: 'Arrastra las imágenes aquí',

    });
    myDropzone.on('error', function(file, res){
        var msg = res.photo[0];
        $('.dz-error-message:last > span').text(msg);
       
    }); 
    Dropzone.autoDiscover = false;
</script>

@endpush
@endsection