<?php
include_once("header.php");
require_once("../dboperation.php");
$obj = new dboperation();
$sqlquery1 = "SELECT * FROM tbldistrict";
$result1 = $obj-> executequery($sqlquery1);
$sqlquery2 = "SELECT * FROM tbllocation";
$result2 = $obj->executequery($sqlquery2);
$sqlquery3 = "SELECT * FROM tblcarshop";
$result3 = $obj->executequery($sqlquery3);
?>

<script src="../jquery-3.7.1.min.js"></script>
<script>
    
$(document).ready(function() {
    // Load locations when district is selected
    $("#districtid").change(function() {
        var districtid = $(this).val();
        $.ajax({
            type: "POST",
            url: "getlocationn.php",
            data: "districtid=" + districtid,
            success: function(data) {
                $("#divlocation").html(data);
            }
        });
    });

    // Client-side validation before form submission
    $("form").submit(function(e) {
        var district = $("#districtid").val();
        var location = $("#divlocation").val();

        // Validate district selection
        if (district == 0) {
            alert("Please select a district.");
            e.preventDefault();  // Prevent form submission
            return false;
        }

        // Validate location selection
        if (location == 0) {
            alert("Please select a location.");
            e.preventDefault();  // Prevent form submission
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
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Contact Us</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-4">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-map-o"></span>
                            </div>
                            <p><span>Address:</span>Thodupuzha</p>
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
                            <p><span>Email:</span> <a href="carhub@gmail.com:">carhub.kerala14@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">EDIT THE PROFILE</h4>
                        <p class="card-description">EDIT THE PROFILE DETAILS</p>
                        <form class="forms-sample" method="post" action="editprofileaction.php" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET["carshopid"])) {
                                $carshopid = $_GET["carshopid"];
                                $sqlquery = "SELECT * FROM tblcarshop e INNER JOIN tbldistrict d ON e.districtid=d.districtid INNER JOIN tbllocation l ON e.locationid=l.locationid WHERE carshopid='$carshopid'";
                                $result = $obj->executequery($sqlquery);
                                $row = mysqli_fetch_array($result);
                            }
                            ?>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Car shop name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $row['carshopname']; ?>" name="txtname" class="form-control" id="exampleInputEmail2" placeholder="car shop name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">District</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="txtdistrict" id="districtid">
                                        <option value="0">select district</option>
                                        <?php
                                        while ($display = mysqli_fetch_array($result1)) {
                                            ?>
                                            <option value=<?php echo $display['districtid']; ?>
                                            <?php echo ($display["districtid"] == $row["districtid"]) ? "selected=selected" : ""; ?>>
                                            <?php echo $display['district']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="txtlocation" id="divlocation">
                                        <option value="0">select location</option>
                                        <?php
                                        while ($display = mysqli_fetch_array($result2)) {
                                            ?>
                                            <option value=<?php echo $display['locationid']; ?>
                                            <?php echo ($display["locationid"] == $row["locationid"]) ? "selected=selected" : ""; ?>>
                                            <?php echo $display['locationn']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">mobile</label>
                <div class="col-sm-9">
                <input type="text" value="<?php echo $row['mobile']; ?>" minlength="10" maxlength="10" pattern="[0-9]{10}" name="txtmobile" class="form-control" id="exampleInputEmail2" placeholder=""   title="The phone number should Be in Numbers"  required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                <input type="Email" value="<?php echo $row['email']; ?>" name="txtemail" id="email" class="form-control" id="exampleInputEmail2" placeholder=""  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                title="must enter a valid email address" value="" required />
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
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Exicting photo of carshop</label>
                      <div class="col-sm-9">
                      <img src="../uploads/<?php echo $row["photo"]; ?>" style="width:80px; height:60px;">
                      <!-- <p>Are you need to change the photo</p> -->
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label" >Add new car shop Photo</label>
                      <div class="col-sm-9">
                        <input type="file" name="image" value="<?php echo $row["photo"];?>"class="form-control" id="exampleInputUsername2" placeholder=" name">
                      </div>
                    </div>   
                    

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                <input type="text" value="<?php echo $row['username']; ?>" name="txtusername" class="form-control" id="exampleInputEmail2" placeholder=""  pattern="[a-zA-Z0-9]{5,15}"  
                title="Must contain minimum 5 and maximum 15 characters" required/>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-9">
                <input type="text" value="<?php echo $row['passwordd']; ?>" name="txtpassword" class="form-control" id="exampleInputEmail2" placeholder="" pattern="[a-zA-Z0-9]{5,15}"  
                title="Must contain minimum 5 and maximum 15 characters" required/>
                <input type="hidden" name="carshopid" value="<?php echo $row["carshopid"]; ?>">
              </div>
              </div>

            
              
              <!-- <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Car's side Photo</label>
                <div class="col-sm-9">
                  <input type="file" name="imageside" class="form-control" id="exampleInputMobile" placeholder="Add photo">
                </div>
              </div> -->
             

              

              
              <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>


      </form>
    </section>
	
<?php
include_once("header.php");
?>
