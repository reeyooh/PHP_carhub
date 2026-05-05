<?php
include_once("../dboperation.php");
    $obj=new dboperation();
    
        // $remark='';
        // $id='requested';
        $pid=$_GET['requestid'];
        $sqlquery ="DELETE from tblrequest  WHERE requestid='$pid'";
        $result=$obj->executequery($sqlquery);
        if($result==1)
        {
            echo "<script> window.location='viewrequestcus.php'</script>";

        }
        else
        {
            echo "<script>alert('replys failed')</script>";   
        }
    
?>