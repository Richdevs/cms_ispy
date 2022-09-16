<?php
use Config\Services;
?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>
 <div class="row">

     <div class="col-md-3">
       <a> <div class="card-counter primary" href="<?= base_url('dailyreport')?>">
             <i class="fas fa-wrench"></i>
               <span class="count-numbers"><?= $count?></span>
               <span class="count-name">Daily Installations</span>
           </div>
       </a>

     </div>

     <div class="col-md-3">
         <div class="card-counter danger">
             <i class="fa fa-ticket"></i>
             <span class="count-numbers"><?= $changes?></span>
             <span class="count-name">Daily Changes</span>
         </div>
     </div>
     <div class="col-md-3">
         <div class="card-counter success">
             <i class="fa fa-database"></i>
             <span class="count-numbers"><?= $returns?></span>
             <span class="count-name">Returns</span>
         </div>
     </div>
     <div class="col-md-3">
         <div class="card-counter info">
             <i class="fa fa-users"></i>
             <span class="count-numbers"><?= $users?></span>
             <span class="count-name">Users</span>
         </div>
     </div>

 </div>
<!--     <div class="card shadow mb-4">-->
<!--         <div class="card-header py-3">-->
<!--<object data="" width="100%" height="500px" type="application/pdf"> PDF Plugin Not Available </object>-->
<!--         </div>-->
<!--     </div>-->

    <div class="row">

        <div class="col-xl-6 col-lg-5">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-Dark">Weekly Installations Chart</h6>
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
<!--                            --><?php
//                            foreach ($installation as $row){
//                                echo "['".$row['year']."',".$row['count']."],";
//                            } ?>
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
                    <h6 class="m-0 font-weight-bold text-dark">Total Returns Breakdown</h6>
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
                                ['Faults', 'Total Number'],
                               <?php
                                foreach ($faults as $row){
                                   echo "['".$row['fault_type']."',".$row['count']."],";
                                } ?>
                            ]);

                            var options = {
                                title: ' Total Returns Faults',
                                pieHole: 0.5,
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