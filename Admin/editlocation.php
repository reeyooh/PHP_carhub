<?php
include_once("header.php");
require_once("../dboperation.php");
$obj=new dboperation();
$sqlquery="SELECT * FROM tbldistrict";
$result=$obj->executequery($sqlquery);
?>
<div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="margin-left: 172px;">
                <div class="card-body">
                  <h4 class="card-title">LOCATION</h4>
                   
                  <form class="forms-sample" method="post" action="editlocationaction.php" enctype="multipart/form-data">
                  <?php
                        if(isset($_GET["locationid"]))
                        {
                            $locationid=$_GET["locationid"];
                            $sqlquery1="SELECT * FROM tbllocation WHERE locationid=$locationid";
                            $result1=$obj->executequery($sqlquery1);
                            $row=mysqli_fetch_array($result1);
                        }
                   ?>     
                   
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">DISTRICT NAME</label>
                      <div class="col-sm-9">
                        
                      <select class="form-control form-control-sm" name="ddldistrict" required>
                      <option value="0">--select--</option>
                      <?php
                      while($display=mysqli_fetch_array($result))
                      {
                      ?>
                      <option value=<?php echo $display['districtid']; ?>
                       <?php echo ($display["districtid"]==$row["districtid"])?"selected=selected":""; ?> > 
                       <?php echo $display['district']; ?> </option>
                      <?php
                      }
                      ?>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">LOCATION NAME</label>
                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $row['locationn']; ?>" name="txtlname" class="form-control" id="exampleInputEmail2" placeholder="location name" required>
                      </div>
                    </div>
                    <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                    <input type="hidden" name="locationid" value="<?php echo $row["locationid"]; ?>">
                  </form>
                </div>
              </div>
            </div>
</div>
<?php
include_once("footer.php");
?>