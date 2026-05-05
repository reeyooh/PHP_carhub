<?php
include_once ("../dboperation.php");
$obj = new dboperation();
if (isset($_POST["btnupdate"])) 
{
    $name = $_POST["txtname"];
    $districtid=$_POST["txtdistrict"];
    $locationid=$_POST["txtlocation"];
    $phno=$_POST["txtmobile"];
    $email = $_POST["txtemail"];
    $image = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../Uploads/" . $image);
    $user=$_POST["txtusername"];
    $pass=$_POST["txtpassword"];
    $carshopid=$_POST["carshopid"];
  
       if ($image=="" ) {
         echo  $sql1 = "UPDATE tblcarshop SET carshopname='$name',districtid='$districtid',locationid='$locationid',mobile='$phno',email='$email',username='$user',passwordd='$pass' where carshopid='$carshopid'";
          $result = $obj->executequery($sql1);
           echo "<script>alert('Car shop details Updated Successfully....');window.location='profile.php';</script>";
     } else {
      echo   $sql2 = "UPDATE tblcarshop SET carshopname='$name',districtid='$districtid',locationid='$locationid',mobile='$phno',email='$email',photo='$image',username='$user',passwordd='$pass' where carshopid='$carshopid'";
         $result2 = $obj->executequery($sql2);
          echo "<script>alert('Car shop Details Updated Successfully....');window.location='profile.php';</script>";
     }
  }
 ?>