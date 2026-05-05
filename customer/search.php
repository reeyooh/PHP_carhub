<?php
// session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$regid = $_SESSION["registerid"];

// Fetch user details
$sql = "SELECT * FROM tblregister WHERE registerid='$regid'";
$result = $obj->executequery($sql);
$display = mysqli_fetch_array($result);

// Fetch available cars if no search is performed
$sql2 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid 
         WHERE e.statz = 'available'";
$result1 = $obj->executequery($sql2);
?>

<!-- jQuery for live search -->
<script src="../jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
      alert("hiiiiiiiiii");
        $("#carid").on("keyup", function () {
         
            var carid = $(this).val();
            alert($carid);
            
            // Ensure carid is not empty
            if (carid == "") {
                $.ajax({
                    type: "POST",
                    url: "getcardetails.php",  // This file will process the search
                    data: { carid: carid },
                    success: function (data) {
                        $("#searchResults").html(data);
                    },
                    error: function () {
                        alert("An error occurred while fetching car details.");
                    }
                });
            } else {
                $("#searchResults").html(""); // Clear results if input is empty
                // Instead of reload, just show the default cars
                $("#defaultCars").show(); 
            }
        });
    });
</script>


<div class="col-sm-9">
        <input type="text" id="carid" name="txtname" class="form-control" placeholder="Search for a car" ><br>
      </div>








<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>Cars <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-3 bread">Available Used Cars</h1>
      </div>
    </div>
  </div>
</section>

<!-- Search and Available Cars Section -->
<section class="ftco-section bg-light">
  <div class="container">
    <!-- Search Input -->
    <div class="form-group row">
      <div class="col-sm-9">
        <input type="text" id="carid" name="txtname" class="form-control" placeholder="Search for a car" ><br>
      </div>
    </div>

    <!-- Search Results Div -->
    <!-- <div id="searchResults"></div> -->

    <!-- Default Car List (visible when no search is performed) -->
    <div id="defaultCars">
      <div class="row">
        <?php while ($row = mysqli_fetch_array($result1)) { ?>
          <div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('../uploads/<?php echo htmlspecialchars($row["photo1"]); ?>');">
              </div>
              <div class="text">
                <h2>₹ <?php echo htmlspecialchars($row["price"]); ?></h2>
                <b><h2 class="mb-0"><a href="viewsincar.php?carid=<?php echo htmlspecialchars($row["carid"]);?>"><?php echo htmlspecialchars($row["companyname"]);?>  <?php echo htmlspecialchars($row["carname"]); ?></a></b></h2>
                <p><?php echo htmlspecialchars($row["companyname"]);?></p>
                <b><p>Car shop: <?php echo htmlspecialchars($row["carshopname"]);?></p></b>
                <p>Model Year: <?php echo htmlspecialchars($row["yearr"]);?></p>
                <p>Car Update date: <?php echo htmlspecialchars($row["datee"]); ?></p>
                <p class="d-flex mb-0 d-block">
                  <a href="viewsincar.php?carid=<?php echo htmlspecialchars($row['carid'])?>" class="btn btn-primary py-2 mr-1">VIEW</a>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<?php include_once("footer.php"); ?>
