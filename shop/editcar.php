<?php
// session_start();
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$cmid;
$sqlquery1 = "SELECT * FROM tblcompany";
$result1 = $obj->executequery($sqlquery1);

$sqlquery3 = "SELECT * FROM tblcarshop";
$result3 = $obj->executequery($sqlquery3);
?>

<script src="../jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function () {
    // Load models when a company is selected
    $("#companyid").change(function () {
      var companyid = $(this).val();
      if (companyid != 0) {
        $.ajax({
          type: "POST",
          url: "getmodell.php",
          data: "companyid=" + companyid,
          success: function (data) {
            $("#divmodel").html(data); // Ensure this returns <option> elements
          }
        });
      } else {
        $("#divmodel").html('<option value="0">Select a valid company first</option>');
      }
    });

    // Validate form before submission
    $("form").submit(function (event) {
      let company = $("#companyid").val();
      let model = $("#divmodel").val();  // Get the selected model
      let fuelSelected = $("input[name='txtfuel']:checked").length > 0; // Check if any fuel radio button is selected

      if (company === "0") {
        alert("Please select a valid company.");
        event.preventDefault(); // Prevent form submission if invalid
        return false;
      }
      
      if (model === "0") {
        alert("Please select a valid model.");
        event.preventDefault(); // Prevent form submission if invalid
        return false;
      }

      if (!fuelSelected) {
        alert("Please select a fuel type.");
        event.preventDefault(); // Prevent form submission if invalid
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
              <p><span>Email:</span> <a href="mailto:carhub@gmail.com">carhub.kerala14@gmail.com</a></p>  <!-- Corrected email -->
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <?php
              if (isset($_GET["carid"])) {
                $carid = $_GET["carid"];
                $sqlquery = "SELECT * FROM tblcar e INNER JOIN tblcarshop d ON e.carshopid = d.carshopid 
                              INNER JOIN tblcompany l ON e.companyid = l.companyid 
                              INNER JOIN tblmodel m ON e.modelid = m.modelid WHERE e.carid = '$carid'";
                $result = $obj->executequery($sqlquery);
                $row = mysqli_fetch_array($result);

                $cmid=$row['companyid'];
                $sqlquery2 = "SELECT * FROM tblmodel where companyid='$cmid'";
$result2 = $obj->executequery($sqlquery2);
              }
            ?>

            <h4 class="card-title">ADD CAR TO YOUR SHOP: - <?php echo $row["carshopname"]; ?></h4>
            <p class="card-description">
              <?php echo $row["carshopname"]; ?> Adding cars to their profile...!
            </p>

            <form class="forms-sample" method="post" action="editcaraction.php" enctype="multipart/form-data">

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">CAR COMPANY</label>
                <div class="col-sm-9">
                  <select class="form-control" name="txtcompany" id="companyid">
                    <option value="0">select company</option>
                    <?php
                      while ($display = mysqli_fetch_array($result1)) {
                    ?>
                      <option value="<?php echo $display['companyid']; ?>"
                      <?php echo ($display["companyid"] == $row["companyid"]) ? "selected=selected" : ""; ?>>
                        <?php echo $display['companyname']; ?>
                      </option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">CAR MODEL</label>
                <div class="col-sm-9">
                  <select class="form-control" name="txtmodel" id="divmodel">
                    <option value="0">select MODEL</option>
                    <?php
                      while ($display = mysqli_fetch_array($result2)) {
                    ?>
                      <option value="<?php echo $display['modelid']; ?>"
                      <?php echo ($display["modelid"] == $row["modelid"]) ? "selected=selected" : ""; ?>>
                        <?php echo $display['carname']; ?>
                      </option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Fuel Type</label>
    <div class="col-sm-9">
        <input type="radio" name="txtfuel" id="fuelPetrol" value="petrol"
        <?php echo ($row["fuel"] == "petrol") ? "checked" : ""; ?> required>Petrol
        <input type="radio" name="txtfuel" id="fuelDiesel" value="diesel"
        <?php echo ($row["fuel"] == "diesel") ? "checked" : ""; ?> required>Diesel
    </div>
</div>


              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Model Year</label>
                <div class="col-sm-9">
                  <input type="text" name="txtmodelyear" value="<?php echo $row["yearr"]; ?>" class="form-control" placeholder="Enter model year" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Distance Travelled</label>
                <div class="col-sm-9">
                  <input type="text" name="txtdistance" value="<?php echo $row["travel"]; ?>" class="form-control" placeholder="Enter distance travelled" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9">
                  <input type="text" name="txtprice" value="<?php echo $row["price"]; ?>" class="form-control" placeholder="Enter price" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <textarea name="txtdescription" rows="4" cols="45" class="form-control" placeholder="Enter description" required><?php echo $row["descriptionn"]; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
  <label for="existingImage1" class="col-sm-3 col-form-label">Existing Photo 1</label>
  <div class="col-sm-9">
    <img src="../uploads/<?php echo $row['photo1']; ?>" width="200px" height="100px"/>
  </div>
</div>

<div class="form-group row">
  <label for="newImage1" class="col-sm-3 col-form-label">New Photo 1</label>
  <div class="col-sm-9">
    <input type="file" name="image1" class="form-control" id="newImage1" placeholder="Select new photo">
  </div>
</div>

<div class="form-group row">
  <label for="existingImage2" class="col-sm-3 col-form-label">Existing Photo 2</label>
  <div class="col-sm-9">
    <img src="../uploads/<?php echo $row['photo2']; ?>" width="200px" height="100px"/>
  </div>
</div>

<div class="form-group row">
  <label for="newImage2" class="col-sm-3 col-form-label">New Photo 2</label>
  <div class="col-sm-9">
    <input type="file" name="image2" class="form-control" id="newImage2" placeholder="Select new photo">
  </div>
</div>

<div class="form-group row">
  <label for="existingImage3" class="col-sm-3 col-form-label">Existing Photo 3</label>
  <div class="col-sm-9">
    <img src="../uploads/<?php echo $row['photo3']; ?>" width="200px" height="100px"/>
  </div>
</div>

<div class="form-group row">
  <label for="newImage3" class="col-sm-3 col-form-label">New Photo 3</label>
  <div class="col-sm-9">
    <input type="file" name="image3" class="form-control" id="newImage3" placeholder="Select new photo">
  </div>
</div>

<div class="form-group row">
  <label for="existingImage4" class="col-sm-3 col-form-label">Existing Photo 4</label>
  <div class="col-sm-9">
    <img src="../uploads/<?php echo $row['photo4']; ?>" width="200px" height="100px"/>
  </div>
</div>

<div class="form-group row">
  <label for="newImage4" class="col-sm-3 col-form-label">New Photo 4</label>
  <div class="col-sm-9">
    <input type="file" name="image4" class="form-control" id="newImage4" placeholder="Select new photo" >
  </div>
</div>


              <input type="hidden" name="carid" value="<?php echo $carid; ?>" />
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once("footer.php"); ?>
