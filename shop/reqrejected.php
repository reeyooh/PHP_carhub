<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["requestid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["requestid"];
        $sqlquery="UPDATE tblrequest SET statusss='rejected' WHERE requestid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script>alert('REJECTED Successfully'); window.location='viewrequestcus.php'</script>";

        }
        else
        {
            echo "<script>alert('REJECTION failed')</script>";   
        }
    }
?>