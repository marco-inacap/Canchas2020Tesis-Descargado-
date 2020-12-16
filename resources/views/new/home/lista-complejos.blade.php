<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Los complejos registrados en nuestro sitio</h2>
                <p class="p-heading">Si quieres buscar canchas de un complejo, solo selecciona su imágen.</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Card Slider -->
                <div class="slider-container">
                    <div class="swiper-container card-slider">
                        <div class="swiper-wrapper">
                            @foreach ($complejos as $complejo)
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="{{route('complejos.show', $complejo->url)}}"><img class="card-image" src="{{ url($complejo->url_imagen) }}" onerror="this.src='/img/logo.png';" alt="alternative"></a>
                                    <div class="card-body">
                                        <div class="testimonial-text">{{$complejo->ubicacion}}</div>
                                        <div class="testimonial-author">{{$complejo->nombre}}</div>
                                        <div class="testimonial-text">+56 {{$complejo->telefono}}</div>
                                    </div>
                                </div>        
                            </div>  
                            @endforeach                     
                        </div> 
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>    
                    </div> <!-- end of swiper-container -->
                </div> <!-- end of sliedr-container -->
                <!-- end of card slider -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider -->