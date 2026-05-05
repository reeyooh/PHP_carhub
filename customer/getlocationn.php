<?php
require_once("../dboperation.php");
$obj=new dboperation();
$districtid=$_POST["districtid"];
$sqlquery="select * from tbllocation where districtid='$districtid'";
$result=$obj->executequery($sqlquery);
?>
<select data-mdb-select-init name="divlocation">
 <option value="0">--Select location--</option>
 <?php
                      while($display1=mysqli_fetch_array($result))
                      {
                        ?>
                        <option value="<?php echo $display1["locationid"];?>"><?php echo $display1["locationn"];?></option>
                        <?php
                      }
                      ?>
                    </select>






