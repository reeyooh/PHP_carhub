<?php
require_once("../dboperation.php");
$obj=new dboperation();
$districtid=$_POST["districtid"];
$sqlquery="select * from tbllocation where districtid='$districtid'";
$result=$obj-> executequery($sqlquery);
?>
<select data-mdb-select-init name="divlocation">
 <option value="0">--SELECT LOCATION--</option>
 <?php
                      while($display=mysqli_fetch_array($result))
                      {
                        ?>
                        <option value="<?php echo $display["locationid"];?>"><?php echo $display["locationn"];?></option>
                        <?php
                      }
                      ?>
                    </select>





