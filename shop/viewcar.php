<?php
// session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$shopid = $_SESSION["carshopid"];
$sql = "SELECT * FROM tblcarshop WHERE carshopid='$shopid'";
$result = $obj->executequery($sql);
$display = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid
         WHERE d.carshopid = '$shopid' and e.statz='available' order by e.carid desc";
$result1= $obj->executequery($sql1);

$sql2 = "SELECT * FROM tblcar e
         INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
         INNER JOIN tblcompany l ON e.companyid = l.companyid
         INNER JOIN tblmodel m ON e.modelid = m.modelid
         WHERE e.statz='selled' and d.carshopid = '$shopid' order by e.carid desc";
$result2= $obj->executequery($sql2);
?>
<form method="post">
  
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <h1 class="mb-3 bread"> Car of <?php echo $display["carshopname"]; ?></h1>
      </div>
    </div>
  </div>
</section>
<br>
<div class="col-10 d-flex justify-content-end">
    <button name="selled" class="btn btn-primary mr-1 mb-3">
        Selled Cars
    </button>
</div>
              
<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                <div class="col-lg-2 col-md-3 col-sm-6 mb-5">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end" style="background-image: url('../uploads/<?php echo $row1["photo1"]; ?>');"></div>
                        <div class="text">
                            <b><h2 class="mb-0"><a href="viewsincar.php?carid=<?php echo $row1["carid"]?>"><?php echo $row1["companyname"];?>  <?php echo $row1["carname"]; ?></a></b></h2>
                            <p><?php echo $row1["companyname"];?></p>
                            <p>Model Year: <?php echo $row1["yearr"];?></p>
                            <h2>₹ <?php echo $row1["price"]; ?></h2>
                            <p class="d-flex mb-0 d-block">
                                <a href="editcar.php?carid=<?php echo $row1['carid']?>" class="btn btn-primary py-2 mr-1">Edit</a>
                                <a href="deletecar.php?carid=<?php echo $row1['carid']?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
if (isset($_POST['selled'])) {
    ?>
    <h2><center>Selled Cars</center></h2>
    <section class="ftco-section bg-light">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php if (mysqli_num_rows($result2) > 0) { 
                    while ($row = mysqli_fetch_array($result2)) { ?>
                        <div class="col-lg-2 col-md-3 col-sm-6 mb-5">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('../uploads/<?php echo $row["photo1"]; ?>');"></div>
                                <div class="text">
                                    <b><h2 class="mb-0"><a href="viewsincar.php?carid=<?php echo $row["carid"]?>"><?php echo $row["companyname"];?>  <?php echo $row["carname"]; ?></a></b></h2>
                                    <p><?php echo $row["companyname"];?></p>
                                    <p>Model Year: <?php echo $row["yearr"];?></p>
                                    <p>Selled date: <?php echo $row["datee"];?></p>
                                    <h2>₹ <?php echo $row["price"]; ?></h2>
                                    <p class="d-flex mb-0 d-block"></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-12">
                        <h3 class="text-center">No cars have been sold yet.</h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php 
} ?>
</form>
<?php include_once("footer.php"); ?>
