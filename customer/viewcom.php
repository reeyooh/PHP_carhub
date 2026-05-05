<?php
// session_start();
include_once("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
$regid = $_SESSION["registerid"];

// $sql = "SELECT * FROM tblregister WHERE registerid='$regid'";
// $result = $obj->executequery($sql);
// $display = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tblcompany order by companyid";
$result1 = $obj-> executequery($sql1);
?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>company <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread"><b>COMPANY </b></h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">
      <?php while ($row = mysqli_fetch_array($result1)) { ?>
        <div class="col-md-4">
          <div class="car-wrap rounded ftco-animate">
            <div class="img rounded d-flex align-items-end" style="background-image: url('../uploads/<?php echo $row["photo"]; ?>');">
            </div>
            <div class="text">
              <!-- <h2>₹ <?php echo $row["price"]; ?></h2> -->
              <b><h2  class="mb-0"><a href="viewsinglecompany.php?companyid=<?php echo $row['companyid']?>"><?php echo $row["companyname"];?> </a></b></h2>
              <!-- <p><?php echo $row["companyname"];?></p> -->
             <!-- <b> <p>Car shop:<?php echo $row["carshopname"];?></p></b> -->
              <!-- <p>Model Year:<?php echo $row["yearr"];?></p> -->
              <!-- <p>Car Update date:<?php echo $row["datee"];?> -->
              <!-- <p>Car shop:<?php echo $row["carshopname"];?> -->
              <div class="d-flex mb-3">
                <!-- <span class="">Model Year: <?php echo $row["yearr"]; ?></span> -->
               
                <!-- </p>  #region <p class="price ml-auto"> Rs: <?php echo $row["price"]; ?> <span></span></p> -->
               
              </div>
             
              <p class="d-flex mb-0 d-block">
                <!-- <a href="viewsincar.php?carid=<?php echo $row['carid']?>" class="btn btn-primary py-2 mr-1">VIEW</a> -->
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
