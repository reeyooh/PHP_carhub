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


        
        $sqlquery="UPDATE tblcarshop SET statuss='rejected' WHERE carshopid=$pid";
        $result=$obj->executequery($sqlquery);
        $bodyContent="Dear,$carshopname Your carshop is Rejected by Admin Because your carshop look like not genuine ..You can Registerd Once more with modifyed carshop details";
        $mailtoaddress=$email;
       
        require('phpmailer9.php');
        if($result==1)
        {
            echo "<script>alert('REJECTED Successfully'); window.location='viewrequest.php'</script>";

        }
        else
        {
            echo "<script>alert('REJECTION failed')</script>";   
        }
    }
?>