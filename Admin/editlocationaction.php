<?php
include_once ("../dboperation.php");
$obj = new dboperation();
if (isset($_POST["btnupdate"])) 
{
    $locationname = $_POST["txtlname"];
    $districtid = $_POST["ddldistrict"];
    $locationid=$_POST["locationid"];
   
        $sqlquery = "UPDATE tbllocation SET locationn='$locationname',districtid='$districtid' WHERE locationid='$locationid'";
       $result = $obj->executequery($sqlquery);
  
        if ($result == 1) 
        
        {
            echo "<script>window.location='viewlocation.php'</script>";
        }
         else 
         {
            echo "<script>alert('Updation Failed')</script>";

    }

}
?>
