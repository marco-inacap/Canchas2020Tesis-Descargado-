@extends('admin.layout')

@section('content')

<div class="row">
    <form method="POST" action="{{route('admin.users.store')}}">
        {{ csrf_field() }}
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos Personales</h3>
            </div>
            <div class="box-body">
                
                    <div class="form-group {{$errors->has('name') ? 'has-error':''}}"> 
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                        {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error':''}}"> 
                        <label for="name">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
                        <span class="help-block">La contraseña se enviará al email</span>
                        {!!$errors->first('email','<span class="help-block">:message</span>')!!}
                    </div>

                    <div class="form-group col-md-6">
                        <label>Roles</label>
                        @include('admin.roles.checkboxes')
                    </div>

                    <div class="form-group col-md-6">
                        <label>Permisos</label>
                    @include('admin.permissions.checkboxes',['model' => $user])
                    </div>
            </div>             
        </div>
    </div> 
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
                        <label>Complejo (Si no existe agregalo)</label>
                        <select multiple="multiple" name="complejos[]" class="form-control select2">   
                            <option value="">
                            Seleeciona el nombre de tu complejo </option>                    
                            @foreach ($complejos as $complejo)
                            <option value="{{$complejo->id}}"
                                {{old('complejo_id',$user->complejo_id) == $complejo->id ? 'selected' : ''}}
                                >{{$complejo->nombre}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
                    </div>
                </div>
                {{-- <div class="box-body">
                    <div class="form-group">
                        <label>Seleccione Horarios</label>
                        @foreach ($horarios as $horario)
                            <div class="checkbox">
                                <label>
                                    <input name="horario[]" type="checkbox" value="{{$horario->hora_inicio,$horario->hora_fin}}">
                                        {{$horario->hora_inicio}} a {{$horario->hora_fin}} 
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
                <button class="btn btn-primary btn-block">Crear</button>
            </div>
        </div>
    </form>
</div>

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/bootstrapformhelpers/bootstrap-formhelpers.css">
@endpush
@push('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="/bootstrapformhelpers/bootstrap-formhelpers.js"></script>

<script>

    $(".select2").select2();
    CKEDITOR.replace('editor');

</script>
@endpush


@endsection