<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['btnsubmit']))
    {
     
        $name=$_POST["txtcompanyname"];
        $description=$_POST["txtcompanydescription"];
        $image=$_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"],"../uploads/".$image);
        $sqlquery="SELECT * from tblcompany WHERE companyname='$name'" ;
        $result=$obj->executequery($sqlquery);
        $rows=mysqli_num_rows($result);
        if($rows == 0)
        {
             $sqlquery1="INSERT INTO tblcompany(companyname,companydescription,photo)VALUES('$name','$description','$image')";
            $result1=$obj->executequery($sqlquery1);
          if($result1==1)
            {
              echo "<script> window.location='viewcompany.php'</script>";
                
            }
           else
            {
          echo "<script>alert('company Details Insertion failed')</script>";
         }
        }

      else{
        echo "<script>alert('company Details duplicate found'); window.location='carcompany.php'</script>";
              
      }

    }
?>
