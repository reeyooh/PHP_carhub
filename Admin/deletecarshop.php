<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["carshopid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["carshopid"];
        echo $sqlquery="DELETE FROM tblcarshop WHERE carshopid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> window.location='viewcarshop.php'</script>";

        }
        else
        {
            echo "<script>alert('Car shop deletion is failed')</script>";   
        }
    }
?>