<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#grafico-1" data-toggle="tab">Gráfico 1</a></li>
                    <li><a href="#grafico-2" data-toggle="tab">Gráfico 2</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="grafico-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cancha</label>
                                <select id="canchas" name="cancha_id" class="form-control select2">
                                    <option value="">
                                        Seleeciona una cancha </option>
                                    @foreach ($canchas as $cancha)
                                    <option value="{{$cancha->id}}">
                                        {{$cancha->nombre}} - {{$cancha->complejo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <button style="margin: 23px 2px;" type="submit" class="btn bg-navy btn-flat margin" id="btnAddChart"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <canvas id="myChart" class="chartjs" width="1000" height="385"
                            style="display: block; width: 770px; height: 385px;"></canvas>
                    </div>
                    
                    <div class="tab-pane" id="grafico-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>