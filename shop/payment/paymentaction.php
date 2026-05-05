<?php
include_once("../../dboperation.php");
$obj = new dboperation();

$car = $_POST['txtcar'];
$price = $_POST['txtprice'];
$regid = $_POST['txtregister'];
$ss = 'pending';
$s = 'paymentreq';

 $sql = "select * from tblpayrequest where carid='$car' and registerid='$regid'";
$resultt = $obj->executequery($sql);
$rows = mysqli_num_rows($resultt);
if ($rows == 0) {


  $sqlquery = "INSERT tblpayrequest(carid,registerid,s) values('$car','$regid','$ss')";
  $result = $obj->executequery($sqlquery);

  $sql = "update tblcar set statz='$s' ,price='$price'where carid='$car'";
  $result1 = $obj->executequery($sql);




  $sql3 = "SELECT * FROM tblcar w
         INNER JOIN tblcompany g ON w.companyid = g.companyid
              INNER JOIN tblmodel m ON w.modelid = m.modelid
               INNER JOIN tblcarshop i ON w.carshopid = i.carshopid
              where w.carid='$car'";
  $result3 = $obj->executequery($sql3);
  $display3 = mysqli_fetch_array($result3);

  $amount = $display3['price'];
  $company = $display3['companyname'];
  $cara = $display3['carname'];
  $carshop = $display3['carshopname'];

  $sql4 = "SELECT * FROM  tblregister 
        where registerid='$regid'";
  $result4 = $obj->executequery($sql4);
  $display4 = mysqli_fetch_array($result4);

  $user = $display4['username'];
  $mailid = $display4['email'];
  $name = $display4['regname'];



  $bodyContent = "Dear $name, Thanku for purchasing Car from Carhub,You have been purchased the car $company$cara from $carshop for Rs.$amount.You can sent payment through Website using the username.$user.Thanku for visit carhub";
  $mailtoaddress = $mailid;
  include('phpmailer1.php');
  echo "<script>alert('payment Successfull'); window.location='../index.php'</script>";
} else {
  echo "<script>alert('Already payment Request sent'); window.location='../index.php'</script>";

}


?>