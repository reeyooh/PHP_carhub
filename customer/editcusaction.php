<?php
session_start();
include_once ("../dboperation.php");
$obj = new dboperation();
$regid = $_SESSION["registerid"];
if (isset($_POST["btnupdate"])) 
{
    $name = $_POST["txtname"];
    $districtid=$_POST["txtdistrict"];
    $locationid=$_POST["txtlocation"];
    $pin=$_POST["txtpincode"];
    $phno=$_POST["txtmobile"];
    $email = $_POST["txtemail"];
   
    $user=$_POST["txtusername"];
    // $pass=$_POST["txtpassword"];
    // $regid=$_POST["registerid"];
  
   
          $sql1 = "UPDATE tblregister SET regname='$name',districtid='$districtid',locationid='$locationid',pincode='$pin',mobile='$phno',email='$email',username='$user' where registerid='$regid'";
          $result = $obj->executequery($sql1);
           
           if($result == 1)
           {
              echo"<script> window.location='customerprofile.php'</script>";
           }
           else
           {
               echo"<script>alert('register Details Updation Failed')</script>";
           } 
        }
 ?>
