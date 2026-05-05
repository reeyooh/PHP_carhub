<?php

require_once("../../dboperation.php");
    $obj=new dboperation();

    $regid=$_POST['txtreg'];
    $car=$_POST['txtcarshop'];
    $shopid=$_POST['txtcar'];
    $remark='';
   
    $sts='requested';
    
    
       $date=date('y-m-d');
           $sqlquery="INSERT INTO tblrequest(registerid,carshopid,carid,dateee,statusss,remark)values('$regid','$car','$shopid','$date','$sts','$remark')";
        $result=$obj-> executequery($sqlquery);
        if($result==1)
        {
            echo "<script> window.location='../viewreply.php'</script>";

        }
        else
        {
            echo "<script>alert('request sent failed</script>";   
        }
    
    
?>