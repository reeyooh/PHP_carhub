<?php
include_once("header.php");
// include_once("../dboperation.php");
$obj = new dbOperation();
$query = "select d.carshopname, count(c.paymentid)  as paymentcount from tblpayment c
                 inner join tblcarshop d on c.carshopid=d.carshopid
           where c.typee='carshop' group by d.carshopname";
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
                ['Car Shop Name', 'Number of Purchases', { role: 'style' }],
                <?php
                // Set different colors for each bar dynamically
                $colors = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6']; // Add more colors if needed
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["carshopname"] . "', " . $row["paymentcount"] . ", '" . $colors[$i % count($colors)] . "'],";
                    $i++;
                }
                ?>
            ]);

            var options = {
                title: 'Count of Cars Purchased per Car Shop',
                hAxis: {
                    title: 'Car Shop Name',
                },
                vAxis: {
                    title: 'Number of Purchases',
                    minValue: 0
                },
                legend: 'none',
                bar: { groupWidth: "70%" }, // Reduced the width of the bars
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
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
        <h3 align="center">Bar Chart showing the count of cars purchased per Car Shop</h3>
        <br />
        <div id="barchart" style="width: 900px; height: 500px;"></div>
    </div>
    </div>
</body>

</html>
<?php 
include_once("footer.php");
?>