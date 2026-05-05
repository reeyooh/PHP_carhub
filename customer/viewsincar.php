<?php
// session_start();
include_once("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
$carid=$_GET['carid'];
$regid=$_SESSION['registerid'];

$sql1 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid where carid='$carid'";
$result = $obj->executequery($sql1);

$sql = "SELECT * FROM tblregister WHERE registerid='$regid'";
$result1 = $obj->executequery($sql);
$display = mysqli_fetch_array($result1);

?>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread"><b>Car Details</b></h1>
      </div>
    </div>
  </div>
</section>

<?php while ($row = mysqli_fetch_array($result)) { ?>
<section class="ftco-section ftco-car-details">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="car-details">
          
          <!-- Start Carousel for Car Photos -->
          <div id="carPhotosCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../uploads/<?php echo $row['photo1']; ?>" alt="First slide" style="margin-left: 215px;width: 650px;">
              </div>
              <div class="carousel-item">
                <img src="../uploads/<?php echo $row['photo2']; ?>" alt="Second slide" style="margin-left: 215px;width: 650px;">
              </div>
              <div class="carousel-item">
                <img src="../uploads/<?php echo $row['photo3']; ?>" alt="Third slide" style="margin-left: 215px;width: 650px;">
              </div>
			  <div class="carousel-item">
                <img src="../uploads/<?php echo $row['photo4']; ?>" alt="Fouth slide" style="margin-left: 215px;width: 650px;">
              </div>
              <!-- Add more carousel items as needed -->
            </div>
            <a class="carousel-control-prev" href="#carPhotosCarousel" role="button" data-slide="prev" style="    margin-left: 192px;">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carPhotosCarousel" role="button" data-slide="next" style="    margin-right: 192px;">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <!-- End Carousel for Car Photos -->

          <div class="text text-center">
            <h2>₹ <?php echo $row["price"]; ?></h2>
            <b><h2 ><?php echo $row["companyname"];?>  <?php echo $row["carname"]; ?></a></b></h2>

           
            <div class="text"> 
                      
                      <a href="request/req.php?carid=<?php echo $row['carid']?>&registerid=<?php echo $display['registerid']?>" class="btn btn-primary py-2 mr-1"  
                    >Request</a>
                   
                          </div>
            <p><?php echo $row["companyname"];?></p>
            <b><p><h6  class="mb-0"><a href="viewsinglecarshop.php?carshopid=<?php echo $row['carshopid']?>">Car shop: <?php echo $row["carshopname"];?></a></h6></p></b>
            <p>Model Year: <?php echo $row["yearr"];?></p>
            <p>Car Update date: <?php echo $row["datee"];?></p>
            <p>Fuel: <?php echo $row["fuel"];?></p>
            <p>Description: <?php echo $row["descriptionn"];?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}
?>
<?php include_once("footer.php"); ?>
