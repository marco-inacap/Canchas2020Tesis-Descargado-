@extends('layout')

@section('content')
<section class="pages container">
    <div class="page page-contact">
        <form action="{{ $response->urlRedirection }}" method="post">
            @csrf
            <input type="hidden" name="token_ws" value="{{ $token }}">
            <button target="_blank" class="btn btn-default"><i class="fa fa-print"></i>IR AL DETALLE DE LA COMPRA</button>
        </form>
    </div>
</section>
@endsection