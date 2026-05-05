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
	include_once("../../dboperation.php");
	$obj = new dboperation();
	$regid = $_GET["regnumber"];
	$shopid = $_SESSION["carshopid"];





	$carid = $_GET["carid"];
	// $regid=$_POST["txtreg"];
//    $regid=$_POST["txtreg"];
	



	$sql1 = "SELECT * FROM tblregister e
    INNER JOIN tbldistrict l ON e.districtid =l.districtid 
        INNER JOIN tbllocation b ON e.locationid =b.locationid  where e.regnumber='$regid'";
	$result1 = $obj->executequery($sql1);

	$row1 = mysqli_fetch_array($result1);

	// if($row1==0)
	// {
	// 	echo "<script>alert('Enter valid customer id'); window.location='payment.php'</script>";
	// }
	
	// $row1=mysqli_fetch_array($result1);
	$sql2 = "SELECT * FROM tblcar q INNER JOIN tblcarshop d ON q.carshopid =d.carshopid INNER JOIN tblcompany w ON q.companyid =w.companyid INNER JOIN tblmodel m ON q.modelid =m.modelid where q.carid='$carid'";
	$result2 = $obj->executequery($sql2);
	$row2 = mysqli_fetch_array($result2);


	//      $sql1= "SELECT * FROM tblregister 
//    where registerid='$regid'";
//     $result1 = $obj-> executequery($sql1);
	
	// 	$row1=mysqli_num_rows($result1);
	?>
	<!-- <script src="../../jquery-3.7.1.min.js"></script> -->
	<!-- <script>
  $(document).ready(function () {
	//   alert("Successful");
	$("#companyid").change(function () {
	  var companyid = $(this).val();
	//    alert (companyid)
	  $.ajax({
		type: "POST",
		url: "getmodell.php",
		data: "companyid=" + companyid,
		success: function (data) {
		  $("#divmodel").html(data);
		}
	  });

	});
  });
</script> -->
	<!-- <form method="OST" action="paymentaction.php"> -->
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>Payment details:<?php echo $row2['carshopname']; ?></h2>
								<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at</p> -->
							</div>
						</div>
						<form method="post" action="paymentaction.php">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<!-- <span class="form-label"> company : </span> -->
										<h4><span class="">Customer no.<?php echo $row1['regnumber']; ?></span><br>
											<span class="">Customername :<?php echo $row1['regname']; ?></span><br>
											<span class="">Carname :<?php echo $row2['companyname']; ?>
												<?php echo $row2['carname']; ?></span><br>
											<span class="">Model year :<?php echo $row2['yearr']; ?></span><br>
											<span class="">Fuel :<?php echo $row2['fuel']; ?></span>
										</h4><br>

										<!-- <span class="form-label">price_<?php echo $row2['price']; ?></span> -->

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<h3><span class="">Price:</span></h3>
										<h3><input class="" type="text" value="<?php echo $row2['price'] ?>"
												name="txtprice">
											<h3>
												<input type="hidden" value="<?php echo $row2['carshopid'] ?>"
													name="txtcarshop">
												<input type="hidden" value="<?php echo $row1['registerid'] ?>"
													name="txtregister">
												<input type="hidden" value="<?php echo $row2['carid'] ?>" name="txtcar">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<span class="form-label">Car shop : <?php echo $row2['carshopname']; ?> </span>
									<!-- <input class="form-control"  <?php echo $row['carshopid']; ?>> -->

									<!-- <select class="form-control">
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
										<span class="select-arrow"></span> -->
								</div>
							</div>

							<!-- <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										
										<div class="col-md-6">
					  <a href="../viewpaycar.php"  class="form-label">Selectcar</a>
			
					  </div>
									</div>
								</div> -->
							<!-- <div class="row">
				 <div class="col-md-6">
				 <div class="form-group">
				<label class="form-label">CAR COMPANY</label>
			  
				  <select class="form-label" name="txtcompany" id="companyid">
					<option value="0">select company</option>

					<?php
					// $sql = 'select * from tblcompany';
					// $result = $obj->executequery($sql);
					// while ($row = mysqli_fetch_array($result)) {
					//   ?>
					//   <option value="<?php echo $row['companyid'] ?>"> <?php echo $row['companyname']; ?> </option>
					//   <?php
					// }
					?>
				  </select>
				</div>
			  </div>
			  </div>



			   <div class="row">
				 <div class="col-md-6">
				 <div class="form-group">
				<label class="form-label">Car Name</label>
				  <select class="form-label" name="txtmodel" id="divmodel">
					<option value="0">select car name</option>

				  </select>
				</div>
			  </div> -->




							<?php
							//         if(isset($_POST['Search']))
							//         {
							//           $i = 1;
							//           while ($row = mysqli_fetch_array($result)) {
							//             ?>
							<!-- <tr>
				
				 
	   <td><?php echo $row2["companyname"]; ?> <?php echo $row2["carname"]; ?></td>
	   <td><img src="../uploads/<?php echo $row2["photo1"]; ?>" style="width:50px; height:30px;"></td>

	 
			   
			   </tr> -->
							<?php
							//  }
							// }
							?>


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
								<button type="submit" class="submit-btn" name="submit">send Pay Request </button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>