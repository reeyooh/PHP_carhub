<?php
include_once ("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['btnsubmit'])) {
  $name = $_POST["txtname"];
  $district = $_POST["txtdistrict"];
  $location = $_POST["txtlocation"];
  $pin = $_POST["txtpincode"];
  $date = Date('y-m-d');
  $phone = $_POST["txtmobile"];
  $email = $_POST["txtemail"];
  $user = $_POST["txtusername"];
  $pass = $_POST["txtpassword"];

  // Generate unique registration number
  $sql1 = "SELECT IFNULL(MAX(regnumber), 0) + 1 AS regnumber FROM tblregister";
  $result = $obj->executequery($sql1);
  $display = mysqli_fetch_array($result);
  $registerno = $display['regnumber'];

  // Check if the username already exists in any table
  $sqlquery = "SELECT * FROM tblregister WHERE username='$user'";
  $result = $obj->executequery($sqlquery);

  $sqlquery3 = "SELECT * FROM tblcarshop WHERE username='$user'";
  $result3 = $obj->executequery($sqlquery3);

  $sqlquery4 = "SELECT * FROM tbladmin WHERE username='$user'";
  $result4 = $obj->executequery($sqlquery4);

  $rows = mysqli_num_rows($result);
  $rows3 = mysqli_num_rows($result3);
  $rows4 = mysqli_num_rows($result4);

  $sqlquery6 = "SELECT email from tblregister where email='$email' ";
  $result6 = $obj->executequery($sqlquery6);
  $rows6 = mysqli_num_rows($result6);

  $sqlquery67 = "SELECT mobile from tblregister where mobile='$phone' ";
  $result67 = $obj->executequery($sqlquery67);
  $rows67 = mysqli_num_rows($result67);

  // Check if the username exists in any of the tables
  if ($rows > 0 || $rows3 > 0 || $rows4 > 0) {
    echo "<script>alert('Username Already Exists, TRY AGAIN USING ANOTHER USERNAME'); window.location='register.php'</script>";
  }
  else if($rows6 > 0 ){
    echo "<script>alert('Email Already Exists, TRY AGAIN USING ANOTHER EMAIL'); window.location='register.php'</script>";
  } 
  else if($rows67 > 0 ){
    echo "<script>alert('Mobile Number Already Exists, TRY AGAIN USING ANOTHER MOBILE NUMBER'); window.location='register.php'</script>";
  } else {
    // Insert the new user into the tblregister table
    $sqlquery1 = "INSERT INTO tblregister(regnumber, regname, districtid, locationid, pincode, dateofreg, mobile, email, username, passwordd) 
                  VALUES('$registerno', '$name', '$district', '$location', '$pin', '$date', '$phone', '$email', '$user', '$pass')";
    $result1 = $obj->executequery($sqlquery1);

    // Send email confirmation (using phpmailer)
    $bodyContent = "Dear $name, Your Registration is completed successfully. Thank you for visiting Carhub.";
    $mailtoaddress = $email;
    
    require('phpmailer.php'); // Make sure your phpmailer script is properly included and configured

    if ($result1 == 1) {
      echo "<script>alert('Registered to Carhub Successfully'); window.location='login.php'</script>";
    }
  }
}
?>
