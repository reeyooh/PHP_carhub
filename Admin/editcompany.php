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
                    if(isset($_GET["companyid"]))
                    {
                        $companyid=$_GET["companyid"];
                        require_once("../dboperation.php");
                        $obj= new dboperation();
                        $sqlquery="SELECT * FROM tblcompany where companyid=$companyid";
                        $result=$obj->executequery($sqlquery);
                        $row=mysqli_fetch_array($result);
                  ?>
                  <form class="forms-sample" method="post" action="editcompanyaction.php" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Company Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="txteditcompany" value="<?php echo $row["companyname"];?>"class="form-control" id="exampleInputUsername2" placeholder=" name" required>
                      </div>
                    </div>   
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Company Description</label>
                      <div class="col-sm-9">
                        <input type="text" name="txteditdescription" value="<?php echo $row["companydescription"];?>"class="form-control" id="exampleInputUsername2" placeholder=" name" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Exicting photo</label>
                      <div class="col-sm-9">
                      <img src="../uploads/<?php echo $row["photo"]; ?>" style="width:80px; height:60px;">
                      <!-- <p>Are you need to change the photo</p> -->
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Add New Company Photo</label>
                      <div class="col-sm-9">
                        <input type="file" name="image" value="<?php echo $row["photo"];?>"class="form-control" id="exampleInputUsername2" placeholder=" name">
                      </div>
                    </div>   
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="btnupdate">Update</button>
                    <button class="btn btn-light">Cancel</button>
                    <input type="hidden" name="companyid" value="<?php echo $row["companyid"];?>">
                    <input type=hidden id="companyid" name="companyid" value="<?php echo $row["companyid"];?>">
                  </form>
                </div>
              </div>
            </div>
</div>
<?php
}
include_once("footer.php");
?>