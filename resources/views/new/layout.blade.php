<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>CANCHAS | OSORNO</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="/new/css/bootstrap.css" rel="stylesheet">
    <link href="/new/css/fontawesome-all.css" rel="stylesheet">
    <link href="/new/css/swiper.css" rel="stylesheet">
    <link href="/new/css/magnific-popup.css" rel="stylesheet">
    <link href="/new/css/styles.css" rel="stylesheet">
    <script>
        window.callbellSettings = {
          token: "4yWWhp6vbrcgSWrH7Zpb4bCa"
        };
      </script>
      <script>
        (function(){var w=window;var ic=w.callbell;if(typeof ic==="function"){ic('reattach_activator');ic('update',callbellSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Callbell=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://dash.callbell.eu/include/'+window.callbellSettings.token+'.js';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
      </script>
      <!-- End of Async Callbell Code -->

    <!-- Favicon  -->
    <link rel="icon" href="/new/images/favicon.png">
    @stack('styles')
</head>

<body data-spy="scroll" data-target=".fixed-top">
    <header class="space-inter">
        <div class="container container-flex space-between">
            {{-- <a href="{{route('pages.home')}}" class="logo"><img src="/img/logo.png" alt=""
                style="width:50px; height:50px;"></a> --}}
            @include('new.partials.nav')
        </div>
    </header>

    @yield('content')

    <div class="footer">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-container about">
                            <h4>ReservaUnaCancha.cl</h4>
                            <p class="white">Proyecto de tesis</p>
                            <p class="white">Aún esta en proceso de <b>Desarrollo</b>, por lo que el diseño, interacción
                                y funcionalidades no estan totalmente completo y no es primordial por el momento.</p>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-md-2">
                        <div class="text-container">
                            <h4>CANCHAS</h4>
                            <ul class="list-unstyled li-space-lg white">
                                <li>
                                    <a class="white" href="#your-link">startupguide.com</a>
                                </li>
                                <li>
                                    <a class="white" href="terms-conditions.html">Terms & Conditions</a>
                                </li>
                                <li>
                                    <a class="white" href="privacy-policy.html">Privacy Policy</a>
                                </li>
                            </ul>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-md-2">
                        <div class="text-container">
                            <h4>COMPLEJOS</h4>
                            <ul class="list-unstyled li-space-lg">
                                <li>
                                    <a class="white" href="#your-link">businessgrowth.com</a>
                                </li>
                                <li>
                                    <a class="white" href="#your-link">influencers.com</a>
                                </li>
                                <li class="media">
                                    <a class="white" href="#your-link">optimizer.net</a>
                                </li>
                            </ul>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-md-2">
                        <div class="text-container">
                            <h4>ENCUENTRANOS</h4>
                            <ul class="list-unstyled li-space-lg">
                                <li>
                                    <a class="white" href="#your-link">unicorns.com</a>
                                </li>
                                <li>
                                    <a class="white" href="#your-link">staffmanager.com</a>
                                </li>
                                <li>
                                    <a class="white" href="#your-link">association.gov</a>
                                </li>
                            </ul>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </footer>
    </div> <!-- end of footer -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © Todos los derechos reservados <a href="https://inovatik.com">Marco
                            González</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->

    <script src="/new/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="/new/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="/new/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="/new/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="/new/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="/new/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="/new/js/morphext.min.js"></script> <!-- Morphtext rotating text in the header -->
    <script src="/new/js/isotope.pkgd.min.js"></script> <!-- Isotope for filter -->
    <script src="/new/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="/new/js/scripts.js"></script> <!-- Custom scripts -->
    @stack('scripts')
</body>

</html>