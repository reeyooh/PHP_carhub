<?php
include_once("header.php");
require_once("../dboperation.php");
$obj=new dboperation();
$sqlquery="SELECT * FROM tblcompany";
$result=$obj->executequery($sqlquery);
?>
<div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="margin-left: 172px;">
                <div class="card-body">
                  <h4 class="card-title">CAR MODEL</h4>
                  <form class="forms-sample" method="post" action="editmodelaction.php" >
                  <?php
                        if(isset($_GET["modelid"]))
                        {
                            $modelid=$_GET["modelid"];
                            $sqlquery1="SELECT * FROM tblmodel WHERE modelid=$modelid";
                            $result1=$obj->executequery($sqlquery1);
                            $row=mysqli_fetch_array($result1);
                        }
                   ?>     
                   
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">COMPANY NAME</label>
                      <div class="col-sm-9">
                        
                      <select class="form-control form-control-sm" name="ddlcompany">
                      <option value="0">--select--</option>
                      <?php
                      while($display=mysqli_fetch_array($result))
                      {
                      ?>
                      <option value=<?php echo $display['companyid']; ?>
                       <?php echo ($display["companyid"]==$row["companyid"])?"selected=selected":""; ?> > 
                       <?php echo $display['companyname']; ?> </option>
                      <?php
                      }
                      ?>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">model NAME</label>
                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $row['carname']; ?>" name="txtmodel" class="form-control" id="exampleInputEmail2" placeholder="model name" required>
                      </div>
                    </div>
                    <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                    <input type="hidden" name="modelid" value="<?php echo $row["modelid"]; ?>">
                  </form>
                </div>
              </div>
            </div>
</div>
<?php
include_once("footer.php");
?>