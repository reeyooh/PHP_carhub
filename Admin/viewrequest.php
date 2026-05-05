
<?php
include_once("header.php");
require_once("../dboperation.php");
    $obj=new dboperation();

     $sqlquery = "SELECT * FROM tblcarshop e  INNER JOIN tbldistrict d ON e.districtid=d.districtid INNER JOIN tbllocation l ON e.locationid=l.locationid where e.statuss='requested' ";
    
    $result=$obj->executequery($sqlquery);
// ?>
<!-- <div class="col-lg-6 grid-margin stretch-card"> -->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Available request of carshop</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                         
                          <th>SHOP NAME</th>
                          <th>DATE OF REGI</th>
                          <!-- <th>DISTRICT</th> -->
                          <th>LOCATION</th>
                          <th>MOBILE</th>
                          <th>PHOTO</th>
                          <th>LICENSE NO</th>
                          <th>Email</th>
                          <th>USERNAME</th>
                          <!-- <th>PASSWORD</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      <!-- <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="districtreg.php"'>
                     Registration </button>
            </div> -->

            <?php
              $i = 1;
              while ($display = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $display["carshopname"]; ?></td>
                  <td><?php echo $display["datee"]; ?></td>
                  <td><?php echo $display["district"]; ?>, <?php echo $display["locationn"]; ?></td>
                  
                  <td><?php echo $display["mobile"]; ?></td>
                  <td><img src="../uploads/<?php echo $display["photo"]; ?>" style="width:120px; height:80px;"></td>
                  <td><?php echo $display["license"]; ?></td>
                  <td><?php echo $display["email"]; ?></td>
                  <td><?php echo $display["username"]; ?></td>
                  <!-- <td><?php echo $display["passwordd"]; ?></td> -->
                  <td>
                    <a href="accept.php?carshopid=<?php echo $display["carshopid"]; ?>"
                    onclick="return confirm('are you sure want to Accept?')">
                      <input type='button' class="btn btn-info" value="Accept"></a>
                  </td>
                  <td>
                    <a href="rejected.php?carshopid=<?php echo $display["carshopid"]; ?>"
                      onclick="return confirm('are you sure want to Reject?')">
                      <input type='button' class="btn btn-danger" value="Reject"></a>
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
include_once("footer.php");
?>