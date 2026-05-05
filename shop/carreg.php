<?php
// session_start();
include_once("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
?>

<script src="../jquery-3.7.1.min.js"></script>
<script>
 $(document).ready(function () {
  $("#companyid").change(function () {
    var companyid = $(this).val();
    $.ajax({
      type: "POST",
      url: "getmodell.php",
      data: "companyid=" + companyid,
      success: function (data) {
        $("#divmodel").html(data);
      }
    });
  });

  // Client-side validation for form inputs
  $("form").on("submit", function (e) {
    var company = $("#companyid").val();
    var model = $("#divmodel").val();
    var fileInput1 = $("input[type='file'][name='image1']");
    var fileInput2 = $("input[type='file'][name='image2']");
    var fileInput3 = $("input[type='file'][name='image3']");
    var fileInput4 = $("input[type='file'][name='image4']");
    var year = $("input[name='txtmodelyear']").val();
    var distance = $("input[name='txtdistance']").val();
    var price = $("input[name='txtprice']").val();

    // Validate company selection
    if (company == 0) {
      alert("Please select a valid company.");
      e.preventDefault();
      return false;
    }

    // Validate model selection
    if (model == 0) {
      alert("Please select a valid car model.");
      e.preventDefault();
      return false;
    }

    // Validate year (must be a 4-digit number and no future years)
    var currentYear = new Date().getFullYear();
    if (!/^\d{4}$/.test(year) || year > currentYear) {
      alert("Please enter a valid model year (4 digits, not in the future).");
      e.preventDefault();
      return false;
    }

    // Validate distance traveled (must be a positive number)
    if (!/^\d+$/.test(distance) || distance <= 0) {
      alert("Please enter a valid distance traveled (positive number).");
      e.preventDefault();
      return false;
    }

    // Validate price (must be a positive number)
    if (!/^\d+(\.\d{1,2})?$/.test(price) || price <= 0) {
      alert("Please enter a valid price (positive number).");
      e.preventDefault();
      return false;
    }

    // Validate file uploads
    if (fileInput1[0].files.length === 0) {
      alert("Please upload car's photo 1.");
      e.preventDefault();
      return false;
    }
    if (fileInput2[0].files.length === 0) {
      alert("Please upload car's photo 2.");
      e.preventDefault();
      return false;
    }
    if (fileInput3[0].files.length === 0) {
      alert("Please upload car's photo 3.");
      e.preventDefault();
      return false;
    }
    if (fileInput4[0].files.length === 0) {
      alert("Please upload car's photo 4.");
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
              <p><span>Email:</span> <a href="mailto:carhub@gmail.com">carhub.kerala14@gmail.com</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <?php
            $shopid = $_SESSION["carshopid"];
            $sql = "SELECT * FROM tblcarshop WHERE carshopid='$shopid'";
            $result = $obj->executequery($sql);
            $display = mysqli_fetch_array($result);
            ?>                                     
        
            <h4 class="card-title">ADD CAR TO YOUR SHOP: - <?php echo $display["carshopname"]; ?> </h4>
            <p class="card-description">
              <?php echo $display["carshopname"]; ?> Adding cars to their profile...!
            </p>
            <form class="forms-sample" method="post" action="carregaction.php" enctype="multipart/form-data">

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">CAR COMPANY</label>
                <div class="col-sm-9">
                  <select class="form-control" name="txtcompany" id="companyid">
                    <option value="0">select company</option>
                    <?php
                    $sql = 'SELECT * FROM tblcompany';
                    $result = $obj->executequery($sql);
                    while ($row = mysqli_fetch_array($result)) {
                      ?>
                      <option value="<?php echo $row['companyid'] ?>"> <?php echo $row['companyname']; ?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">CAR NAME</label>
                <div class="col-sm-9">
                  <select class="form-control" name="txtmodel" id="divmodel">
                    <option value="0">select car name</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Fuel Type</label>
                <div class="col-sm-9">
                  <input type="radio" name="txtfuel" id="fuelPetrol" value="petrol" required>Petrol  
                  <input type="radio" name="txtfuel" id="fuelDiesel" value="diesel" required>Diesel  
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Model Year</label>
                <div class="col-sm-9">
                  <input type="text" name="txtmodelyear" class="form-control" id="exampleInputMobile" placeholder="Enter model year" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Distance Travel </label>
                <div class="col-sm-9">
                  <input type="text" name="txtdistance" class="form-control" id="exampleInputMobile" placeholder="Enter distance travel" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9">
                  <input type="text" name="txtprice" class="form-control" id="exampleInputEmail2" placeholder="Enter Price" required>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <textarea id="description" name="txtdescription" rows="4" cols="45" required>type description</textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Car's Photo 1</label>
                <div class="col-sm-9">
                    <input type="file" name="image1" class="form-control" id="exampleInputMobile1" placeholder="Add photo 1" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Car's Photo 2</label>
                <div class="col-sm-9">
                    <input type="file" name="image2" class="form-control" id="exampleInputMobile2" placeholder="Add photo 2" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Car's Photo 3</label>
                <div class="col-sm-9">
                    <input type="file" name="image3" class="form-control" id="exampleInputMobile3" placeholder="Add photo 3" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Car's Photo 4</label>
                <div class="col-sm-9">
                    <input type="file" name="image4" class="form-control" id="exampleInputMobile4" placeholder="Add photo 4" required>
                </div>
              </div>
              
            
              <button type="submit" name="btnupdate" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
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
