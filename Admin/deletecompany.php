<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["companyid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["companyid"];
        $sqlquery="DELETE FROM tblcompany WHERE companyid=$pid";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> alert('are u sure want to delete');window.location='viewcompany.php'</script>";

        }
        else
        {
            echo "<script>alert('company Details deletion failed')</script>";   
        }
    }
?>