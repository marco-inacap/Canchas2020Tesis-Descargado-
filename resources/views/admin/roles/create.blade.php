@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Rol</h3>
            </div>
            <div class="box-body">
                <form method="POST" action="{{route('admin.roles.store')}}">

                    @include('admin.roles.form') 
                    

                    <button class="btn btn-primary btn-block">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection