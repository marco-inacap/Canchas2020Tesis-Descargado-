<div class="gallery-photos" data-masonry='{"itemSelector": ".grid-item", "columnWidth": 464}'>
    @foreach ($cancha->photos->take(4) as $photo)
    <figure class="grid-item grid-item--height2">
        @if ($loop->iteration === 4)
            <a href="{{	route('canchas.show',$cancha)}}" class="overlay" style="color: white">{{$cancha->photos->count()}} Imágenes</a>
        @endif
        <img src="{{url($photo->url)}}" class="img-responsive" alt="">
    </figure>
    @endforeach	
</div>