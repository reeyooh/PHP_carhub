<?php
include_once("header.php");
?>
<div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="margin-left: 172px;">
                <div class="card-body">
                  <h4 class="card-title">Edit district Details</h4>
                  <p class="card-description">
    
                  </p>
                  <?php
                    if(isset($_GET["districtid"]))
                    {
                        $districtid=$_GET["districtid"];
                        require_once("../dboperation.php");
                        $obj= new dboperation();
                        $sqlquery="SELECT * FROM tbldistrict where districtid=$districtid";
                        $result=$obj->executequery($sqlquery);
                        $row=mysqli_fetch_array($result);
                  ?>
                  <form class="forms-sample" method="post" action="editdistrictaction.php">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >district Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="txteditdistrict" value="<?php echo $row["district"];?>"class="form-control" id="exampleInputUsername2" placeholder="name" required>
                      </div>
                    </div>             
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="btnupdate">Update</button>
                    <button class="btn btn-light">Cancel</button>
                    <input type="hidden" name="districtid" value="<?php echo $row["districtid"];?>">
                    <input type=hidden id="districtid" name="districtid" value="<?php echo $row["districtid"];?>">
                  </form>
                </div>
              </div>
            </div>
</div>
<?php
}
include_once("footer.php");
?>