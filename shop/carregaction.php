<?php
include_once ("../dboperation.php");
session_start();
$obj=new dboperation();


if (isset($_POST["btnupdate"])) 
{
 
    $date=Date('y-m-d');
    $companyid=$_POST["txtcompany"];
    $modelid=$_POST["txtmodel"];
    $fuel=$_POST["txtfuel"];
    $modelyear = $_POST["txtmodelyear"];
    $distance = $_POST["txtdistance"];
    $des = $_POST["txtdescription"];
    $price = $_POST["txtprice"];
    $shopid=$_SESSION["carshopid"];
    $status='available';
    
    $image1 = $_FILES["image1"]["name"];
    move_uploaded_file($_FILES["image1"]["tmp_name"], "../Uploads/" . $image1);

    $image2 = $_FILES["image2"]["name"];
    move_uploaded_file($_FILES["image2"]["tmp_name"], "../Uploads/" . $image2);

    $image3 = $_FILES["image3"]["name"];
    move_uploaded_file($_FILES["image3"]["tmp_name"], "../Uploads/" . $image3);

    $image4 = $_FILES["image4"]["name"];
    move_uploaded_file($_FILES["image4"]["tmp_name"], "../Uploads/" . $image4);
    // $image2= $_FILES["image2"]["name"];
    // move_uploaded_file($_FILES["image1"]["tmp_name"], "../Uploads/" . $image2);
    
    
   
         $sql = "INSERT into tblcar(carshopid,datee,companyid,modelid,fuel,yearr,travel,descriptionn,price,photo1,photo2,photo3,photo4,statz)values('$shopid','$date','$companyid','$modelid','$fuel','$modelyear','$distance','$des','$price','$image1','$image2','$image3','$image4','$status')";
        $result=$obj->executequery($sql);
          if($result==1)
            {
               echo "<script>alert('car Details Inserted Successfully'); window.location='viewcar.php'</script>";
                
            }
           else
            {
          echo "<script>alert('car Details Insertion failed')</script>";
         }
        }
    
 ?>