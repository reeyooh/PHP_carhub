<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Booking Form HTML Template</title>

	<!-- Google font -->
	<link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <?php
    
    session_start();
    // include_once("../header.php");
    include_once ("../../dboperation.php");
    $obj = new dboperation();
	$reqid = $_GET["requestid"];
    $shopid = $_SESSION["carshopid"];
   
   
	$sql1= "SELECT * FROM tblrequest e
	INNER JOIN tblregister r ON e.registerid = r.registerid
	  INNER JOIN tbldistrict l ON r.districtid =l.districtid 
		  INNER JOIN tbllocation b ON r.locationid =b.locationid 
		 INNER JOIN tblcar d ON e.carid = d.carid
		 INNER JOIN tblcompany f ON d.companyid =f.companyid 
		  INNER JOIN tblmodel m ON d.modelid =m.modelid  
	 INNER JOIN tblcarshop c ON e.carshopid = c.carshopid where c.carshopid='$shopid' and e.requestid='$reqid'";
    $result = $obj-> executequery($sql1);
    $row=mysqli_fetch_array($result);
	$today = date('d-m-Y');
   
    ?>
    
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>Accepting the request <?php echo $row['regname']; ?></h2>
								<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at</p> -->
							</div>
						</div>
						<form method="POST" action="remark.php">
						<div class="row">
								<div class="">
									<div class="">
									<h4>	
										Date of requested : <?php echo $row['dateee']; ?>    Date of resond:<?php echo $today ?><br>
										Name : <?php echo $row['regname']; ?><br>
										Car Name : <?php echo $row['companyname'];?> <?php echo $row['carname']; ?> <br>
										
                                      
									   Price :<?php echo $row['price']; ?></h4>
									 
									
									</div>
								</div>
							</div>
			
							<!-- <div class="row"> -->
							 <div class="col-md-30">
									<div class="form-group">
										<h4><span class="">Remark ;</span></h4>
										</div>
										<textarea id="description" name="txtremark" id="exampleInputMobile"  rows="4" cols="45" required ></textarea>
										<!-- <input class="form-control"  type="text"  name="txtremark" value="<?php echo $row['remark']; ?>  "> -->
										<input type="hidden" name="requestid" value="<?php echo $row["requestid"]; ?>">
									
								
								</div>
							<!-- </div> -->
							<!-- <div class="form-group">
								<span class="form-label">Room Type</span>
								<select class="form-control" required>
									<option value="" selected hidden>Select room type</option>
									<option>Private Room (1 to 2 People)</option>
									<option>Family Room (1 to 4 People)</option>
								</select>
								<span class="select-arrow"></span>
							</div> -->
							<div class="form-btn">
								<button   class="submit-btn">Sent  to <?php echo $row['regname']; ?> </button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>