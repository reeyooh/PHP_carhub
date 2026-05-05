<?php
session_start();
include_once("../dboperation.php");
$obj=new dboperation();
 $sql="select * from tblregister where registerid=".$_SESSION['registerid'];
$result=$obj->executequery($sql);
$display=mysqli_fetch_array($result);

$uname=$_POST["txtusername"];
$pass=$_POST["txtpassword"];
$newpwd=$_POST["txtnewpassword"];

if($pass==$display["passwordd"])
{
    echo $sql1="update tblregister set passwordd='$newpwd' where registerid=".$_SESSION['registerid'];
    $result1=$obj->executequery($sql1);

    if($result1==1)
    {
        echo "<script>alert('Password Changed Successfully....');window.location='customerprofile.php' </script>"; 
    }
}

else
{
    // echo "<script>alert('Entered password is wrong....');window.location='changepassword.php' </script>"; 
}
?>