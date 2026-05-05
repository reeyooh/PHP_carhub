<?php
include_once("header.php");
require_once("../dboperation.php");
$obj = new dboperation();
$sqlquery1 = "SELECT * FROM tbldistrict";
$result1 = $obj->executequery($sqlquery1);
$sqlquery2 = "SELECT * FROM tbllocation";
$result2 = $obj->executequery($sqlquery2);
?>

<script src="../jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $("#districtid").change(function() {
        var districtid = $(this).val();
        if (districtid == 0) {
            alert("Please select a valid district.");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "getlocationn.php",
            data: "districtid=" + districtid,
            success: function(data) {
                $("#divlocation").html(data);
            }
        });
    });

    // Client-side validation before submitting the form
    $("form").submit(function(e) {
        var district = $("#districtid").val();
        var location = $("#divlocation").val();
        
        if (district == 0) {
            alert("Please select a district.");
            e.preventDefault();
            return false;
        }
        
        if (location == 0) {
            alert("Please select a location.");
            e.preventDefault();
            return false;
        }
    });
});
</script>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Contact Us</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <!-- Contact Information Section -->
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-4">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-map-o"></span>
                            </div>
                            <p><span>Address:</span> Thodupuzha</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-mobile-phone"></span>
                            </div>
                            <p><span>Phone:</span> <a href="tel://859592542">+91 8590592542</a></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-envelope-o"></span>
                            </div>
                            <p><span>Email:</span> <a href="carhub@gmail.com:">Carhub@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit the Profile</h4>
                        <p class="card-description">Edit the profile details</p>
                        <form class="forms-sample" method="post" action="editcusaction.php">
                            <?php
                            if (isset($_GET["registerid"])) {
                                $regid = $_GET["registerid"];
                                $sqlquery = "SELECT * FROM tblregister e  
                                            INNER JOIN tbldistrict d ON e.districtid = d.districtid 
                                            INNER JOIN tbllocation l ON e.locationid = l.locationid 
                                            WHERE registerid = '$regid'";
                                $result = $obj->executequery($sqlquery);
                                $row = mysqli_fetch_array($result);
                            }
                            ?>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row['regname']; ?>" name="txtname" class="form-control" id="exampleInputEmail2" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" placeholder="Car shop name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">District</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="txtdistrict" id="districtid">
                                        <option value="0">Select district</option>
                                        <?php
                                        while ($display = mysqli_fetch_array($result1)) {
                                        ?>
                                        <option value=<?php echo $display['districtid']; ?> <?php echo ($display["districtid"] == $row["districtid"]) ? "selected=selected" : ""; ?>>
                                            <?php echo $display['district']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="txtlocation" id="divlocation">
                                        <option value="0">Select location</option>
                                        <?php
                                        while ($display = mysqli_fetch_array($result2)) {
                                        ?>
                                        <option value=<?php echo $display['locationid']; ?> <?php echo ($display["locationid"] == $row["locationid"]) ? "selected=selected" : ""; ?>>
                                            <?php echo $display['locationn']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Pincode</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row['pincode']; ?>" minlength="6" maxlength="6"  pattern="[0-9]{6}" name="txtpincode" class="form-control" id="exampleInputEmail2" placeholder="Pincode">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row['mobile']; ?>" minlength="10" maxlength="10" pattern="[0-9]{10}" name="txtmobile" class="form-control" id="exampleInputEmail2" placeholder="Mobile number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" value="<?php echo $row['email']; ?>" id="email" name="txtemail" class="form-control" id="exampleInputEmail2" placeholder="Email"   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  title="Enter a valid email address">
                                </div>
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
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row['username']; ?>" name="txtusername" class="form-control" id="exampleInputEmail2" placeholder="Username" pattern="[a-zA-Z0-9]{5,15}" title="Username must be between 5 to 15 characters" required>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" value="<?php echo $row['passwordd']; ?>" name="txtpassword" class="form-control" id="exampleInputEmail2" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must have at least one number, one uppercase and lowercase letter, and 8 or more characters" required>
                                    <input type="hidden" name="registerid" value="<?php echo $row['registerid']; ?>">
                                </div>
                            </div> -->

                            <!-- <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Remember me
                                </label>
                            </div> -->
                            <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once("footer.php");
?>
