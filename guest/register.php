<?php
include_once('header.php');
include_once("../dboperation.php");
$obj = new dboperation();
?>
<script src="../jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function () {
    // Function for AJAX validation
    function validateField(type, value, elementId) {
      if (value !== "") {
        $.ajax({
          type: "POST",
          url: "checkexistence.php",
          data: { type: type, value: value },
          success: function (response) {
            var result = JSON.parse(response);
            if (result.status) {
              alert(result.message);
              $("#" + elementId).val(""); // Clear the input field
            }
          }
        });
      }
    }

    // Real-time validation for email
    $("#email").on("blur", function () {
      validateField("email", $(this).val(), "email");
    });

    // Real-time validation for mobile
    $("#mobile").on("blur", function () {
      validateField("mobile", $(this).val(), "mobile");
    });

    // Real-time validation for username
    $("#username").on("blur", function () {
      validateField("username", $(this).val(), "username");
    });

    // Handle district selection and fetch corresponding locations
    $("#districtid").change(function () {
      var districtid = $(this).val();
      if (districtid != 0) { // Only make the request if a valid district is selected
        $.ajax({
          type: "POST",
          url: "getlocationn.php",
          data: "districtid=" + districtid,
          success: function (data) {
            $("#divlocation").html(data);
          }
        });
      } else {
        $("#divlocation").html('<option value="0">Select location</option>'); // Reset the location dropdown
      }
    });

    // Form validation before submission
    $("form").on("submit", function (event) {
      var district = $("#districtid").val();
      var location = $("#divlocation").val();

      if (district == "0") {
        alert("Please select a valid district.");
        event.preventDefault();
        return false;
      }

      if (location == "0") {
        alert("Please select a valid location.");
        event.preventDefault();
        return false;
      }
      return true;
    });
  });
</script>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registration</title>
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="assets/images/logo.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="post" action="registeraction.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="txtname" placeholder="Enter Name" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" required />
                </div>
                <div class="form-group">
                  <select class="form-control" name="txtdistrict" id="districtid" required>
                    <option value="0">Select district</option>
                    <?php
                    $sql = 'SELECT * FROM tbldistrict';
                    $result = $obj->executequery($sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $row['districtid'] ?>"><?php echo $row['district']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" name="txtlocation" id="divlocation" required>
                    <option value="0">Select location</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" id="pincode" class="form-control form-control-lg" minlength="6" maxlength="6" name="txtpincode" placeholder="Pin code" pattern="[0-9]{6}" required title="Must contain 6 digits" />
                </div>
                <div class="form-group">
                  <input type="text" id="mobile" class="form-control form-control-lg" minlength="10" maxlength="10" name="txtmobile" placeholder="Mobile number" pattern="[0-9]{10}" required title="Must contain 10 digits" />
                </div>
                <div class="form-group">
                  <input type="email" id="email" class="form-control form-control-lg" name="txtemail"  id="email" placeholder="Email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"required />
                </div>

                 
              
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const emailInput = document.getElementById('email').value;
     // Regex for validating email with .com or any valid TLD
        const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;

        // Check if the email matches the regex and ends with .com
        if (!emailPattern.test(emailInput) || !emailInput.endsWith('.com')) {
            alert('Please enter a valid email address ending with .com');
            e.preventDefault(); // Prevent form submission
        }
 });
</script>
                <div class="form-group">
                  <input type="text" id="username" class="form-control form-control-lg" name="txtusername" placeholder="Username" pattern="[a-zA-Z0-9]{5,15}" title="Must contain minimum 5 and maximum 15 characters" required />
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="txtpassword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                </div>
                <button type="submit" name="btnsubmit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
              </form>
              <div class="text-center mt-4 font-weight-light">
                Already have an account? <a href="login.php" class="text-primary">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
