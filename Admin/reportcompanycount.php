<?php
include("header.php");
// include_once("../dboperation.php");
$obj = new dbOperation();
$query = "select d.companyname, count(c.paymentid)  as paymentcount from tblpayment c
            inner join tblcar l on c.carid=l.carid
            inner join tblcompany d on l.companyid=d.companyid
           where c.typee='carshop' group by d.companyname";
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
                ['companyname', 'Number'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["companyname"] . "', " . $row["paymentcount"] . "],";
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
        <h3 align="center">Pie Chart showing the count of car Company Most purchased</h3>
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