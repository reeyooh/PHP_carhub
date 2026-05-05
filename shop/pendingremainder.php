<?php
include_once ("../dboperation.php");
$obj = new dboperation();

  $req = $_GET['payrequestid'];
  


  $sql = "SELECT * FROM tblpayrequest e
  INNER JOIN tblregister d ON e.registerid = d.registerid
       INNER JOIN tbldistrict o ON d.districtid = o.districtid
       INNER JOIN tbllocation l ON d.locationid = l.locationid
       INNER JOIN tblcar w ON e.carid = w.carid
          INNER JOIN tblcompany g ON w.companyid = g.companyid
              INNER JOIN tblmodel m ON w.modelid = m.modelid
        where e.payrequestid='$req' and e.s='pending'
";
$result=$obj->executequery($sql);
$display=mysqli_fetch_array($result);
$mailid = $display['email'];
$name = $display['regname'];
$amount=$display['price'];
$company=$display['companyname'];
$car=$display['carname'];
$user=$display['username'];
    $bodyContent="Dear $name, Your have been purchased the car $company$car from ,Your payment was pending rs $amount.quickly settlement the payment please.You can sent payment through our website carhub using the username $user...Thanku u";
    $mailtoaddress=$mailid;
    require('phpmailer.php');
   


?>