<?php
include_once("header.php");
require_once("../dboperation.php");
    $obj=new dboperation();
    $sqlquery="SELECT * FROM tbldistrict";
    $result=$obj->executequery($sqlquery);
?>

<div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DISTRICT DETAILS</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>DISTRICT NAME</th>
                          <th>EDIT</th>
                          <th>DELETE</th>
                        </tr>
                      </thead>
                      <tbody>
                      <!-- <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="districtreg.php"'>
                     Registration </button>
            </div> -->

                        <?php
                        $i=1;
                        while($display=mysqli_fetch_array($result))
                        {
                            ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $display["district"]; ?></td>
                        <td>
                        <a href="editdistrict.php?districtid=<?php echo $display["districtid"];?>">
                        <input type='button' class="btn btn-info" value="edit"></a> 
                        </td>
                        <td>
                   
                            <a href="deletedistrict.php?districtid=<?php echo $display["districtid"];?>"onclick="return confirm('are you sure want to delete')"
                            >
                            <input type='button' class="btn btn-danger" value="Delete"></a> 
                        </td>
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