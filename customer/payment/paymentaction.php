<?php
include_once("../../dboperation.php");
    $obj=new dboperation();
    
        $car=$_POST['txtcar'];
        $carshop=$_POST['txtcarshop'];
        $regid=$_POST['txtregister'];
       
      $amount = preg_replace("/[^0-9]/", "", $_POST['txtprice']);
        $adminamount=($amount/100)*1.5;
        $carshopamount=$amount-$adminamount;
        $date=Date('Y-m-d');
        $status='payed';
        $type1='carshop';
        $type2='admin';
        $statuss='selled';
        $ss='Payment Sucess';
        $statx='selled';
          $sqlquery ="INSERT tblpayment(carid,carshopid,registerid,amount,dateofpur,sts,typee) values('$car','$carshop','$regid','$carshopamount','$date','$status','$type1')";
        $result=$obj-> executequery($sqlquery);
         $sqlquery2 ="INSERT tblpayment(carid,carshopid,registerid,amount,dateofpur,sts,typee) values('$car','$carshop','$regid','$adminamount','$date','$status','$type2')";
        $result2=$obj->executequery($sqlquery2);

        $sql1 = "UPDATE tblcar SET statz='$statuss' where carid='$car'";
        $result3 = $obj->executequery($sql1);

        $sql6 = "UPDATE tblpayrequest SET s='$ss' where carid='$car'";
        $result6 = $obj->executequery($sql6);
        $sql5 = "UPDATE tblrequest SET statusss='$statx' where carid='$car'";
        $result5 = $obj->executequery($sql5);

        if ($result && $result2 && $result3 && $result5 && $result6 == 1) {
            echo "<script> alert('Payment Successfully....Thankyou for purchase car from carhub...');window.location='../index.php'</script>";
      
          }
      
        else {
          
          echo "<script>alert('payment sent failed'); </script>";
        }
    
?>