<?php
// session_start();
include_once('header.php');
require_once("../dboperation.php");
$obj = new dboperation();
$cid = $_SESSION["carshopid"];
$sqlquery = "SELECT * FROM tblpayment e
    INNER JOIN tblcar w ON e.carid=w.carid
    INNER JOIN tblcarshop o ON w.carshopid=o.carshopid
    INNER JOIN tblcompany c ON w.companyid=c.companyid
    INNER JOIN tblmodel l ON w.modelid=l.modelid
    INNER JOIN tblregister r ON e.registerid=r.registerid
    INNER JOIN tbldistrict d ON d.districtid=r.districtid
    INNER JOIN tbllocation q ON q.locationid=r.locationid
    WHERE e.carshopid='$cid' AND e.typee='carshop' order by e.paymentid desc";
$result = $obj->executequery($sqlquery);
?>


  
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center"> <!-- Centered the text -->
      <div class="col-md-9 ftco-animate pb-5 text-center"> <!-- Added text-center class -->
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">REPORT OF SELLED CAR</h1>
      </div>
    </div>
  </div>
</section>
<br>

<section class="ftco-section bg-light">
  <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
    <div class="row justify-content-center"> <!-- Center the cars -->
      <div class="col-md-12" style="box-shadow: 2px 2px 10px #1b93e1; border-radius:15px; margin-top: 106px; margin-bottom: 59px;">
        <h2 style="text-align: center; margin-top: 6%; font-family: fantasy;">REPORT OF SELLED CAR</h2>
        <div class="text-left mb-3">
            <form action="Excel/excelshopsell.php" method="post">
            <input type="hidden" name="carso" value="<?php echo $cid; ?>">
                <button type="submit" name="addnew" class="btn btn-primary">Export</button>
            </form>
        </div>
        <!-- Centering the table -->
        <div class="form-horizontal center-table" style="width: 100%; text-align: center;"> <!-- Added text-align: center -->
          <table class="table table-striped" style="width: 90%; margin: 0 auto;"> <!-- Added margin: 0 auto to center table -->
            <thead>
              <tr>
                <th>SI NO</th>
                <th>Car Name</th>
                <th>Carshop Side Profit</th>
                <th>Sold Date</th>
                <th>Photo</th>
                <th>Customer Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $sum = 0;
              $carshopname = '';
              while ($display = mysqli_fetch_array($result)) {
                  $sum += $display["amount"];
                  $carshopname = $display["carshopname"];
              ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $display["companyname"] . " " . $display["carname"]; ?></td>
                <td><?php echo $display["amount"]; ?></td>
                <td><?php echo $display["dateofpur"]; ?></td>
                <td><img src="../uploads/<?php echo $display["photo1"]; ?>" style="width:120px; height:80px;"></td>
                <td>
                  <?php echo $display["regname"]; ?><br><br>
                  <?php echo $display["district"]; ?>, <?php echo $display["locationn"]; ?><br><br>
                  <?php echo $display["mobile"]; ?><br><br>
                  <?php echo $display["email"]; ?><br><br>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        
        <!-- Total Earnings Display -->
        <div class="text-center" style="margin-top: 20px;"> <!-- Added text-center for the total earnings text -->
          <h2><?php
          if (!empty($carshopname)) {
              echo "Total earnings of " . $carshopname . " is " . $sum;
          }
          ?><h2>
        </div>
      </div>
    </div>
  </div>
</section>

</form>

<?php include_once("footer.php"); ?>
