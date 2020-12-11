
$(".select2").select2();

const arrayID = [];
$(document).ready(function(){
    const chart5 = document.getElementById('myChart').getContext('2d');
    window.grafica5 = new Chart(chart5, config);
});

const Meses = ['Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

const config = {
    type: 'line',
    data: {
        labels: Meses,
        datasets: []
    },
    options: {
        responsive: true,
        title: {
            display: true,
            fontSize: 20,
            fontFamily: 'sans-serif',
            fontColor: '#222d32',
            text: 'Gráfico comparativo de canchas'
        },
        elements: {
            line: {
                tension: 0.000001
            }
        },
        legend: {
            position: 'bottom',
            align: 'center',
            onClick: function (evt, item) {
                const select = document.getElementById("canchas");
                const buscar = item.text.split(":");
                for(var i=1;i<select.length;i++)
                {
                    if(select.options[i].text == buscar[0])
                    {
                        const id = select.options[i].value;
                        const index = arrayID.indexOf(id);
                        if (index !== -1 ) {
                            arrayID.splice(index,1);
                            config.data.datasets.splice(item.datasetIndex,1);
                            window.grafica5.update();
                        }
                    }
                }
            },
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
};


$( "#btnAddChart" ).click(function() {
    const id = $("#canchas").val();
    if($.inArray(id, arrayID) == -1){
        arrayID.push(id);
        enviarDatos_5(id);
    }
});

function dataSet(data1,title,total,color)
	{
		const newDataset = {
			label: title + ': $' + total,
			backgroundColor: color,
			borderColor: color,
			fill: false,
			data: data1
		};

		config.data.datasets.push(newDataset);
		window.grafica5.update();
    }
    
    function enviarDatos_5(cancha_id)
	{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		$.ajax({
			url: '/admin/reporte-graficos/chart-2',
			type:"POST",
			datatype:"json", 
			data:{
                cancha_id: cancha_id,
                _token: $('input[name=csrf-token]').val()
			},
			success: function(response){	
				const data1 = [];
				const title = response[1].Cancha;
				const total = response[1].Total;
				const color = response[1].ColorBG;
				for (var i in response[0]) {
					data1.push(response[0][i].Total);
				}
				dataSet(data1,title,total,color);
			},
			error: function(response){
				
			}
		});
	}