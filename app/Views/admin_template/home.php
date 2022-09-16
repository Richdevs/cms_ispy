<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
<!--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i-->
<!--                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Daily installations Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               Active Installations </div>
                            <div class="h5 mb-0 font-weight-bold text-danger"> <?php  echo $num; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Installations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $archive ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wrench fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                AVL READERS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $down ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wifi fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Unit Changes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Removals And Cancellations</div>
                            <div class="h5 mb-0 font-weight-bold text-primary"><?= $count ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="container-fluid">

<div class="row">

        <div class="col-xl-6 col-lg-5">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-Dark">INSTALLATIONS BY YEAR </h6>
                </div>
                <div class="mb-5 mt-5">
                    <div id="GoogleLineChart" style="height: 400px; width: 100%"></div>
                </div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load('current', {'packages':['corechart', 'bar']});
                    google.charts.setOnLoadCallback(drawLineChart);
                    google.charts.setOnLoadCallback(drawBarChart);
                    // Line Chart
                    function drawLineChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['month', 'Total Installations'],
                            <?php
                            foreach ($installation as $row){
                               echo "['".$row['year']."',".$row['count']."],";
                            } ?>
                        ]);
                        var options = {
                            title: 'Yearly Installations',
                            curveType: 'function',
                            legend: {
                                position: 'top'
                            }
                        };
                        var chart = new google.visualization.LineChart(document.getElementById('GoogleLineChart'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
            <div class="col-xl-6 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">TOTAL INSTALLED ACCESSORIES</h6>
                    </div>
                    <div class="mb-5 mt-10">
                        <div id="donutchart" style="height: 400px; width: 100%"></div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load("current", {packages:["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Accessories', 'Total Number'],
                                    <?php
                                    foreach ($transfer as $row){
                                        echo "['".$row['accname']."',".$row['count']."],";
                                    } ?>
                                ]);

                                var options = {
                                    title: ' Total Accessories',
                                    pieHole: 0.3,
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                                chart.draw(data, options);
                            }
                        </script>
                    </div>
                </div>
            </div>
    </div>

    <?= $this->endSection() ?>
    <!-- Content Row -->