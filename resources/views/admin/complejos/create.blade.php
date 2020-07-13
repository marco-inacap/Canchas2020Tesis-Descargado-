@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Crear complejo</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.complejo.store')}}">
                    {{ csrf_field() }}
                    
                    <div class="form-group {{$errors->has('nombre') ? 'has-error':''}}"> 
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
                        {!!$errors->first('nombre','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('ubicacion') ? 'has-error':''}}"> 
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" name="ubicacion" class="form-control" value="{{old('ubicacion')}}">
                        {!!$errors->first('ubicacion','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('telefono') ? 'has-error':''}}"> 
                        <label for="telefono">Nº de contacto:</label>
                        <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}">
                        {!!$errors->first('telefono','<span class="help-block">:message</span>')!!}
                    </div>
                    <button class="btn btn-primary btn-block">Crear complejo</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection