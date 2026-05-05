<?php
include_once ('header.php');
?>
<!-- partial -->
<div class="main-panel">


    <div class="content-wrapper">
        <div class="row">
            <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="viewdistrict.php"'>View
                    Data </button>
            </div>

            <div class="col-md-10 grid-margin stretch-card  ">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">District Registration</h4>
                        <p class="card-description">
                            
                        </p>
                        <form method="post" action="districtaction.php" class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">DISTRICT</label>
                                <input type="text" class="form-control" name="txtdistrict" id="exampleInputUsername1"
                                    placeholder="Enter District" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" required>
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