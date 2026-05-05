<?php
include_once("../dboperation.php");
$obj = new dboperation();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type']; // Type can be 'email', 'mobile', or 'username'
    $value = $_POST['value'];

    if ($type === 'email') {
        $sql = "SELECT * FROM tblregister WHERE email = '$value'";
    } elseif ($type === 'mobile') {
        $sql = "SELECT * FROM tblregister WHERE mobile = '$value'";
    } elseif ($type === 'username') {
        $sql = "SELECT * FROM tblregister WHERE username = '$value'";
    } else {
        echo json_encode(['status' => false, 'message' => 'Invalid type']);
        exit;
    }

    $result = $obj->executequery($sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => true, 'message' => ucfirst($type) . ' already exists']);
    } else {
        echo json_encode(['status' => false, 'message' => ucfirst($type) . ' is available']);
    }
}
?>
