<?php
include ("../dboperation.php");
$obj = new dboperation();
// if (isset($_POST['btnupdate']))
//  {
    $name = $_POST['txteditcompany'];
    $description= $_POST['txteditdescription'];
    $companyid = $_POST['companyid'];
    $img = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../Uploads/" . $img);
    
     if ($img=="" ) {
       echo  $sql1 = "UPDATE tblcompany SET companyname='$name',companydescription='$description' where companyid='$companyid'";
         $result = $obj->executequery($sql1);
          echo "<script>window.location='viewcompany.php';</script>";
    } else {
         echo $sql2 = "UPDATE tblcompany SET companyname='$name',companydescription='$description',photo='$img' where companyid='$companyid'";
        $result2 = $obj->executequery($sql2);
         echo "<script>alert('Data Updated Successfully....');window.location='viewcompany.php';</script>";
    }
//  }
?>