<?php
include_once(dirname(__DIR__). DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "template" .
    DIRECTORY_SEPARATOR . "header.php");
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            const data = google.visualization.arrayToDataTable(
                JSON.parse('<?php
                    echo $_SESSION['votes'];
                    ?>')
            );

            const options = {
                title: 'My Votes'
            };

            const chart = new google.visualization.PieChart(document.getElementById('piechart'));

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

