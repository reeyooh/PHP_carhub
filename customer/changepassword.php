
<?php
include_once("header.php");
require_once("../dboperation.php");
$obj = new dboperation();
?>


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
                            <p><span>Email:</span> <a href="carhub@gmail.com:">Carhub@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">CHANGE PASSWORD</h4>
                        <p class="card-description">CHANGE PASSWORD DETAILS</p>
                        <form class="forms-sample" method="post" action="changepasswordaction.php" enctype="multipart/form-data">
                       

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">  Username:</label>
                                <div class="col-sm-9">
                                 <input type="text"  name="txtusername" placeholder=" Your username" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">   Password </label>
                                <div class="col-sm-9">
                              
                        
                        <input type="password" name="txtpassword" placeholder="current password" required>
                 
                        
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">New Password </label>
                                <div class="col-sm-9">
                            
                 
                           <input type="text"  name="txtnewpassword" placeholder="New password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                       
                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Confirm  Password </label>
                                <div class="col-sm-9">
                       
                          <input type="password" name="txtconfirmpwd" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label"> </label>
                                <div class="col-sm-9">
                       
                                <!-- <a href="forgotpassword.php" class="col-sm-3 col-form-label">Forgot password?</a> -->
             
                                </div>
                            </div>
                            </div>
                    </div>

                          
                <!-- <input type="hidden" name="carshopid" value="<?php echo $row["carshopid"]; ?>"> -->
              

            

              


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
