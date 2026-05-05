<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Form HTML Template</title>

    <!-- Google fonts -->
    <link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Alice', serif;
            background-color: #f7f7f7;
        }

        .section {
            background-color: #fff;
            padding: 50px 0;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: #333;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            font-size: 16px;
            padding: 15px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .submit-btn {
            background-color: #28a745;
            color: #fff;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .price h2 {
            font-size: 28px;
            color: #dc3545;
            margin-top: 0;
        }

        .price-label {
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .payment-option img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }

        .payment-option input[type="radio"] {
            margin-right: 15px;
        }

        .payment-option label {
            font-size: 16px;
        }
    </style>

    <script>
        function toggleCvvVisibility() {
            const cvvInput = document.getElementById('cvv');
            if (cvvInput.type === "password") {
                cvvInput.type = "text";
            } else {
                cvvInput.type = "password";
            }
        }
    </script>

</head>

<body>
    <?php
    session_start();
    include_once("../../dboperation.php");
    $obj = new dboperation();
    $car = $_GET["carid"];
    $register = $_SESSION["registerid"];
    $sql1 = "SELECT * FROM tblregister e
        INNER JOIN tbldistrict l ON e.districtid =l.districtid 
        INNER JOIN tbllocation b ON e.locationid =b.locationid  
        WHERE e.registerid='$register'";
    $result1 = $obj->executequery($sql1);
    $row1 = mysqli_fetch_array($result1);

    $sql2 = "SELECT * FROM tblcar q 
        INNER JOIN tblcarshop d ON q.carshopid =d.carshopid 
        INNER JOIN tblcompany w ON q.companyid =w.companyid 
        INNER JOIN tblmodel m ON q.modelid =m.modelid 
        WHERE q.carid='$car'";
    $result2 = $obj->executequery($sql2);
    $row2 = mysqli_fetch_array($result2);
    ?>

    <div id="booking" class="section">
        <div class="container">
            <div class="row">
                <div class="booking-form">
                    <div class="form-header">
                        <h2>Payment details: <?php echo $row2['carshopname']; ?></h2>
                    </div>
                    <form method="post" action="paymentaction.php">
                        <div class="form-group">
                            <label for="">Person Name</label>
                            <select class="form-control" name="" id="exampleInputUsername1">
                                <option value="<?php echo $row1['regname']; ?>"><?php echo $row1['regname']; ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Card number</label>
                            <input type="text" class="form-control" name="card_number" minlength="12" maxlength="12"   pattern="[0-9]{12}" placeholder="1234 4567 8910" required>
                        </div>

                        <!-- <div class="form-group">
                            <label for="">Expiry</label>
                            <input type="text" class="form-control" name="expiry" placeholder="MM/YYYY" required
                                   pattern="^(0[1-9]|1[0-2])\/\d{4}$" title="Enter expiry date in MM/YYYY format (e.g., 12/2024)">
                        </div> -->
                        <div class="my-3">
    <p class="dis fw-bold mb-2">Expiry Date</p>
    <input type="text" required class="form-control px-0" name="expiry" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/?([0-9]{2})$"
        <?php echo 'min="' . date('m/y') . '"'; ?> title="Please enter a valid expiry date"
        oninput="validateExpiryDate(this)">
</div>

<script>
function validateExpiryDate(input) {
    const value = input.value;
    const currentDate = new Date();
    
    // Get current month and year to compare
    const currentMonth = currentDate.getMonth() + 1;  // Get current month (1-based)
    const currentYear = currentDate.getFullYear();
    
    // Extract month and year from input (MM/YY format)
    const [month, year] = value.split('/');
    
    // Ensure the month and year are valid
    if (!month || !year || month < 1 || month > 12 || year.length !== 2) {
        return;
    }

    // Get the full year by adding the 20 prefix to the input year
    const fullYear = 2000 + parseInt(year);
    
    // Check if the entered year is after the current year
    if (fullYear < currentYear || (fullYear === currentYear && month < currentMonth)) {
        alert('The card has expired. Please enter a valid expiry date.');
        input.value = ''; // Clear the input field
        input.focus(); // Focus back on the input field
        return;
    }

    // Check if the year is after 2024
    if (fullYear <= 2024) {
        alert('Please enter a year after 2024.');
        input.value = ''; // Clear the input field
        input.focus(); // Focus back on the input field
        return;
    }

    // If the input doesn't match the MM/YY format, alert the user
    if (!/^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(value)) {
        alert('Invalid format. Please use MM/YY.');
        input.value = ''; // Clear the input field
        input.focus(); // Focus back on the input field
    }
}
</script>
                        <div class="form-group">
                            <label for="">CVV/CVC</label>
                            <input type="password" class="form-control" id="cvv" name="cvv" minlength="4" maxlength="4" pattern="[0-9]{4}" placeholder="****" required onfocus="toggleCvvVisibility()" onblur="toggleCvvVisibility()">
                        </div>

                        <div class="price">
                            <h3 class="price-label">Price:</h3>
                            <h2><?php echo $row2['price']; ?></h2>
                        </div>

                        <input type="hidden" value="<?php echo $row2['price']; ?>" name="txtprice">
                        <input type="hidden" value="<?php echo $row2['carshopid']; ?>" name="txtcarshop">
                        <input type="hidden" value="<?php echo $row1['registerid']; ?>" name="txtregister">
                        <input type="hidden" value="<?php echo $row2['carid']; ?>" name="txtcar">

                        <div class="form-btn">
                            <button class="submit-btn">Pay <?php echo $row2['price']; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
