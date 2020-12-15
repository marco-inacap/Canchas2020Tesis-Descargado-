@extends('new.layout2')

@section('content')

<!-- Contact -->
<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">CONTACTO</div>
                    <h2>Póngase en contacto con el formulario</h2>
                    <p>Por cualquier inquietud, consulta o problema no dudes en contactarte con nosotros.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address"><i class="fas fa-map-marker-alt"></i>Psje. Peldehue #1847, Jardines del Sol, OSORNO.</li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:003024630820">+569 63732409</a></li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:office@aria.com">marcoignacio.96@hotmail.com</a></li>
                    </ul>
                    <h3>Siguenos en nuetras Redes Sociales</h3>

                    <span class="fa-stack">
                        <a href="#your-link">
                            <span class="hexagon"></span>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <span class="hexagon"></span>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <span class="hexagon"></span>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                
                <!-- Contact Form -->
                <form data-toggle="validator" data-focus="false" method="POST" action="{{route('pages.mi_perfil.update',$user)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control-input" placeholder="Nombres" name="name" value="{{old('name',$user->name)}}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nueva contraseña:</label>
                        <input type="password" class="form-control-input" name="password" placeholder="Contraseña" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Repite la contraseña:</label>
                        <input type="password" class="form-control-input" name="password_confirmation" placeholder="Repite la contraseña" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">Editar datos</button>
                    </div>
                    <div class="form-message">
                        <div id="cmsgSubmit" class="h3 text-center hidden"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                <!-- end of contact form -->

@endsection