<?php
require_once("../dboperation.php");
$obj = new dboperation();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $value = $_POST['value'];
    $query = "";

    if ($type == 'username') {
        $query = "SELECT * FROM tblcarshop WHERE username='$value'";
    } elseif ($type == 'mobile') {
        $query = "SELECT * FROM tblcarshop WHERE mobile='$value'";
    } elseif ($type == 'email') {
        $query = "SELECT * FROM tblcarshop WHERE email='$value'";
    }

    $result = $obj->executequery($query);
    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>
