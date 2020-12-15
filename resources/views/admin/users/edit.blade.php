@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Mis datos</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.users.update',$user)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <div class="form-group {{$errors->has('name') ? 'has-error':''}}"> 
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="{{old('name',$user->name)}}">
                        {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error':''}}"> 
                        <label for="name">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}">
                        {!!$errors->first('email','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'has-error':''}}"> 
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" class="form-control" placeholder="******">
                        {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'has-error':''}}"> 
                        <label for="password_confirmation">Repite la Contraseña:</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="******">
                        {!!$errors->first('password','<span class="help-block">:message</span>')!!}
                    </div>
                    @if ($user->hasRole('Dueño'))
                    <div class="form-group {{$errors->has('complejo_id') ? 'has-error':''}}">
                        <label>Asignar complejos</label>
                        <select multiple="multiple" name="complejos[]" class="form-control select2">                      
                            @foreach ($complejos as $complejo)
                            <option {{ collect(old('complejos',$user->complejo->pluck('id')))->contains($complejo->id) ? 'selected' : '' }} value="{{$complejo->id}}"
                                >{{$complejo->nombre}}</option>
                            @endforeach
                        </select>
                        {!!$errors->first('complejo_id','<span class="help-block">:message</span>')!!}
                    </div>
                    @endif
                    <button class="btn btn-primary btn-block">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles</h3>
                <div class="box-body">
                    @role('Admin')
                    <form method="POST" action="{{route('admin.users.roles.update',$user)}}">
                        {{ csrf_field() }} {{ method_field('PUT')}}    

                        @include('admin.roles.checkboxes')

                    <button class="btn btn-primary btn-block">Actualizar Roles</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->roles as $role)
                                <li class="list-group-item">{{$role->name}}</li>
                                @empty
                                <li class="list-group-item">No tienes roles asignados</li>
                            @endforelse
                        </ul>
                    @endrole    
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>
                <div class="box-body">
                    @role('Admin')
                    <form method="POST" action="{{route('admin.users.permissions.update',$user)}}">
                        {{ csrf_field() }} {{ method_field('PUT')}}     
                    
                        @include('admin.permissions.checkboxes',['model' => $user])

                    <button class="btn btn-primary btn-block">Actualizar Permisos</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->permissions as $permission)
                                <li class="list-group-item">{{$permission->name}}</li>
                                @empty
                                <li class="list-group-item">No tienes permisos asignados</li>
                            @endforelse
                        </ul>
                    @endrole  
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('styles')
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
<script src="/adminlte/plugins/select2/select2.full.min.js"></script>

<script>
    $(".select2").select2();
</script>
@endpush
    
@endsection