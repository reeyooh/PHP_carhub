<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Request Page</title>

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

<htm>
    <?php
    
    session_start();
  
    include_once ("../../dboperation.php");
    $obj = new dboperation();
?>
<?php
    $carid = $_GET["carid"];
    $regid = $_SESSION["registerid"];
   
    $sql1= "SELECT * FROM tblcar e
    INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
    INNER JOIN tblcompany l ON e.companyid = l.companyid
    INNER JOIN tblmodel m ON e.modelid = m.modelid
    where e.carid='$carid'";
    $result = $obj-> executequery($sql1);
    $row=mysqli_fetch_array($result);
     $sql2 = "SELECT * FROM tblregister where registerid='$regid'";
    $result1 = $obj-> executequery($sql2);
    $row1=mysqli_fetch_array($result1);

$sql3 = "SELECT * FROM tblrequest where registerid='$regid' and carid='$carid'";
$result3 = $obj-> executequery($sql3);
$row3= mysqli_num_rows($result3);
if($row3==0)
{
	// echo "<script>alert('SENT REQUEST'); </script>";
			
}
else

{
echo "<script>alert('YOU ALREADY REQUESTED THE CAR ONCE'); window.location='../viewcarcustomer.php'</script>";
			
}
if($regid==NULL)
{
	echo "<script>alert('Create account for request'); window.location='../../guest/register.php'</script>";
		
}
	?>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>Send Request</h2>
								<p>The Request can be Acceted by the the Carshop owners According to the Availablity of the Cars</p>
							</div>
						</div>
						<form method="POST" action="request.php">
							
                                <div class="row">
								<div class="">
									<div class="">
									<h4>	Car Name : <?php echo $row['companyname'];?><?php echo $row['carname']; ?> <br>
										Name : <?php echo $row1['regname']; ?><br>
										
										Car shop : <?php echo $row['carshopname']; ?> <br><br><br>
                                      
									   Price :<?php echo $row['price']; ?></h4>
									
									
									</div>
								</div>
							</div>
  
                            
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
								
									</div>
								</div>
                                </div>
                                <div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
										<input type="hidden" name="txtreg" value="<?php echo $row1["registerid"]; ?>">
										<input type="hidden" name="txtcarshop" value="<?php echo $row["carshopid"]; ?>">
										<input type="hidden" name="txtcar" value="<?php echo $row["carid"]; ?>">
										
									
									</div>
								</div>
							</div>
							
							<div class="form-btn">
								<button   class="submit-btn">Sent request to <?php echo $row['carshopname']; ?> </button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>