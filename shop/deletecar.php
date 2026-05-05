<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["carid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["carid"];
         $sqlquery="DELETE FROM tblcar WHERE carid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script>alert('Car removed Successfully'); window.location='viewcar.php'</script>";

        }
        else
        {
            echo "<script>alert('Car deletion is failed')</script>";   
        }
    }
?>