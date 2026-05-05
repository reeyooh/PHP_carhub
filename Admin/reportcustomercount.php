<?php
include("header.php");
// include_once("../dboperation.php");
$obj = new dbOperation();
$query = "select d.district, count(c.registerid)  as registercount from tblregister c
            inner join tbllocation l on c.locationid=l.locationid
            inner join tbldistrict d on d.districtid=l.districtid
            group by d.district";
$result = $obj->executequery($query);
?>


<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['district', 'Number'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["district"] . "', " . $row["registercount"] . "],";
                }
                ?>
            ]);
            var options = {
                title: 'Percentage ',
                //is3D:true,  
                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }  
    </script>
</head>

<body>
    <div class="logo">
        <a href="../index.php">
            <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <img src="img/logo.png" alt="">&nbsp; &nbsp;</a>
    </div>
    <div style="width:900px; margin-top:4%">
        <h3 align="center">Pie Chart showing the count of customers in each District</h3>
        <br />
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
    </div>
</body>

</html>
</body>

</html>
<?php
include("footer.php");
?>