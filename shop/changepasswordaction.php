<?php
session_start();
include_once("../dboperation.php");
$obj=new dboperation();
 $sql="select * from tblcarshop where carshopid=".$_SESSION['carshopid'];
$result=$obj->executequery($sql);
$display=mysqli_fetch_array($result);

$uname=$_POST["txtusername"];
$pass=$_POST["txtpassword"];
$newpwd=$_POST["txtnewpassword"];

if($pass==$display["passwordd"])
{
     $sql1="update tblcarshop set passwordd='$newpwd' where carshopid=".$_SESSION['carshopid'];
    $result1=$obj->executequery($sql1);

    if($result1==1)
    {
        echo "<script>alert('Password Changed Successfully....');window.location='profile.php' </script>"; 
    }
}

else
{
    echo "<script>alert('Entered password is wrong....');window.location='index.php' </script>"; 
}
?>