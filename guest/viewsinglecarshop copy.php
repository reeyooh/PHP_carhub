<?php
//  session_start();
include_once("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
// $regid = $_SESSION["registerid"];
// $carshopid = $_GET["carshopid"];
// $sql = "SELECT * FROM tblregister WHERE registerid='$regid'";
// $result = $obj->executequery($sql);
// $display = mysqli_fetch_array($result);

     $sql1 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid where d.carshopid='$carshopid' and e.statz='available'  order by e.carid desc";
$result = $obj-> executequery($sql1);

$sql2= "SELECT * FROM tblcarshop a
         INNER JOIN tbldistrict b ON a.districtid = b.districtid
         INNER JOIN tbllocation c ON a.locationid = c.locationid where a.carshopid='$carshopid'";
$result1 = $obj-> executequery($sql2);



?>
<script src="../jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function () {
    $("#searchid").change(function () {
      var carid = $(this).val();
      var carshopid = $('#carshopid').val();
      alert
      // alert(carid); // Check if carid is being picked up correctly

      $.ajax({
        type: "POST",
        url: "getcardetailscarshop.php",
        data: { carid: carid,carshopid: carshopid },
        success: function (data) {
          console.log(data); // Check if the data is returned from PHP

          $("#cardetails").html(data); // Replace the content of #cardetails
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + status + " - " + error); // Log any errors
        }
      });
    });
  });
</script>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class=""><b>Availabile Used car... </b></h1>
        <?php while ($row1 = mysqli_fetch_array($result1))
       { ?>
        <b><h1 class="mb-3 bread"> <?php echo $row1["carshopname"];?> </h1></b>
        <!-- <h2 class="mb-4">Welcome to Carhub..,<?php echo $row1["carshopname"];?> </h2>  -->
        <!-- <img src="../uploads/<?php echo $row1["photo"]; ?>"style="width:60px; height:40px;"> -->
                  <p>Details of the Carshop</p>
	            <p>Name : <?php echo $row1["carshopname"];?></p>
                <!-- <p>Date of register : <?php echo $row1["datee"];?></p> -->
            
               
                <p>location : <?php echo $row1["district"];?>,<?php echo $row1["locationn"];?></p>
                <p>Phone : <?php echo $row1["mobile"];?></p>
                <p>email : <?php echo $row1["email"];?></p>
                <!-- <p>username : <?php echo $row1["username"];?></p> -->
                <input type="hidden"  value='<?php echo $row1["carshopid"];?>' id="carshopid" class="form-control" placeholder="">
         
                <!-- <p>photo :</p> -->
                <!-- <img src="../uploads/<?php echo $row1["photo"]; ?>"style="width:320px; height:280px;"> -->
                <?php
       }
       ?>
       <div class="col-sm-9">
          <input type="text" id="searchid" name="txtname" class="form-control" placeholder="Search">
          </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container-fluid">
    <div class="row justify-content-center" id="cardetails">
      <?php while ($row = mysqli_fetch_array($result)) { ?>
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
              <!-- <p><?php echo $row["companyname"]; ?></p> -->
              <b>
                <p>Car shop: <?php echo $row["carshopname"]; ?></p>
              </b>
              <p>Model Year: <?php echo $row["yearr"]; ?></p>
              <h2>₹ <?php echo $row["price"]; ?></h2>
              <!-- <p>Car Update date: <?php echo $row["datee"]; ?></p> -->
              <div class="d-flex mb-3"></div>
              <p class="d-flex mb-0 d-block">
                <a href="viewsincar.php?carid=<?php echo $row['carid'] ?>" class="btn btn-primary py-2 mr-1">VIEW</a>
              </p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>


<?php include_once("footer.php"); ?>
