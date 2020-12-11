<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#grafico-1" data-toggle="tab">Gráfico 1</a></li>
                    <li><a href="#grafico-2" data-toggle="tab">Gráfico 2</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="grafico-1">
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <label>Complejo</label>
                                <select id="complejos" name="complejo_id" class="form-control select2">
                                    <option value="">
                                        Seleeciona un Complejo </option>
                                    @foreach ($complejos as $complejo)
                                    <option value="{{$complejo->id}}">
                                        {{$complejo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button style="margin: 23px 2px;" type="submit" class="btn bg-navy btn-flat margin"
                                    id="btnAddChart"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <canvas id="myChart" class="chartjs" width="1000" height="385"
                            style="display: block; width: 770px; height: 385px;"></canvas>
                    </div>

                    <div class="tab-pane" id="grafico-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Año</label>
                                <select id="anio" name="year" class="form-control select2">
                                    <option value="">
                                        Seleeciona un año </option>
                                    @foreach ($years as $year)
                                    <option value="{{$year}}">
                                        {{$year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <canvas id="myChart1" class="chartjs" width="1000" height="385"
                            style="display: block; width: 770px; height: 385px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>