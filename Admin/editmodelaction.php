<?php
include_once ("../dboperation.php");
$obj = new dboperation();
if (isset($_POST["btnupdate"])) 
{
    $model = $_POST["txtmodel"];
    $companyid = $_POST["ddlcompany"];
    $modelid=$_POST["modelid"];
   
       echo $sqlquery = "UPDATE tblmodel SET carname='$model',companyid='$companyid' WHERE modelid='$modelid'";
       $result = $obj->executequery($sqlquery);
  
        if ($result == 1) 
        
        {
            echo "<script>alert('updated locationSuccessfully');window.location='viewmodel.php'</script>";
        }
         else 
         {
            echo "<script>alert('Updation Failed')</script>";

    }

}
?>
