/* var canchas = [];
var total = [];
var fecha = [];


$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'admin/ganancias/all',
        method: 'POST',
        data: {
            id: 1
        }
    }).done(function (res) {
        var arreglo = JSON.parse(res);

        for (var x = 0; x < arreglo.length; x++) {

            canchas.push(arreglo[x].cancha_id);
            total.push(arreglo[x].total);
            fecha.push(moment(arreglo[x].created_at).format("DD-MM-YYYY"));
        }
        generarGrafica();
    })
});

function generarGrafica() {

    var ctx = document.getElementById('myChart').getContext('2d');

    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'CLP',
                data: total,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }],
            labels: fecha,
        },
    });
} */
