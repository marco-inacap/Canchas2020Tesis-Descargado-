@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Rol</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.roles.update', $role)}}">
                    {{ method_field('PUT')}}  

                    @include('admin.roles.form') 
                    

                    <button class="btn btn-primary btn-block">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection