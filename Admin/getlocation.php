<?php
require_once("../dboperation.php");
$obj = new dboperation();
$districtid = $_POST["districtid"];
$sqlquery = "SELECT * FROM tbllocation l INNER JOIN tbldistrict d ON l.districtid = d.districtid WHERE l.districtid = '$districtid'";
$result = $obj->executequery($sqlquery);
?>

<div class="container">
  <div class="row">
    <!-- <div class="col-lg-10 mx-auto"> -->
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center">Location Details

          <!-- Registration Button -->
          <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" onclick='window.location.href="locationreg.php"'>
              Register New Location
            </button></h4>
          </div>

          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead class="table-primary text-center">
                <tr>
                  <th style="width: 10%;">#</th>
                  <th style="width: 50%;">Location Name</th>
                  <th style="width: 20%;">Edit</th>
                  <th style="width: 20%;">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($display = mysqli_fetch_array($result)) {
                ?>
                <tr class="text-center">
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $display["locationn"]; ?></td>
                  <td>
                    <a href="editlocation.php?locationid=<?php echo $display["locationid"]; ?>">
                      <button class="btn btn-info">Edit</button>
                    </a>
                  </td>
                  <td>
                    <a href="deletelocation.php?locationid=<?php echo $display["locationid"]; ?>" 
                       onclick="return confirm('Are you sure you want to delete this location?')">
                      <button class="btn btn-danger">Delete</button>
                    </a>
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>

<!-- Add CSS for improved alignment -->
<style>
  .container {
    margin-top: 20px;
  }

  .table {
    width: 100%;
    margin: 0 auto; /* Center the table */
    border-collapse: collapse; /* Collapse borders */
  }

  .table th, .table td {
    padding: 15px; /* Add padding */
    text-align: center; /* Center-align content */
    vertical-align: middle; /* Vertically center the content */
  }

  .btn {
    padding: 8px 12px; /* Adjust button padding */
    font-size: 14px; /* Set font size */
  }

  .card-body {
    padding: 20px;
  }

  .text-center {
    text-align: center;
  }

  .btn-primary {
    margin-bottom: 20px; /* Add space below the button */
  }
</style>
