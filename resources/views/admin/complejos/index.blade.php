@extends('admin.layout')

@section('header')

<h1>
    Complejos
    <small>Listado de mis Complejos</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Complejos</li>
</ol>

@endsection

@section('content')
<div class="box-body">
    @foreach ($complejos as $complejo)
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            {{-- <form id="eliminar-complejo" method="POST" action="{{route('admin.complejo.destroy',$complejo)}}">
                {{  method_field('DELETE')}} {{csrf_field()}}
                @can('Delete Complejo', $complejo)
                <button type="button" class="btn btn-danger btn-xs" style="position: absolute"
                    onclick="confirmDelete('eliminar-complejo')"><i class="fa fa-remove"></i></button>
                @endcan
            </form> --}}
            <img class="profile-user-img img-responsive img-circle" style="width:90px; height:90px;"
                    src="{{ url($complejo->url_imagen) }}" onerror="this.src='/img/logo.png';">
            <div class="box-body">
                <h3 class="profile-username text-center">{{$complejo->nombre}}</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Ubicación</b> <a class="pull-right">{{$complejo->ubicacion}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nº Contacto</b> <a class="pull-right">{{$complejo->telefono}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nº de canchas </b> <a class="pull-right">{{count($complejo->canchas)}}</a>
                    </li>
                </ul>
                <a href="{{route('admin.complejo.edit', $complejo)}}"
                    class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(id_complejo) {
        Swal.fire({
            title: 'Estas seguro de eliminar este complejo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3c8dbc',
            cancelButtonColor: '#dd4b39',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((resultado) => {
            if (resultado.isConfirmed) {
                $('#'+id_complejo).submit();
                Swal.fire(
                'Eliminado!',
                'El complejo ha sido eliminado.',
                'success'
                )
            }
            })
    }
</script>

@endpush