<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['btnsubmit']))
    {
        $dis=$_POST["txtdistrict"];
        $loc=$_POST["txtlocation"];
        $sqlquery="SELECT * from tbllocation WHERE locationn='$loc'" ;
        $result=$obj->executequery($sqlquery);
        $rows= mysqli_num_rows($result);
        if($rows==0)
        {
            echo $sqlquery="INSERT INTO tbllocation (districtid,locationn)VALUES('$dis','$loc')";
   
            $result=$obj->executequery($sqlquery);
            if($result==1)
            {
                echo "<script>alert('location Details Inserted Successfully'); window.location='viewlocation.php'</script>";
                
            }
            else
            {
                echo "<script>alert('location Details Insertion failed')</script>";
            }
        }
        else
        {
            echo "<script>alert('location Details already exist'); window.location='locationreg.php'</script>";
        }
    }
?>
