<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['btnsubmit']))
    {
        $dis=$_POST["txtcompany"];
       
        $loc=$_POST["txtname"];
        echo $sqlquery="SELECT * from tblmodel WHERE carname='$loc'" ;
        $result=$obj->executequery($sqlquery);
        $rows= mysqli_num_rows($result);
        if($rows==0)
        {
            echo $sqlquery1="INSERT INTO tblmodel (companyid,carname)VALUES('$dis','$loc')";
   
            $result1=$obj->executequery($sqlquery1);
            if($result1==1)
            {
                echo "<script>alert('car name Details Inserted Successfully'); window.location='viewmodel.php'</script>";
                
            }
            else
            {
                echo "<script>alert('car name Details Insertion failed')</script>";
            }
        }
    }
?>
