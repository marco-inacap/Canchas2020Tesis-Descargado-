<!-- Call Me -->
<div id="callMe" class="form-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <div class="section-title">LLAMANOS</div>
                    <h2 class="white">QUIERES PUBLICAR TU CANCHA? <br> <br> Haga que nos comuniquemos con usted rellenando y enviando el formulario</h2>
                    <p class="white">Simplemente complete el formulario y envíenoslo y le responderemos con una llamada para explicarle en que consiste nuestro servicio.</p>
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
                <!-- Call Me Form -->
                <form id="callMeForm" data-toggle="validator" data-focus="false">
                    <div class="form-group">
                        <input type="text" class="form-control-input" id="lname" name="lname" required>
                        <label class="label-control" for="lname">Name</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control-input" id="lphone" name="lphone" required>
                        <label class="label-control" for="lphone">Phone</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control-input" id="lemail" name="lemail" required>
                        <label class="label-control" for="lemail">Email</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <select class="form-control-select" id="lselect" required>
                            <option class="select-option" value="" disabled selected>Interested in...</option>
                            <option class="select-option" value="Off The Ground">Off The Ground</option>
                            <option class="select-option" value="Accelerated Growth">Accelerated Growth</option>
                            <option class="select-option" value="Market Domination">Market Domination</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group checkbox white">
                        <input type="checkbox" id="lterms" value="Agreed-to-Terms" name="lterms" required>I agree with Aria's stated <a class="white" href="privacy-policy.html">Privacy Policy</a> and <a class="white" href="terms-conditions.html">Terms & Conditions</a>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">ENVIAR</button>
                    </div>
                    <div class="form-message">
                        <div id="lmsgSubmit" class="h3 text-center hidden"></div>
                    </div>
                </form>
                <!-- end of call me form -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form-1 -->
<!-- end of call me -->