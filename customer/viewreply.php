<?php
// session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$regid = $_SESSION['registerid'];

$sql1 = "SELECT * FROM tblrequest e
   INNER JOIN tblregister r ON e.registerid = r.registerid
   INNER JOIN tbldistrict l ON r.districtid = l.districtid 
   INNER JOIN tbllocation b ON r.locationid = b.locationid 
   INNER JOIN tblcar d ON e.carid = d.carid
   INNER JOIN tblcompany f ON d.companyid = f.companyid 
   INNER JOIN tblmodel m ON d.modelid = m.modelid  
   INNER JOIN tblcarshop c ON e.carshopid = c.carshopid 
   WHERE r.registerid = '$regid' AND e.statusss = 'accepted' AND d.statz = 'available'";
$result = $obj->executequery($sql1);
$countAccepted = mysqli_num_rows($result);

$sql2 = "SELECT * FROM tblrequest e
   INNER JOIN tblregister r ON e.registerid = r.registerid
   INNER JOIN tbldistrict l ON r.districtid = l.districtid 
   INNER JOIN tbllocation b ON r.locationid = b.locationid 
   INNER JOIN tblcar d ON e.carid = d.carid
   INNER JOIN tblcompany f ON d.companyid = f.companyid 
   INNER JOIN tblmodel m ON d.modelid = m.modelid  
   INNER JOIN tblcarshop c ON e.carshopid = c.carshopid 
   WHERE r.registerid = '$regid' AND e.statusss = 'rejected' AND d.statz = 'available'";
$result2 = $obj->executequery($sql2);
$countRejected = mysqli_num_rows($result2);

$sql3 = "SELECT * FROM tblrequest e
   INNER JOIN tblregister r ON e.registerid = r.registerid
   INNER JOIN tbldistrict l ON r.districtid = l.districtid 
   INNER JOIN tbllocation b ON r.locationid = b.locationid 
   INNER JOIN tblcar d ON e.carid = d.carid
   INNER JOIN tblcompany f ON d.companyid = f.companyid 
   INNER JOIN tblmodel m ON d.modelid = m.modelid  
   INNER JOIN tblcarshop c ON e.carshopid = c.carshopid 
   WHERE r.registerid = '$regid' AND e.statusss = 'requested' AND d.statz = 'available' 
   ORDER BY e.requestid DESC";
$result3 = $obj->executequery($sql3);
$countRequested = mysqli_num_rows($result3);
?>

<style>
  .table-container {
    width: 100%;
    padding: 0 10px; /* Reduces free space on the sides */
  }
  .table-responsive {
    overflow-x: auto;
  }
  .table {
    width: 100%; /* Make the table fill the available width */
  }
</style>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="viewreply.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>Requests <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread"><b>Requests</b></h1>
      </div>
    </div>
  </div>
</section>

<form method="POST">
  <section class="ftco-section bg-light">
    <div class="container table-container">
      <div class="col-10 d-flex justify-content-end">
        <button name="requested" class="btn btn-primary mr-1 mb-3">
          Requested <?php if ($countRequested > 0) echo '<span class="badge badge-light">' . $countRequested . '</span>'; ?>
        </button>
        <button name="accepted" class="btn btn-success mr-1 mb-3" id="accepted">
          Accepted <?php if ($countAccepted > 0) echo '<span class="badge badge-light">' . $countAccepted . '</span>'; ?>
        </button>
        <button name="rejected" class="btn btn-danger mr-1 mb-3">
          Rejected <?php if ($countRejected > 0) echo '<span class="badge badge-light">' . $countRejected . '</span>'; ?>
        </button>
      </div>

      <div class="table-responsive">
        <?php
        if (isset($_POST['accepted']) && $countAccepted > 0) { ?>
          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Carshop Name</th>
                <th>Car Name</th>
                <th>Photo</th>
                <th>Reply</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row["dateee"]; ?></td>
                  <td><a href="viewsinglecarshop.php?carshopid=<?php echo $row["carshopid"]; ?>"><?php echo $row["carshopname"]; ?></a></td>
                  <td><a href="viewsincar.php?carid=<?php echo $row["carid"]; ?>"><?php echo $row["companyname"]; ?> <?php echo $row["carname"]; ?></a></td>
                  <td><img src="../uploads/<?php echo $row["photo1"]; ?>" style="width:120px; height:80px;"></td>
                  <td><?php echo $row["remark"]; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } elseif (isset($_POST['accepted'])) {
          echo "<p>No accepted requests.</p>";
        } ?>

        <!-- Rejected and Requested tables follow the same format -->
      </div>


      <div class="table-responsive">
        <?php
        if (isset($_POST['requested']) && $countRequested> 0) { ?>
          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Carshop Name</th>
                <th>Car Name</th>
                <th>Photo</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              while ($row3 = mysqli_fetch_array($result3)) { ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row3["dateee"]; ?></td>
                  <td><a href="viewsinglecarshop.php?carshopid=<?php echo $row3["carshopid"]; ?>"><?php echo $row3["carshopname"]; ?></a></td>
                  <td><a href="viewsincar.php?carid=<?php echo $row3["carid"]; ?>"><?php echo $row3["companyname"]; ?> <?php echo $row3["carname"]; ?></a></td>
                  <td><img src="../uploads/<?php echo $row3["photo1"]; ?>" style="width:120px; height:80px;"></td>
                <td>  <a href="cancel.php?requestid=<?php echo $row3["requestid"]; ?>" onclick="return confirm('Are you sure you want to cancel?')">
                  <input type='button' class="btn btn-info" value="Cancel"> </a></td></tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } elseif (isset($_POST['requested'])) {
          echo "<p>No requests.</p>";
        } ?>

        <!-- Rejected and Requested tables follow the same format -->
      </div>


      <div class="table-responsive">
        <?php
        if (isset($_POST['rejected']) && $countRejected> 0) { ?>
          <table class="table table-hover table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Carshop Name</th>
                <th>Car Name</th>
                <th>Photo</th>
                <th>Reply</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              while ($row2 = mysqli_fetch_array($result2)) { ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row2["dateee"]; ?></td>
                  <td><a href="viewsinglecarshop.php?carshopid=<?php echo $row2["carshopid"]; ?>"><?php echo $row2["carshopname"]; ?></a></td>
                  <td><a href="viewsincar.php?carid=<?php echo $row2["carid"]; ?>"><?php echo $row2["companyname"]; ?> <?php echo $row2["carname"]; ?></a></td>
                  <td><img src="../uploads/<?php echo $row2["photo1"]; ?>" style="width:120px; height:80px;"></td>
                  <td><?php echo $row2["remark"]; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } elseif (isset($_POST['rejected'])) {
          echo "<p>No requests are Rejected.</p>";
        } ?>

        <!-- Rejected and Requested tables follow the same format -->
      </div>


    </div>
  </section>
</form>

<?php include_once("footer.php"); ?>
