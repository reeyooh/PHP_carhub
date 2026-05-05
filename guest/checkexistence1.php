<?php
include_once("../dboperation.php");
$obj = new dboperation();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $value = $_POST['value'];

    $sql = "";
    if ($type === 'email') {
        $sql = "SELECT * FROM tblcarshop WHERE email = '$value'";
    } elseif ($type === 'mobile') {
        $sql = "SELECT * FROM tblcarshop WHERE mobile = '$value'";
    } elseif ($type === 'username') {
        $sql = "SELECT * FROM tblcarshop WHERE username = '$value'";
    }

    $result = $obj->executequery($sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => true, 'message' => ucfirst($type) . ' already exists.']);
    } else {
        echo json_encode(['status' => false, 'message' => ucfirst($type) . ' is available.']);
    }
}
?>
