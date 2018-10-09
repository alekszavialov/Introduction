<?php
session_start();
include_once("../private/handler/handle.php") ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            <?php
            $result[] = "['Name', 'Vote count']";
            foreach ($_SESSION["votes"]['Users'] as &$value) {
                $result[] = "['{$value['name']}', {$value['votes']}]";
            }
            echo implode(",\n", $result);
            ?>
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>