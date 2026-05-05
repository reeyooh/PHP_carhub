<?php
session_start();
if(!isset($_SESSION["adminid"]))
{
	header("location:../guest/login.php");
}

require_once("../dboperation.php");
$obj = new dboperation();

// Query to count the pending requests
$requestQuery = "SELECT COUNT(*) AS request_count FROM tblcarshop WHERE statuss = 'requested'";
$requestResult = $obj->executequery($requestQuery);
$requestCount = mysqli_fetch_assoc($requestResult)["request_count"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CarHub</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="Assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="Assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="Assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="Assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="Assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="Assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="Assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="Assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="Assets/images/logo.svg" class="mr-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img src="Assets/images/logo-mini.svg"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                </div>
               
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Registration</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="districtreg.php">District Registration</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="locationreg.php">location registration</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                        href="carcompany.php">Car company </a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                        href="model.php">car model</a></li>
                                <!-- <li class="nav-item"> <a class="nav-link"
                                        href="carshop.php">Car shop Registration </a></li> -->
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">View</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="viewdistrict.php">District View</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="viewlocation.php">location View</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                        href="viewcompany.php">Company view </a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                        href="viewmodel.php">model view</a></li>
                                <!-- <li class="nav-item"> <a class="nav-link"
                                        href="carshop.php">Car shop View </a></li> -->
                            </ul>
                        </div>
                    </li>
                

                    <li class="nav-item">
                        <a class="nav-link" href="viewcarshop.php">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">View Carshop's</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewrequest.php">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">View Request<?php if($requestCount > 0) { echo " ($requestCount)"; } ?></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="viewregister.php">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">view Customers's</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcustomers.php">Customers Report
                                        </a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcustomercount.php">Customer count
                                        </a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcarshop.php">Carshop Report
                                        </a></li> 
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcarshopsell.php">Selled cars Report
                                        </a></li> 
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportdaywisesell.php">Cars DateWise Report
                                        </a></li> 
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcompanycount.php"> Company count Report
                                        </a></li> 
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="reportcarshopcount.php"> carshop count Report
                                        </a></li> 
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>