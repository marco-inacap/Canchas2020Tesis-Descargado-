<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Reporte gráfico en TOTAL.</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="chart">
            <!-- Sales Chart Canvas -->
          {{--  <canvas id="salesChart" style="height: 180px;"></canvas> --}}
            <canvas id="myChart" class="img-responsive" width="1000" height="400"></canvas>
            
          </div>
          <!-- /.chart-responsive -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- ./box-body -->
    <div class="box-footer">
      <div class="row">
        <div class="col-sm-2 col-xs-3">
            <div class="description-block">
              <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
              <h5 class="description-header">$ {{ number_format($totalReservasDia, 0, ',', '.') }}</h5>
              <span class="description-text">TOTAL DÍA</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-2 col-xs-3">
            <div class="description-block border-right">
              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
              <h5 class="description-header">$ {{number_format($totalReservasSemana,0, ',', '.')}}</h5>
              <span class="description-text">TOTAL SEMANA</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-2 col-xs-3">
            <div class="description-block border-right">
              <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
              <h5 class="description-header">$ {{number_format($totalReservasMes,0, ',', '.')}}</h5>
              <span class="description-text">TOTAL MES</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
              <h5 class="description-header">$ {{number_format($totalReservasMesPasado,0, ',', '.')}}</h5>
              <span class="description-text">TOTAL MES PASADO</span>
            </div>
            <!-- /.description-block -->
          </div>
        <div class="col-sm-3 col-xs-6">
          <div class="description-block border-right">
            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
            <h5 class="description-header">$ {{number_format($totalReservas,0, ',', '.')}}</h5>
            <span class="description-text">TOTAL</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-footer -->
  </div>

