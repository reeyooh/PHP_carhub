<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["modelid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["modelid"];
        $sqlquery="DELETE FROM tblmodel WHERE modelid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> alert('are u sure want to delete');window.location='viewmodel.php'</script>";

        }
        else
        {
            echo "<script>alert('Car name Details deletion failed')</script>";   
        }
    }
?>