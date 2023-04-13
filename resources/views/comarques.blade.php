@extends('templates.navbar')
@section('titol')
    Comarques
@endsection
@section('contingut')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <div class="mx-auto w-3/4 backdrop-blur-sm bg-white/30">
        <table id="example" class="display nowrap">
            <thead>
                <tr>
                    <th>Any:</th>
                    <th>Codi Comarca:</th>
                    <th>Comarca:</th>
                    <th>Poblacio:</th>
                    <th>Dom.stic.xarxa:</th>
                    <th>Activitats Economiques:</th>
                    <th>Total:</th>
                    <th>Consum Domestic:</th>
                    <th>Mostrar Alerta</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Any:</th>
                    <th>Codi Comarca:</th>
                    <th>Comarca:</th>
                    <th>Poblacio:</th>
                    <th>Dom.stic.xarxa:</th>
                    <th>Activitats Economiques:</th>
                    <th>Total:</th>
                    <th>Consum Domestic:</th>
                </tr>
            </tfoot>
        </table>
    </div>
{{--    <!-- Trigger/Open The Modal -->--}}
{{--    <button id="myBtn">Open Modal</button>--}}

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <canvas id="myChart" style="width: 100%;max-width: 800px;"></canvas>
            <span class="close">&times;</span>
        </div>

    </div>

    <script>
        let btn = document.getElementById("myBtn");
        let span = document.getElementsByClassName("close")[0];
        let modal = document.getElementById('myModal');
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        function grafica(aecono, consdome, total) {

            console.log(aecono);
            console.log(consdome);
            console.log(total);

            let resta = parseInt(aecono) + parseInt(consdome);
            console.log(resta);
            let final = total-resta;

            console.log(total);
            modal.style.display = "block";

            let xValues = ["Activitats Economiques", "Consum Domestic", "Total"];
            let yValues = [parseInt(aecono), parseInt(consdome), final];

            // const properties = Object.values(aecono);

            let barColors = ["#b91d47", "#00aba9", "#1e7145"];
            // console.table(properties);
            // let ctx = document.getElementById("myChart");

            new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [
                        {
                            backgroundColor: barColors,
                            data: yValues,
                        },
                    ],
                },
                options: {
                    title: {
                        display: true,
                        text: "Gràfica consum",
                    },
                },
            });
        }
            fetch('https://analisi.transparenciacatalunya.cat/resource/2gws-ubmt.json')
                .then(response => response.json())
                .then(data =>{
                    setTimeout(() => {
                        console.log(data)
                        $('#example').DataTable({
                            data: data,
                            columns: [
                                {data: 'any'},
                                {data: 'codi_comarca'},
                                {data: 'comarca'},
                                {data: 'poblaci'},
                                {data: 'dom_stic_xarxa'},
                                {data: 'activitats_econ_miques_i'},
                                {data: 'total'},
                                {data: 'consum_dom_stic_per_c_pita'},
                                {
                                    data: null,
                                    render: function (data, type, row) {
                                        return '<button class="btn" onclick="grafica(' + row.dom_stic_xarxa + ',' + row.activitats_econ_miques_i + ',' + row.total + ')">Mostrar gráfica</button>';
                                    }
                                }
                            ]
                        })
                    },1000);
                });
        // {
        //     // defaultContent: "<button class='btn' onclick='grafica(\""+50+"\", \""+60+"\", \""+120+"\")'>Mostrar gráfica</button>",
        //     // defaultContent: "<button class='btn' onclick='grafica("+JSON.stringify(data.activitats_econ_miques_i)+", "+JSON.stringify(data.consum_dom_stic_per_c_pita)+", "+JSON.stringify(data.total)+")'>Mostrar gráfica</button>",
        //     // defaultContent: "<button class='btn' onclick='grafica(\""+aecono+"\", \""+consdome+"\", \""+total+"\")'>Mostrar gráfica</button>",
        //
        //
        // },
    </script>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
