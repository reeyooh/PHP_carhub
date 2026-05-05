<?php
// include_once("header.php");
require_once ("../dboperation.php");
$obj = new dboperation();
$districtid = $_POST["districtid"];
$sqlquery="SELECT * FROM tblregister e  INNER JOIN tbldistrict d ON e.districtid=d.districtid INNER JOIN tbllocation l ON e.locationid=l.locationid where e.districtid='$districtid'";
$result=$obj->executequery($sqlquery)
?>
<?php
// include_once ('header.php');
?>
<!-- partial -->
<!-- <div class="col-lg-6 grid-margin stretch-card"> -->
<!-- <div class="card">
                <div class="card-body">
                  <div class="table-responsive"> -->
<!-- <h3 class="card-title">DISTRICT DETAILS</h3> -->
<table class="table table-hover" id="register_id">
    <!-- <div class="col-lg-6 grid-margin stretch-card"> -->
   <!-- <div class="col-lg-6 grid-margin stretch-card"> -->
   <div class="card">
    <div class="card-body">
      <!-- <h4 class="card-title">company details</h4> -->
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
            <th>#</th>
                <th> NAME</th>
                <!-- <th>DATE OF REGISTER</th> -->
                <!-- <th>DISTRICT </th> -->
                <th>LOCATION</th>
                <th>MOBILE</th>
                <th>EMAIL </th>
                <th>USERNAME </th>
                <th> PASSWORD</th>
               
                <th>DELETE</th>
            </tr>
          </thead>
          <tbody>
            <!-- <div class="col-10 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="register.php"'>
                Registration </button>
            </div> -->

            <?php
            $i = 1;
            while ($display = mysqli_fetch_array($result)) {
              ?>
              <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $display["regname"]; ?></td>
                 
                  <!-- <td><?php echo $display["district"]; ?></td> -->
                  <td><?php echo $display["locationn"]; ?></td>
                  <td><?php echo $display["mobile"]; ?></td>
                  <td><?php echo $display["email"]; ?></td>
                  <td><?php echo $display["username"]; ?></td>
                  <td><?php echo $display["passwordd"]; ?></td>
                  <!-- <td>
                    <a href="editregister.php?registerid=<?php echo $display["registerid"]; ?>">
                      <input type='button' class="btn btn-info" value="Edit"></a>
                  </td> -->
                  <td>
                    <a href="deleteregister.php?registerid=<?php echo $display["registerid"]; ?>"
                      onclick="return confirm('are you sure want to delete?')">
                      <input type='button' class="btn btn-danger" value="Delete"></a>
                  </td>
                </tr>
                <?php
            }
            ?>
         
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include_once ("footer.php");
?>