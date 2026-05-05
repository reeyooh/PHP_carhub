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
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="viewmodel.php"'>View Data</button>
            </div>

            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Enter Car Name</h4>
                        <form id="carModelForm" method="post" action="modelaction.php" class="forms-sample">
                            <div class="form-group">
                                <label for="ddlcomapany">SELECT CAR COMPANY</label>
                                <div class="form-group">
                                    <select class="form-control" name="txtcompany" id="ddlcomapany">
                                        <option value="0">Select company</option>
                                        <?php
                                        $sql = 'select * from tblcompany';
                                        $result = $obj->executequery($sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['companyid'] ?>"> <?php echo $row['companyname']; ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Car Name</label>
                                <input type="text" class="form-control" name="txtname" id="exampleInputUsername1"
                                       placeholder="Enter Car name" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" required>
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

    <!-- JavaScript validation for the company dropdown -->
    <script>
    document.getElementById("carModelForm").addEventListener("submit", function(event) {
        var company = document.getElementById("ddlcomapany").value;
        if (company == "0") {
            alert("Please select a car company.");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
    </script>
