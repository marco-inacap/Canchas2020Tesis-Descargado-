@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            <img class="profile-user-img img-responsive img-circle" src="/img/logo.png" alt="{{$user->name}}">
            <div class="box-body">
                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->getRoleNames()->implode(' - ')}}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{$user->email}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nº de Complejos </b> <a class="pull-right">{{count($user->complejo)}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nº de Canchas </b> <a class="pull-right">{{count($user->cancha)}}</a>
                    </li>
                    @if ($user->roles->count())
                    <li class="list-group-item">
                        <b>Roles</b> <a class="pull-right">{{$user->getRoleNames()->implode(' - ')}}</a>
                    </li>
                    @endif
                </ul>
                <a href="{{route('admin.users.edit', $user)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            <h3 class="box-title">Roles</h3>
            <div class="box-body">
                @forelse ($user->roles as $role)
                <strong>{{$role->name}}</strong>
                @if ($role->permissions->count())
                <br>
                <small class="text-muted">Permisos: {{$role->permissions->pluck('name')->implode(' - ')}}</small>
                @endif
                @unless ($loop->last)
                <hr>
                @endunless
                @empty
                <small class="text-muted">No tienes roles.</small>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            <h3 class="box-title">Permisos extras</h3>
            <div class="box-body">
                @forelse ($user->permissions as $permission)
                <strong>{{$permission->name}}</strong>

                @unless ($loop->last)
                <hr>
                @endunless
                @empty
                <small class="text-muted">No tienes permisos extras.</small>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection