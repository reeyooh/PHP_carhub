<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["requestid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["requestid"];
        $sqlquery="DELETE FROM tblrequest WHERE requestid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> window.location='viewreply.php'</script>";

        }
        else
        {
            echo "<script>alert('failed')</script>";   
        }
    }
?>