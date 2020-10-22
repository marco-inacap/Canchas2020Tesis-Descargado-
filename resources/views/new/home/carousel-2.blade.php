<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($cancha->photos as $photo)
        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
            <img class="d-block w-100 img-responsive" style="width: 400px; height: 300px;" src="{{url($photo->url)}}" alt="First slide" onerror="this.src='/img/logo.png';">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>