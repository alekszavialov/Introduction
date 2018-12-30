<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable(
            JSON.parse('<?=$data;?>')
        );
        const options = {
            title: '<?=$title;?>'
        };
        const chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<a href="index.php">Vote page</a>
