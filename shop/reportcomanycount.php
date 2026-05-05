<?php
// session_start();
include("header.php");
include_once("../dbOperation.php");
$cid = $_SESSION["carshopid"];
$obj = new dbOperation();
 $query = "select d.companyname, count(c.paymentid)  as paymentcount from tblpayment c
            inner join tblcar l on c.carid=l.carid
            inner join tblcompany d on l.companyid=d.companyid
           where c.carshopid='$cid' and c.typee='carshop' group by d.companyname";
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
                title: 'Percentage',
                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center"> <!-- Centered the text -->
      <div class="col-md-9 ftco-animate pb-5 text-center"> <!-- Added text-center class -->
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">PIE CHART FOR MOST SELLED COMPANY</h1>
      </div>
    </div>
  </div>
</section>
<body>
    <div class="logo">
        <a href="../index.php">
            <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <img src="img/logo.png" alt="">&nbsp; &nbsp;</a>
    </div>
    
    <div style="width: 100%; margin-top:4%; text-align:center;"> <!-- Center the container -->
        <h3 align="center">Pie Chart showing the count of car Company Most purchased</h3>
        <br />
        <div id="piechart" style="width: 900px; height: 500px; display: inline-block;"></div> <!-- Inline-block for centered chart -->
    </div>
</body>

</html>
<?php
include("footer.php");
?>
