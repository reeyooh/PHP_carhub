<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['btnsubmit']))
    {
        $name=$_POST["txtdistrict"];
         $sqlquery="SELECT * from tbldistrict WHERE district='$name'" ;
        $result=$obj->executequery($sqlquery);
        $rows=mysqli_num_rows($result);
        if($rows==0)
        {
            echo $sqlquery="INSERT INTO tbldistrict(district)VALUES('$name')";
            $result1=$obj->executequery($sqlquery);
             if($result1==1)
            {
           echo "<script> window.location='viewdistrict.php'</script>";
                
            }
             else
            {
         echo "<script>alert('district Details Insertion failed')</script>";
            }
        }
        else
        {
            echo "<script>alert('district Details already exist'); window.location='districtreg.php'</script>";
        }
    }
?>
