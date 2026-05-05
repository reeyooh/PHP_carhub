<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["districtid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["districtid"];
        $sqlquery="DELETE FROM tbldistrict WHERE districtid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script>alert('are u sure want to delete'); window.location='viewdistrict.php'</script>";

        }
        else
        {
            echo "<script>alert('district Details deletion failed')</script>";   
        }
    }
?>