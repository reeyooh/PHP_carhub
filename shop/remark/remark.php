<?php
include_once("../../dboperation.php");
    $obj=new dboperation();
    
        $remark=$_POST['txtremark'];
        $pid=$_POST['requestid'];
    
        $sts='accepted';
        $date=Date('Y-m-d');
         $sqlquery ="UPDATE tblrequest SET remark='$remark',statusss='$sts',dateee='$date' WHERE requestid='$pid'";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> window.location='../viewrequestcus.php'</script>";

        }
        else
        {
            echo "<script>alert('replys failed')</script>";   
        }
    
?>