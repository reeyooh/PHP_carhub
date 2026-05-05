<?php
function generateRandomString($length = 10) 
{
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $randomString = substr(str_shuffle($characters), 0, $length);

   return $randomString;
}
?>


<?php
include_once("../dboperation.php");
$obj=new dboperation();
$uname=$_POST["txtusername"];
$sql="select * from tblregister where username='$uname'";

$result=$obj->executequery($sql);
$display=mysqli_fetch_array($result);
$row=mysqli_num_rows($result);

$sql1="select * from tblcarshop where username='$uname'";

    $result1=$obj->executequery($sql1);
    $display1=mysqli_fetch_array($result1);
    $rows=mysqli_num_rows($result1);
if($row== 1 || $rows==1)
{
    if($row==1){
        $randomString = generateRandomString();
$sql2="update tblregister set passwordd='$randomString' where username='$uname'";
$result=$obj->executequery($sql2);
echo "<script>alert('Successfully reset your password. New password is send to your mail,please check it....');window.location='login.php' </script>";
$bodyContent="Dear $uname, Your New Password is:$randomString";
$mailtoaddress=$display["email"];
require('phpmailer3.php');
}
else{
        $randomString = generateRandomString();
$sql3="update tblcarshop set passwordd='$randomString' where username='$uname'";
$result=$obj->executequery($sql3);
echo "<script>alert('Successfully reset your password. New password is send to your mail,please check it....');window.location='login.php' </script>";
$bodyContent="Dear $uname, Your New Password is:$randomString";
$mailtoaddress=$display1["email"];
require('phpmailer3.php');
     }


    }
    else{
        echo "<script>alert('Entered username is wrong....');window.location='forgotpassword.php' </script>"; 

    }

?>