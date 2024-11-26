<?php

$dataPoints = array(
    array("x" => 10, "y" => 41),
    array("x" => 20, "y" => 35, "indexLabel" => "Lowest"),
    array("x" => 30, "y" => 50),
    array("x" => 40, "y" => 45),
    array("x" => 50, "y" => 52),
    array("x" => 60, "y" => 68),
    array("x" => 70, "y" => 38),
    array("x" => 80, "y" => 71, "indexLabel" => "Highest"),
    array("x" => 90, "y" => 52),
    array("x" => 100, "y" => 60),
    array("x" => 110, "y" => 36),
    array("x" => 120, "y" => 49),
    array("x" => 130, "y" => 41)
);

$dataPoints2 = array(
    array("label" => "Pausadas", "y" => 590),
    array("label" => "Abertas", "y" => 261),
    array("label" => "Canceladas", "y" => 158),
    array("label" => "N/A", "y" => 72),
    array("label" => "Em Analise", "y" => 191),
    array("label" => "Finalizadas", "y" => 573),
    array("label" => "Aguardando Autorização", "y" => 126)
);

$dataPoints3 = array(
    array("label" => 1992, "y" => 105),
    array("label" => 1993, "y" => 130),
    array("label" => 1994, "y" => 158),
    array("label" => 1995, "y" => 192),
    array("label" => 1996, "y" => 309),
    array("label" => 1997, "y" => 422),
    array("label" => 1998, "y" => 566),
    array("label" => 1999, "y" => 807),
    array("label" => 2000, "y" => 1250),
    array("label" => 2001, "y" => 1615),
    array("label" => 2002, "y" => 2069),
    array("label" => 2003, "y" => 2635),
    array("label" => 2004, "y" => 3723),
    array("label" => 2005, "y" => 5112),
    array("label" => 2006, "y" => 6660),
    array("label" => 2007, "y" => 9183),
    array("label" => 2008, "y" => 15844),
    array("label" => 2009, "y" => 23185),
    array("label" => 2010, "y" => 40336),
    array("label" => 2011, "y" => 70469),
    array("label" => 2012, "y" => 100504),
    array("label" => 2013, "y" => 138856),
    array("label" => 2014, "y" => 178391),
    array("label" => 2015, "y" => 229300),
    array("label" => 2016, "y" => 302300),
    array("label" => 2017, "y" => 368000)
);

?>

@extends('admin.main_master')
@section('scripts')
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Controle OS"
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Controle OS"
                },
                subtitles: [{
                    text: "lorem sumpin depuil"
                }],
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "฿#,##0",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();

            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Preventiva "
                },
                axisY: {
                    title: "Energy (in megawatt)",
                    logarithmic: true,
                    titleFontColor: "#6D78AD",
                    gridColor: "#6D78AD",
                    includeZero: true,
                    labelFormatter: addSymbols
                },
                axisY2: {
                    title: "Energy (in megawatt)",
                    titleFontColor: "#51CDA0",
                    tickLength: 0,
                    labelFormatter: addSymbols
                },
                legend: {
                    cursor: "pointer",
                    verticalAlign: "top",
                    fontSize: 16,
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "line",
                    markerSize: 0,
                    showInLegend: true,
                    name: "Log Scale",
                    yValueFormatString: "#,##0 MW",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                },
                    {
                        type: "line",
                        markerSize: 0,
                        axisYType: "secondary",
                        showInLegend: true,
                        name: "Linear Scale",
                        yValueFormatString: "#,##0 MW",
                        dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                    }]
            });
            chart3.render();

            function addSymbols(e) {
                var suffixes = ["", "K", "M", "B"];

                var order = Math.max(Math.floor(Math.log(Math.abs(e.value)) / Math.log(1000)), 0);
                if (order > suffixes.length - 1)
                    order = suffixes.length - 1;

                var suffix = suffixes[order];
                return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
            }

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
        }


    </script>
    <!-- Different type of Chart Canvas -->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    @endsection
@section('main')

            <!-- Graficos -->
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Grafico OS</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="chartContainer" style="height: 270px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Grafico OS</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="chartContainer2" style="height: 270px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Grafico Preventiva</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="chartContainer3" style="height: 270px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End of Graficos -->

            <!-- New Users -->
            <div class="col-md-8">
                <div class="card o-hidden mb-4">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Lista de O.S Programadas</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="user_table" class="table dataTable-collapse text-center">
                                <thead>
                                <tr>
                                    <th scope="col">N. OS</th>
                                    <th scope="col">RESPONSÁVEL</th>
                                    <th scope="col">TIPO</th>
                                    <th scope="col">NATUREZA</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">DATA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Ricardo</td>
                                    <td>
                                        Corretiva
                                    </td>

                                    <td>Elétrica</td>
                                    <td><span class="badge badge-success">Aberta</span></td>
                                    <td>
                                        24/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Marcello</td>
                                    <td>
                                        Corretiva Programada
                                    </td>

                                    <td>Refrigeração</td>
                                    <td><span class="badge badge-close">Fechada</span></td>
                                    <td>
                                        23/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Emerson</td>
                                    <td>
                                        Preditiva
                                    </td>

                                    <td>Jardinagem</td>
                                    <td><span class="badge badge-primary">Programada</span></td>
                                    <td>
                                        24/08/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Eduardo</td>
                                    <td>
                                        Preventiva Manual
                                    </td>

                                    <td>Limpeza</td>
                                    <td><span class="badge badge-danger">Cancelada</span></td>
                                    <td>
                                        01/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Maria</td>
                                    <td>
                                        Melhoria
                                    </td>

                                    <td>Civil</td>
                                    <td><span class="badge badge-warning">Em Espera</span></td>
                                    <td>
                                        25/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Ricardo</td>
                                    <td>
                                        Instalação
                                    </td>

                                    <td>Eng. Clinica</td>
                                    <td><span class="badge badge-waiting">Aguardando Material</span></td>
                                    <td>
                                        30/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Junior</td>
                                    <td>
                                        Corretiva
                                    </td>

                                    <td>Analista de TI</td>
                                    <td><span class="badge badge-waiting">Aguardando Material</span></td>
                                    <td>
                                        30/09/2024
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Rui</td>
                                    <td>
                                        Preditiva
                                    </td>

                                    <td>Pintor</td>
                                    <td><span class="badge badge-warning">Em Espera</span></td>
                                    <td>
                                        25/09/2024
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of col-->

            <!-- notification -->
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Preventiva</div>
                        <div class="ul-widget-app__browser-list scroll" id="mydiv">

                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-warning rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Refrigeração</span>
                                <span class="badge badge-close">FECHADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white cyan-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-info">PROGRAMADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white teal-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Limpeza</span>
                                <span class="badge badge-danger">CANCELADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white purple-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Civil</span>
                                <span class="badge badge-warning">EM ESPERA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Refrigeração</span>
                                <span class="badge badge-close">FECHADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white cyan-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-info">PROGRAMADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-warning rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white teal-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Limpeza</span>
                                <span class="badge badge-danger">CANCELADA</span>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
@endsection
