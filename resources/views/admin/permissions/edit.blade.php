@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Permiso</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                    {{ csrf_field() }}  {{ method_field('PUT')}} 
                   
                   <div class="form-group"> 
                    <label for="name">Nombre Identificador:</label>
                    <input class="form-control" value="{{ $permission->name}}" disabled>
                </div>

                    <div class="form-group {{$errors->has('display_name') ? 'has-error':''}}"> 
                        <label for="display_name">Nombre:</label>
                        <input type="text" name="display_name" class="form-control" value="{{old('display_name',$permission->display_name)}}">
                        {!!$errors->first('display_name','<span class="help-block">:message</span>')!!}
                    </div>


                    <button class="btn btn-primary btn-block">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection