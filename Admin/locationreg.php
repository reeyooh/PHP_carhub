<?php
include_once ('header.php');
include_once("../dboperation.php");
$obj = new dboperation();
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="viewlocation.php"'>View Data</button>
            </div>

            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Location Registration</h4>
                        <form id="locationForm" method="post" action="locationaction.php" class="forms-sample">
                            <div class="form-group">
                                <label for="ddldistrict">SELECT DISTRICT</label>
                                <div class="form-group">
                                    <select class="form-control" name="txtdistrict" id="ddldistrict">
                                        <option value="0">Select district</option>
                                        <?php
                                        $sql = 'select * from tbldistrict';
                                        $result = $obj-> executequery($sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['districtid'] ?>"> <?php echo $row['district']; ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Location</label>
                                <input type="text" class="form-control" name="txtlocation" id="exampleInputUsername1"
                                       placeholder="Enter location" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" required>
                            </div>

                            <button type="submit" name="btnsubmit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once ('footer.php');
    ?>

    <!-- JavaScript validation for the district dropdown -->
    <script>
    document.getElementById("locationForm").addEventListener("submit", function(event) {
        var district = document.getElementById("ddldistrict").value;
        if (district == "0") {
            alert("Please select a district.");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
    </script>
