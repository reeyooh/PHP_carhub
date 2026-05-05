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
if($row==0)
{
    echo "<script>alert('Entered username is wrong....');window.location='forgotpassword.php' </script>"; 
}

else
{
$randomString = generateRandomString();
$sql2="update tblregister set passwordd='$randomString' where username='$uname'";
$result=$obj->executequery($sql2);
echo "<script>alert('Successfully reset your password. New password is send to your mail,please check it....');window.location='../guest/login.php' </script>";
$bodyContent="Dear $uname, Your New Password is:$randomString";
$mailtoaddress=$display["email"];
require('phpmailer4.php');

echo "<script>window.location='../guest/login.php'</script>";
    
}
?>