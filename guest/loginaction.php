<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();
$username = $_POST["txtusername"];
$password = $_POST["txtpassword"];
if (isset($_POST["btnsubmit"])) {
    $sqlquery = "SELECT * FROM tbladmin where username='$username' and passwordd='$password'";
    $result = $obj->executequery($sqlquery);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION["adminid"] = $username;
        $_SESSION["adminid"] = $row["adminid"];

        header("location:../admin/index.php");
    } else {
        $query = "SELECT * FROM tblregister where username='$username' and passwordd='$password'";
        $result1 = $obj->executequery($query);

        if (mysqli_num_rows($result1) == 1) {
            $row = mysqli_fetch_array($result1);
            $_SESSION["username"] = $username;
            $_SESSION["registerid"] = $row["registerid"];
            header("location:../customer/index.php");
            exit(); // Exit after redirection
        } 
        else {
            $sql = "SELECT * FROM tblcarshop where username='$username' and passwordd='$password'";
            $result2 = $obj->executequery($sql);
            if (mysqli_num_rows($result2) == 1) {
                $row = mysqli_fetch_array($result2);
                $_SESSION["username"] = $username;
                $_SESSION["carshopid"] = $row["carshopid"];
                header("location:../shop/index.php");
            }
            else {
                echo "<script>alert('Invalid Username/Password!!');window.location='login.php'</script>";
                exit(); // Exit after redirection
            }
     }
}
}
?>