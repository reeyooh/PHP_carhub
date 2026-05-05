
<?php
//  include_once("header.php");
require_once("../dboperation.php");
    $obj=new dboperation();
    $districtid=$_POST["districtid"];
    $sqlquery="SELECT * FROM tblcarshop e  INNER JOIN tbldistrict d ON e.districtid=d.districtid INNER JOIN tbllocation l ON e.locationid=l.locationid where e.districtid='$districtid' and statuss='accepted'";

    $result=$obj->executequery($sqlquery)
?>
<!-- <div class="col-lg-6 grid-margin stretch-card"> -->

                    <table class="table table-hover" id="carshopid">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CARSHOPE NAME</th>
                          <th>DATE</th>
                          <!-- <th>DISTRICT</th> -->
                          <th>LOCATION</th>
                          <th>MOBILE</th>
                          <th>photo </th>
                          <th>USERNAME </th>
                          <th> PASSWORD</th>
                          <th>EDIT</th>
                          <th>DELETE</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                        $i=1;
                        while($display=mysqli_fetch_array($result))
                        {
                            ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $display["carshopname"]; ?></td>
                          <td><?php echo $display["datee"]; ?></td>
                          <!-- <td><?php echo $display["district"]; ?></td> -->
                          <td><?php echo $display["locationn"]; ?></td>
                          <td><?php echo $display["mobile"]; ?></td>
                          <td><img src="../uploads/<?php echo $display["photo"]; ?>" style="width:80px; height:60px;"></td>
                          <td><?php echo $display["username"]; ?></td>
                          <td><?php echo $display["passwordd"];?></td>
                          <td>

                          <a href="editcarshop.php?carshopid=<?php echo $display["carshopid"];?>">
                        <input type='button' class="btn btn-info" value="edit"></a>
                        </td>
                        <td>
                        <a href="deletecarshop.php?carshopid=<?php echo $display["carshopid"];?>" onclick="return confirm('are you sure want to delete?')">
                            <input type='button' class="btn btn-danger" value="Delete"></a>
                        </td>
                        </tr>
                          <?php
                          }
                          ?>
                        </div>
                        </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    //  include_once ('footer.php');
    ?>