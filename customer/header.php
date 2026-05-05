<?php
session_start();
if(!isset($_SESSION["registerid"])) {
	header("location:../guest/login.php");
}

include_once("../dboperation.php");
$obj = new dboperation();

$regid = $_SESSION['registerid'];

// SQL to count pending payment requests
$sql_count = "SELECT COUNT(*) AS pending_count FROM tblpayrequest WHERE registerid='$regid' AND s='pending'";
$count_result = $obj->executequery($sql_count);
$pending_payment_count = mysqli_fetch_assoc($count_result)['pending_count'];

// SQL to count accepted requests
$sql_accepted_count = "SELECT COUNT(*) AS accepted_count FROM tblrequest WHERE registerid='$regid' AND statusss='accepted'";
$accepted_result = $obj->executequery($sql_accepted_count);
$accepted_request_count = mysqli_fetch_assoc($accepted_result)['accepted_count'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CarHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Car<span>HUB</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="customerpayment.php" class="nav-link">Payment<?php if($pending_payment_count > 0) { echo " ($pending_payment_count)"; } ?></a></li>
            <li class="nav-item"><a href="viewreply.php" class="nav-link">Requests<?php if($accepted_request_count > 0) { echo " ($accepted_request_count)"; } ?></a></li>
            <li class="nav-item"><a href="viewcarshops.php" class="nav-link">View Carshops</a></li>
            <li class="nav-item"><a href="viewcarcustomer.php" class="nav-link">View Cars</a></li>
            <li class="nav-item"><a href="customerprofile.php" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
  </body>
</html>
