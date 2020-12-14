<!-- Call Me -->
<div id="callMe" class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">LLAMANOS</div>
                    <h2 class="white">QUIERES PUBLICAR TU CANCHA? <br> <br> Haga que nos comuniquemos con usted
                        rellenando y enviando el formulario</h2>
                    <p class="white">Simplemente complete el formulario y envíenoslo y le responderemos con una llamada
                        para explicarle en que consiste nuestro servicio.</p>
                    <ul class="list-unstyled li-space-lg white">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Puedes crear tus complejos deportivos</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Puedes agregar canchas</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Administrar y ver ganancias </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->

            <div class="col-lg-6">
                <!-- id="callMeForm" formulario-->
                <form method="POST" action="{{route('llamanos.email')}}" data-toggle="validator"> 
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control-input" id="lname" name="nombre" required>
                        <label class="label-control" for="lname">Nombre y Apellido</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control-input" id="lphone" name="n_telefono" required>
                        <label class="label-control" for="lphone">Nº de teléfono</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control-input" id="lemail" name="email" required>
                        <label class="label-control" for="lemail">Email</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <select class="form-control-select" name="select" id="lselect" required>
                            <option class="select-option" value="" selected>Seleccione una opción</option>
                            <option class="select-option" value="Reunion">Quiero conocer más detalles de ustedes</option>
                            <option class="select-option" value="Administrar Complejos">Quiero administrar mis complejos
                            </option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnEnviar" class="form-control-submit-button">Enviar</button>
                    </div>
                </form>
                <!-- end of call me form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of call me -->

@push('scripts')

<script>
    $('#btnEnviar').click(function(){
        this.form.submit();
        this.disabled=true;
        this.innerHTML='<i class="fa fa-spinner fa-spin"></i> Enviando...';
    });
    
</script>

@endpush