@extends('layout')

@section('meta-title')SuCancha | {{$cancha->nombre}}@endsection


@section('content')

<article class="pages container">



  @if ($cancha->photos->count() === 1)
  <figure><img src="{{ $cancha->photos->first()->url }}" alt="" class="img-responsive"></figure>
  @elseif($cancha->photos->count() > 1)
  @include('canchas.carousel')
  @elseif($cancha->iframe)
  <div class="video" width="100%" height="480">
    {!! $cancha->iframe !!}
  </div>
  @endif
  <div class="content-post">
    @include('canchas.header')

    <div class="image-w-text">

      Total visitas: {{$visitas->total_visitas}}
    </div>

    <h1>{{$cancha->nombre}}</h1>
    <div class="divider"></div>
    <div class="image-w-text">
      {!!$cancha->descripcion!!}
    </div>


    <span>
      @if ($cancha->estado_id === 1)
      <div class="spinner-grow text-danger" role="status"></div>
      <span class="text-danger" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
      @elseif ($cancha->estado_id === 2)
      <div class="spinner-grow text-success" role="status"></div>
      <span class="text-success" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
      @elseif ($cancha->estado_id === 3)
      <div class="spinner-grow text-warning" role="status"></div>
      <span class="text-warning" style="font-size: 20px">{{$cancha->estado->nombre}}</span>
      @endif
    </span>
    <a class="text-center" style="color: tomato">${{number_format($cancha->precio,0, ',', '.')}}</a>
    <footer class="container-flex space-between">
      <div class="read-more">
        @if ($cancha->estado_id !== 3)
        <a href="{{  route('reservar.cancha',$cancha) }}" class="text-uppercase c-green">Reservas</a>
        @endif
      </div>
      <div class="buttons-social-media-share">
        <ul class="share-buttons">
          <li><a href="https://www.facebook.com/sharer.php?u={{ request()->fullUrl()}}&t={{$cancha->nombre}}"
              title="Compartir en Facebook" target="_blank"><img alt="Share on Facebook"
                src="/img/flat_web_icon_set/Facebook.png"></a></li>
          {{-- <li><a href="https://twitter.com/intent/tweet?url={{ request()->fullUrl()}}&text={{$cancha->nombre}}&i={{$cancha->photos->url}}&via=SuCancha&hashtags=canchas"
          target="_blank" title="Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/Twitter.png"></a></li> --}}
          <li><a href="https://api.whatsapp.com/send?text={{$cancha->nombre}}%20{{request()->fullUrl()}}"
              target="_blank" title="Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/whatsapp.png"></a></li>
        </ul>
      </div>
      <div class="footer">
        @if (! $cancha->liked)
        <a href="{{ route('canchas.like', $cancha) }}"><i class="far fa-thumbs-up like puntero"></i></a>
        <span class="alert-info">{{ $cancha->likesCount }}</span>
        @else
        <a href="{{ route('canchas.unlike', $cancha) }}"><i class="fas fa-thumbs-up like nomegusta puntero"></i></a>
        <span class="alert-info">{{ $cancha->likesCount }}</span>
        @endif

        @if (! $cancha->disliked)
        <a href="{{ route('canchas.dislike', $cancha) }}"><i class="far fa-thumbs-down dislike puntero"></i></a>
        <span class="alert-info">{{ $cancha->dislikesCount }}</span>
        @else
        <a href="{{ route('canchas.undislike', $cancha) }}"><i
            class="fas fa-thumbs-down dislike nomegusta puntero"></i></a>
        <span class="alert-info">{{ $cancha->dislikesCount }}</span>
        @endif
      </div>
    </footer>
    <div class="comments">
      <div class="divider"></div>
      <div id="disqus_thread"></div>
      @include('partials.disqus-scripts')
    </div><!-- .comments -->
  </div>
</article>


@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
  integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/css/like&dislike.css">
<script src="https://kit.fontawesome.com/42afc6e0a5.js" crossorigin="anonymous"></script>
@endpush


@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="/js/twitter-bootstrap.js"></script>

@endpush