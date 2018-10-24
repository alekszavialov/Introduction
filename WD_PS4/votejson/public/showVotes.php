<?php
include_once("header.php");
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                <?php
                echo $_SESSION["votes"];
                ?>
            ]);

            var options = {
                title: 'My Votes'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <a href="index.php">Go back</a>
    </body>
    </html>
<?php
session_unset();
session_destroy();
?>