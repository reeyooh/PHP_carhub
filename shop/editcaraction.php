<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();

$company = $_POST["txtcompany"];
$model = $_POST["txtmodel"];
$fuell = $_POST["txtfuel"];
$modelyear = $_POST["txtmodelyear"];
$distance = $_POST["txtdistance"];
$pricee = $_POST["txtprice"];
$description = $_POST["txtdescription"];
$carid = $_POST["carid"];


$image1 = $_FILES["image1"]["name"];
$image2 = $_FILES["image2"]["name"];
$image3 = $_FILES["image3"]["name"];
$image4 = $_FILES["image4"]["name"];


if (!empty($image1)) {
    move_uploaded_file($_FILES["image1"]["tmp_name"], "../Uploads/" . $image1);
}
if (!empty($image2)) {
    move_uploaded_file($_FILES["image2"]["tmp_name"], "../Uploads/" . $image2);
}
if (!empty($image3)) {
    move_uploaded_file($_FILES["image3"]["tmp_name"], "../Uploads/" . $image3);
}
if (!empty($image4)) {
    move_uploaded_file($_FILES["image4"]["tmp_name"], "../Uploads/" . $image4);
}


$sql = "UPDATE tblcar SET companyid='$company', modelid='$model', fuel='$fuell', yearr='$modelyear', travel='$distance', price='$pricee', descriptionn='$description'";
if (!empty($image1)) {
    $sql .= ", photo1='$image1'";
}
if (!empty($image2)) {
    $sql .= ", photo2='$image2'";
}
if (!empty($image3)) {
    $sql .= ", photo3='$image3'";
}
if (!empty($image4)) {
    $sql .= ", photo4='$image4'";
}

$sql .= " WHERE carid='$carid'";

$result = $obj->executequery($sql);

if ($result) {
    echo "<script>window.location='viewcar.php';</script>";
} else {
    echo "<script>alert('Failed to update car details'); window.location='editcar.php';</script>";
}
?>
