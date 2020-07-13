<div class="gallery-photos" data-masonry='{"itemSelector": ".grid-item", "columnWidth": 464}'>
    @foreach ($cancha->photos->take(4) as $photo)
    <figure class="grid-item grid-item--height2">
        @if ($loop->iteration === 4)
            <div class="overlay">{{$cancha->photos->count()}} Fotos</div>
        @endif
        <img src="{{url($photo->url)}}" class="img-responsive" alt="">
    </figure>
    @endforeach	
</div>