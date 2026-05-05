<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['btnupdate']))
    {
        $name=$_POST["txtname"];
        $date=Date('y-m-d');
        $district=$_POST["txtdistrict"];
        $location=$_POST["txtlocation"];
       
        $phone=$_POST["txtmobile"];
        $email=$_POST["txtemail"];
        $image=$_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"],"../uploads/".$image);
        $lic=$_POST["txtlicense"];
        $user=$_POST["txtusername"];
        $pass=$_POST["txtpassword"];
        $sts='requested';
        $sqlquery="SELECT * from tblcarshop WHERE username='$user'" ;
        $result=$obj->executequery($sqlquery);
        $rows=mysqli_num_rows($result);
        if($rows == 0)
        {
             $sqlquery1="INSERT INTO tblcarshop(carshopname,datee,districtid,locationid,mobile,email,photo,license,username,passwordd,statuss)VALUES('$name','$date','$district','$location','$phone','$email','$image','$lic','$user','$pass','$sts')";
            $result1=$obj->executequery($sqlquery1);
          if($result1==1)
            {
              echo "<script>alert('Request sent Successfully to Admin'); 
             </script>";
                
            }
           else
            {
          echo "<script>alert('Request sent failed failed')</script>";
         }

        }
        else
        {
          echo "<script>alert('Username already exist,try with another'); window.location='carshop.php'</script>";
        }

    }
?>
