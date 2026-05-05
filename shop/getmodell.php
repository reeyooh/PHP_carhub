<?php
require_once("../dboperation.php");
$obj=new dboperation();
$companyid=$_POST["companyid"];
$sqlquery="select * from tblmodel where companyid='$companyid'";
$result=$obj->executequery($sqlquery);
?>
<select data-mdb-select-init name="divmodel">
 <option value="0">--SELECT model--</option>
 <?php
                      while($display1=mysqli_fetch_array($result))
                      {
                        ?>
                        <option value="<?php echo $display1["modelid"];?>"><?php echo $display1["carname"];?></option>
                        <?php
                      }
                      ?>
                    </select>


