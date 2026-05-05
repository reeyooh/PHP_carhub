<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["locationid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["locationid"];
        $sqlquery="DELETE FROM tbllocation WHERE locationid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script>alert('are u sure want to delete'); window.location='viewlocation.php'</script>";

        }
        else
        {
            echo "<script>alert('location Details deletion failed')</script>";   
        }
    }
?>