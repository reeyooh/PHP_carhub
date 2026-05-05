<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['registerid'])) {
    $registerid = $_POST['registerid'];

    $sql = "SELECT * FROM tblregister r
            INNER JOIN tbldistrict d ON r.districtid = d.districtid
            INNER JOIN tbllocation l ON r.locationid = l.locationid
            WHERE r.registerid = '$registerid'";
    $result = $obj->executequery($sql);

    if (mysqli_num_rows($result) > 0) {
        $details = mysqli_fetch_assoc($result);
        echo json_encode($details);
    } else {
        echo json_encode(["error" => "No details found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
