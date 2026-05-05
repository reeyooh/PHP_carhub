<?php
require_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_GET["carshopid"])) //questionmark itt pass cheytha variable kodukukaa
    {
        $pid=$_GET["carshopid"];
        $sqlquery1="SELECT * FROM tblcarshop  WHERE carshopid=$pid";
        $result1=$obj->executequery($sqlquery1);
        $row=mysqli_fetch_array($result1);
        $email=$row['email'];
        $carshopname=$row['carshopname'];
        $user=$row['username'];


        $sqlquery="UPDATE tblcarshop SET statuss='accepted' WHERE carshopid=$pid";
        $result=$obj->executequery($sqlquery);

        $bodyContent="Dear,$carshopname Your carshop is acceted by admin..you can login to carhub using your username:$user and password";
        $mailtoaddress=$email;
        // $bodyContent="Dear $name, Your account has been successfully created, Please login using the username $opno";
        // $mailtoaddress=$email;
        require('phpmailer.php');
        if($result==1)
        {
            echo "<script> window.location='viewrequest.php'</script>";

        }
        else
        {
            echo "<script>alert('Carshop Details Accepted failed')</script>";   
        }
    }
?>