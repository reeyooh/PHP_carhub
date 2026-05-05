<?php
include_once("header.php");
require_once("../dboperation.php");
$obj = new dboperation();
?>

<script src="../jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
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

        // Form submission validation
        $("form").submit(function(event) {
            var districtSelected = $("#districtid").val();
            var locationSelected = $("#divlocation").val();
            var valid = true;

            // Validate district selection
            if (districtSelected == "0") {
                alert("Please select a district.");
                valid = false;
            }

            // Validate location selection
            if (locationSelected == "0") {
                alert("Please select a location.");
                valid = false;
            }

            // If validation fails, prevent form submission
            if (!valid) {
                event.preventDefault();
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
                            <p><span>Email:</span> <a href="mailto:carhub.kerala14@gmail.com">carhub.kerala14@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add your Carshop to carhub</h4>
                        <p class="card-description">EDIT THE PROFILE DETAILS</p>
                        <form class="forms-sample" method="post" action="addcarshopaction.php" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Car shop name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txtname" class="form-control" id="exampleInputEmail2" placeholder="car shop name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">District</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="txtdistrict" id="districtid">
                                        <option value="0">Select district</option>
                                        <?php
                                        $sql = 'SELECT * FROM tbldistrict';
                                        $result = $obj->executequery($sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['districtid'] ?>"><?php echo $row['district']; ?></option>
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
                                        <option value="0">Select location</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input type="text" minlength="10" maxlength="10" name="txtmobile" class="form-control" id="exampleInputEmail2" placeholder="Enter mobile" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="txtemail" class="form-control" id="exampleInputEmail2" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must enter a valid email address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Car shop Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control" id="exampleInputUsername2" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shop License number</label>
                                <div class="col-sm-9">
                                    <input type="text" minlength="10" maxlength="10" name="txtlicense" class="form-control" id="exampleInputEmail2" placeholder="Enter license number" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txtusername" class="form-control" id="exampleInputEmail2" placeholder="Enter username" pattern="[a-zA-Z0-9]{5,15}" title="Must contain minimum 5 and maximum 15 characters" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="txtpassword" class="form-control" id="exampleInputEmail2" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </div>

                            <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Request</button>
                            <button type="button" class="btn btn-light" onclick="window.location.href='index.html'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once("footer.php"); // Corrected to include footer instead of header
?>
