<?php
// session_start();
include_once("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
$shopid = $_SESSION["carshopid"];
$regid = $_GET["regnumber"];
$sql = "SELECT * FROM tblcarshop WHERE carshopid='$shopid'";
$result = $obj->executequery($sql);
$display = mysqli_fetch_array($result);

 $sql1 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid
         WHERE d.carshopid = '$shopid' and e.statz='available'";
$result1 = $obj->executequery($sql1);

 $sql2 = "SELECT * FROM tblregister WHERE regnumber = '$regid'";
$result2= $obj->executequery($sql2);
$row2 = mysqli_fetch_array($result2);
?>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Select the car <?php echo $display["carshopname"]; ?></h1>
      </div>
    </div>
  </div>
</section>



<section class="ftco-section bg-light">
  <div class="container-fluid">
    <div class="row justify-content-center" id="cardetails">
    <?php while ($row = mysqli_fetch_array($result1)) { ?>
      <div class="col-lg-2 col-md-3 col-sm-6 mb-5"> <!-- Reduced width by changing to col-lg-2 -->
          <div class="car-wrap rounded ftco-animate">
            <div class="img rounded d-flex align-items-end"
              style="background-image: url('../uploads/<?php echo $row["photo1"]; ?>');">
            </div>
            <div class="text">

              <b>
                <h2 class="mb-0"><a
                    href="viewsincar.php?carid=<?php echo $row["carid"]; ?>"><?php echo $row["companyname"]; ?>
                    <?php echo $row["carname"]; ?></a>
              </b></h2>
              <p><?php echo $row["companyname"]; ?></p>
              <b>
                <!-- <p>Car shop: <?php echo $row["carshopname"]; ?></p> -->
              </b>
              <p>Model Year: <?php echo $row["yearr"]; ?></p>
              <h2>₹ <?php echo $row["price"]; ?></h2>
              <!-- <p>Car Update date: <?php echo $row["datee"]; ?></p> -->
              <div class="d-flex mb-3"></div>
              <p class="d-flex mb-0 d-block">
              <a href="payment/paymentfinal.php?carid=<?php echo $row['carid']?> & regnumber=<?php echo $row2['regnumber']?>" class="btn btn-primary py-2 mr-1">Select</a>
                <!-- <a href="deletecar.php?carid=<?php echo $row['carid']?>" onclick="return confirm('are you sure want to delete?')" class="btn btn-danger">Delete</a> -->
				  </p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>




<?php include_once("footer.php"); ?>
