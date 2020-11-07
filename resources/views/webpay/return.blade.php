@extends('new.layout2')

@section('content')


<div class="form-2">
    <div class="container">
        <form id="returnform" action="{{ $response->urlRedirection }}" method="post">
            @csrf
            <input type="hidden" name="token_ws" value="{{ $token }}">
            <div class="ajax-load text-center" style="display: none;">
            <p><img src="{{asset('new/images/cargando.gif')}}">
            <h1>Redirigiendo a Webpay....</h1>
            </p>
            </div>
            <button target="_blank" class="btn-solid-reg" hidden><i class="fa fa-print"></i>IR AL DETALLE DE LA COMPRA</button>
        </form>
    </div>
</div>
@endsection


@push('scripts')

<script>

    $(".ajax-load ").show();
    
    document.getElementById("returnform").submit();
</script>

@endpush