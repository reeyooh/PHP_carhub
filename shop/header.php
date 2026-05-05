<?php
session_start();
if(!isset($_SESSION["carshopid"]))
{
	header("location:../guest/login.php");
}
include_once("../dboperation.php");
$obj = new dboperation();

$carshop = $_SESSION['carshopid'];
$sql_accepted_count = "SELECT COUNT(*) AS accepted_count FROM tblrequest WHERE carshopid='$carshop' AND statusss='requested'";
$accepted_result = $obj->executequery($sql_accepted_count);
$accepted_accept_count = mysqli_fetch_assoc($accepted_result)['accepted_count'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CarHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css"> <!-- Optional: Remove if not needed anywhere else -->
    
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
        <a class="navbar-brand" href="index.html">Car<span>HUB</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            
            <!-- Report dropdown -->
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="reportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Report</a>
              <div class="dropdown-menu" aria-labelledby="reportDropdown">
                <a class="dropdown-item" href="reportshopsell.php">Selled Cars Report</a>
                <a class="dropdown-item" href="reportdaywisesell.php">Daywise Selled Cars Report</a>
                <a class="dropdown-item" href="reportcomanycount.php">Most Selled Cars Company</a>
                <a class="dropdown-item" href="reportpending.php">Pending Payments </a>
              </div>
            </li>

            <li class="nav-item"><a href="payment/payment.php" class="nav-link">Payment</a></li>
            <li class="nav-item"><a href="viewrequestcus.php" class="nav-link">Requests<?php if($accepted_accept_count  > 0) { echo " ($accepted_accept_count )"; } ?></a></li>
            <li class="nav-item"><a href="viewcar.php" class="nav-link">View Cars</a></li>
            <li class="nav-item"><a href="carreg.php" class="nav-link">Add Cars</a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
  </body>
</html>
