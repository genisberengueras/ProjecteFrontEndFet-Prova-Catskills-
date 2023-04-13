@extends('templates.navbar')
@section('tiol')
    Embassaments
@endsection
@section('contingut')
    <link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <div class="backdrop-blur-sm w-3/4 bg-white/30 mx-auto">
        <table id="example" class="display nowrap" style="width: 100%">
            <thead>
            <tr>
                <th>Dia</th>
                <th>Estaci</th>
                <th>Nivell Absolut</th>
                <th>Percentatge Volum Embassat</th>
                <th>Volum Embassat</th>
                <th>Grafica</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Dia</th>
                <th>Estaci</th>
                <th>Nivell Absolut</th>
                <th>Percentatge</th>
                <th>Volum Embassat</th>
                <th>Grafica</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content w-full">

            <span class="close float-right">&times;</span>
{{--            <p>Some text in the Modal..</p>--}}
            <canvas id="myChart" class="mx-auto" style="width: 100%; max-width: 600px"></canvas>
        </div>

    </div>

    <script>
        let modal = document.getElementById("myModal");
        let span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function grafica(percentatge, volum) {

            modal.style.display = "block";

            percentatgeFinal=parseFloat(percentatge);
            volumFinal=parseFloat(volum);

            capacitat = volumFinal*100;

            capacitatF= capacitat/100;

            let xValues = ['Percentatge'];
            let yValues = [percentatgeFinal];
            let barColors = ['red'];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Percentatge Embassat"
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100,
                                callback: function (value) {
                                    return value + "%";
                                }
                            }
                        }]
                    }
                }
            });

            alert('Estas mostrant la gràfica' + percentatgeFinal + volumFinal + 'capacitat');
        }
        fetch('https://analisi.transparenciacatalunya.cat/resource/gn9e-3qhr.json')
        // fetch('https://analisi.transparenciacatalunya.cat/resource/gn9e-3qhr.json?$query=SELECT%0A%20%20%60dia%60%2C%0A%20%20%60estaci%60%2C%0A%20%20%60nivell_absolut%60%2C%0A%20%20%60percentatge_volum_embassat%60%2C%0A%20%20%60volum_embassat%60%0AORDER%20BY%20%60dia%60%20DESC%20NULL%20LAST')
        // fetch('https://analisi.transparenciacatalunya.cat/resource/gn9e-3qhr.json?$query=SELECT%0A%20%20%60dia%60%2C%0A%20%20%60estaci%60%2C%0A%20%20%60nivell_absolut%60%2C%0A%20%20%60percentatge_volum_embassat%60%2C%0A%20%20%60volum_embassat%60')
        .then(response => response.json())
            .then(data => {
                console.log(data); // Verificar que se están recibiendo los datos correctamente
                setTimeout(() => {
                    $('#example').DataTable({
                        data: data, // Especificar los datos para llenar la tabla
                        columns: [
                            { data: 'dia' },
                            { data: 'estaci' },
                            { data: 'nivell_absolut' },
                            { data: 'percentatge_volum_embassat' },
                            { data: 'volum_embassat' },
                            {
                                data: 'null',
                                render: function (data, type, row) {
                                    return '<button class="btn" onclick="grafica('+ row.percentatge_volum_embassat + ',' + row.volum_embassat +')">Mostrar Grafica</button>'
                                }
                            }
                        ],
                    });
                }, 1000); // Esperar 1 segundo antes de llenar la tabla
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
