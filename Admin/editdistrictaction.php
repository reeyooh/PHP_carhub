<?php
    include_once("../dboperation.php");
    $obj= new dboperation();
    if(isset($_POST["btnupdate"]))
    {
        $districtid=$_POST["districtid"];
        $name=$_POST["txteditdistrict"];
        $sqlquery1="UPDATE tbldistrict SET district='$name' where districtid='$districtid' ";
        $result1=$obj->executequery($sqlquery1);
        if($result1 == 1)
        {
           echo"<script> window.location='viewdistrict.php'</script>";
        }
        else
        {
            echo"<script>alert('district Details Updation Failed')</script>";
        }   
    }
?>
