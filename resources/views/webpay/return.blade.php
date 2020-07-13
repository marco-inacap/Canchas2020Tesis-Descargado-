{{--  <form method="POST" action="{{$result->urlRedirection}}"  id="return-form">
        @csrf 
        <input type="hidden" name="token_ws" value="{{$result->token}}">
    </form>

    <script>
    
    document.getElementById('return-form').submit();
        
    </script> --}}

{{-- <meta name="csrf-token" content="{{ csrf_token() }}">

<form method="POST" action="{{ $response->urlRedirection }}" >
    @csrf
    <input type="hidden" name="token_ws" value="{{$token}}">

    OK
</form> --}}
ok
<form action="{{ $result->urlRedirection }}" method="post">
    @csrf
    <input type="hidden" name="token_ws" value="{{ $tokenWs }}">
</form>