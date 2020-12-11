 $("#anio").change(function(){
    if (window.grafica1) {
        window.grafica1.clear();
        window.grafica1.destroy();
    }
    enviarDatos_1($(this).val());
});

function enviarDatos_1(anio)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:'/admin/reporte-graficos/chart-3',
        type:"POST",
        datatype:"json", 
        data:{
            year: anio,
            _token: $('input[name=csrf-token]').val()
        },
        success: function(response){
            const data1 = [];
            const labels = [];
            const ingreso = response[1].IngresoTotal;

            const total = response[1].GananciaTotal;
            const color = response[1].ColorBG;
            for (var i in response[0]) {
                data1.push(response[0][i].Ingresos);
                labels.push(response[0][i].Mes);
            }
            charts1(data1, labels, ingreso, total, anio,color);
        },
        error: function(response){
            
        }
    });
}

function charts1(data1, labels, ingreso, total, anio,color)
{
    const chart1 = document.getElementById('myChart1').getContext('2d');
    window.grafica1 = new Chart(chart1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total de ganancias: $' + ingreso,
                backgroundColor: color,
			    borderColor: color,
                data: data1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                fontSize: 17,
                text: 'Ganancias año ' + anio
            },
            legend: {
                position: 'top',
                align: 'center'
            },
            plugins: {
                chartJsPluginSubtitle: {
                    display: true,
                    fontSize: 15,
                    text: 'Total del año $ ' + total
                }
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        return tooltipItem.yLabel.toLocaleString("es-CL", {style:"currency", currency:"CLP"});
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Meses'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Total CLP'
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString("es-CL",{style:"currency", currency:"CLP"});
                        }
                    }
                }]
            }
        }
    });
}