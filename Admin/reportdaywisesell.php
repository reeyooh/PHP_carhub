<?php
// session_start();
include("header.php");
// include_once("../dboperation.php");
$obj = new dboperation();
// session_start(); // Make sure session is started before using $_SESSION
$today = date('Y-m-d'); // Get the current date
?>
<!DOCTYPE html>
<html>

<head>
  <title>Carhub</title>
</head>

<div class="main-panel">

  <body style="background-image:url(../Guest/images/account-bg.jpg)">
    <form action="" method="POST">
      <div class="logo">
        <a href="./index.php">
          <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <img src="img/logo.png" alt="">&nbsp; &nbsp;
        </a>
      </div>
      <div class="container" style="width:120%;margin-bottom: 5%;padding-top:0%">
        <div class="col-md-12"
          style="box-shadow: 2px 2px 15px #1b93e1; border-radius:0px; top: 14px; margin-left:37px;background-color:white">
          <h2 style="text-align: center;margin-top: 6%;font-family: fantasy;padding-top:2%">DATEWISE Selled cars</h2>
          <br>
          <div class="row">
            <div class="col-md-3" style="text-align:right">
              <label>From date:</label>
            </div>
            <div class="col-md-6">
              <input type="date" class="form-control" name="fromdate" style="width:500px;" max="<?php echo $today; ?>" onchange="updateToDate()">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-3" style="text-align:right">
              <label>To date:</label>
            </div>
            <div class="col-md-6">
              <input type="date" id="todate" class="form-control" name="todate" style="width:500px;" max="<?php echo $today; ?>">
            </div>
          </div>
          <br>
          <div class="row">
            <input type="submit" name="btnsubmit" value="Submit" class="btn btn-primary" style="margin-left:63%;margin-bottom:2%">
          </div>
        </div>
      </div>
      <br>
    </form>

    <?php
    if (isset($_POST["btnsubmit"])) {
      $fromdate = $_POST["fromdate"];
      $todate = $_POST["todate"];
      $_SESSION['fromdate'] = $fromdate;
      $_SESSION['todate'] = $todate;
      $i = 1; // Initialize $i for row numbering
      ?>
      <div class="col-md-12"
        style="box-shadow: 2px 2px 10px #1b93e1; border-radius:50px;margin-top:-15px;background-color:white">
        <br>
        <h2 style="text-align: center;margin-top: 6%;font-family: fantasy;">DATEWISE Selled cars REPORT</h2>
        <br>
        <div class="row">
          <div class="col-md-3" style="text-align:right">
            <label>From date:</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="fromdate" readonly value="<?php echo $fromdate ?>" style="width:500px;">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3" style="text-align:right">
            <label>To date:</label>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" name="todate" readonly value="<?php echo $todate ?>" style="width:500px;">
          </div>
        </div>
        <br>
        <div class="text-right mb-3">
  <form action="excel/exceldaywiseselled.php" method="post">
    <input type="hidden" name="fromdate" value="<?php echo $fromdate; ?>">
    <input type="hidden" name="todate" value="<?php echo $todate; ?>">
    <button type="submit" name="addnew" class="btn btn-primary">Export</button>
  </form>
</div>

        <div style="padding-bottom:4%">
          <table class="table table-hover"
            style="border: 2px solid #adaaaa;margin-left:4px; box-shadow: 3px 3px 11px #777777; padding-bottom:content;background-color:white">
            <thead>
              <th> SL No.</th>
              <th>Car name</th>
              <th>Carshop</th>
              <th>Price</th>
              <th>Date</th>
              <th>Photo</th>
              <th>Customer details</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * from tblpayment t
                inner join tblcar r on t.carid=r.carid 
                inner join tblcarshop o on r.carshopid=o.carshopid 
                inner join tblcompany c on r.companyid=c.companyid 
                inner join tblmodel m on r.modelid=m.modelid 
                inner join tblregister q on t.registerid=q.registerid 
                inner join tbldistrict d on q.districtid=d.districtid 
                inner join tbllocation e on q.locationid=e.locationid 
                where t.dateofpur >= '$fromdate' and t.dateofpur <= '$todate' and t.sts='payed' and t.typee='admin' 
                group by t.paymentid";
              $res = $obj->executequery($sql);
              $sum = 0;
              $carshopname = '';

              if (mysqli_num_rows($res) > 0) {
                while ($display = mysqli_fetch_array($res)) {
                  $sum += $display["amount"];
                  $carshopname = $display["carshopname"];
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $display["companyname"] . " " . $display["carname"]; ?></td>
                    <td><?php echo $display["carshopname"]; ?></td>
                    <td><?php echo $display["amount"]; ?></td>
                    <td><?php echo $display["dateofpur"]; ?></td>
                    <td><img src="../uploads/<?php echo $display["photo1"]; ?>" style="width:120px; height:80px;"></td>
                    <td><?php echo $display["regname"]; ?><br>
                      <?php echo $display["district"]; ?>, <?php echo $display["locationn"]; ?><br>
                      <?php echo $display["mobile"]; ?><br>
                      <?php echo $display["email"]; ?><br></td>
                  </tr>
                <?php 
                }
              } else {
                echo "<tr><td colspan='7' class='text-center'>No cars sold in this period</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <div class="text-center" style="margin-top: 20px;">
            <h2>
              <?php
              if (!empty($carshopname)) {
                echo "Total profit earned between " . $fromdate . " and " . $todate . " is " . $sum;
              }
              ?>
            </h2>
          </div>
        </div>
      </div>
    <?php } ?>
  </body>

</html>

<script src="../jquery-3.6.0.min.js"></script>
<script>
  function updateToDate() {
    var fromDateInput = document.querySelector('input[name="fromdate"]');
    var toDateInput = document.querySelector('input[name="todate"]');
    
    if (fromDateInput.value) {
      var fromDateValue = fromDateInput.value;
      toDateInput.setAttribute('min', fromDateValue);
      
      if (toDateInput.value && toDateInput.value < fromDateValue) {
          toDateInput.value = '';
      }
    }
  }
</script>

<?php
include("footer.php");
?>
