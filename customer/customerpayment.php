<?php
// session_start(); 
// if(!isset($_SESSION["registerid"])) { 
// header("location:../guest/login.php"); 
// }

include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$regid = $_SESSION['registerid'];

// Query to fetch pending payment requests for the logged-in user
$sql1 = "SELECT * FROM tblpayrequest e
    INNER JOIN tblregister r ON e.registerid = r.registerid
    INNER JOIN tbldistrict l ON r.districtid = l.districtid 
    INNER JOIN tbllocation b ON r.locationid = b.locationid 
    INNER JOIN tblcar d ON e.carid = d.carid
    INNER JOIN tblcompany f ON d.companyid = f.companyid 
    INNER JOIN tblmodel m ON d.modelid = m.modelid  
    INNER JOIN tblcarshop c ON d.carshopid = c.carshopid 
    WHERE r.registerid = '$regid' AND e.s = 'pending'";

$result = $obj->executequery($sql1);
?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i
                class="ion-ios-arrow-forward"></i></a></span> <span>Payment <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-3 bread"><b>Requests of Payment</b> </h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Carshop Name</th>
            <th>Car name</th>
            <th>Photo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $row["carshopname"]; ?></td>
              <td><?php echo $row["companyname"]; ?> <?php echo $row["carname"]; ?></td>
              <td><img src="../uploads/<?php echo $row["photo1"]; ?>" style="width:120px; height:80px;"></td>
              <td>
                <div class="col-10 d-flex justify-content-end">
                  <a href="payment/cuspayment.php?carid=<?php echo $row['carid']?>" class="btn btn-primary py-2 mr-1">pay ₹<?php echo $row['price']?></a>
                </div>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    <?php else: ?>
      <p style="text-align:center; font-size:18px; color:#555;">No pending payment requests.</p>
    <?php endif; ?>
  </div>
</section>

<?php include_once("footer.php"); ?>
