<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["registerid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["registerid"];
        echo $sqlquery="DELETE FROM tblregister WHERE registerid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script>alert('are u sure want to delete'); window.location='viewregister.php'</script>";

        }
        else
        {
            echo "<script>alert('Customer deletion is failed')</script>";   
        }
    }
?>