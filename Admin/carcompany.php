<?php
include_once ('header.php');
?>
<!-- partial -->
<div class="main-panel">


    <div class="content-wrapper">
        <div class="row">
            <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="viewcompany.php"'>View
                    Data </button>
            </div>

            <div class="col-md-10 grid-margin stretch-card  ">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Car company</h4>
                        <p class="card-description">
                            
                        </p>
                        <form method="post" action="carcompanyaction.php" class="forms-sample" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputUsername1">Comapany Name</label>
                                <input type="text" class="form-control" name="txtcompanyname" id="exampleInputUsername1"
                                    placeholder="Enter Company name" pattern="[A-Za-z ]+" title="Only alphabetic characters are allowed" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Comapany description</label>
                                <input type="text" class="form-control" name="txtcompanydescription" id="exampleInputUsername1"
                                    placeholder="Enter Company description"pattern="[A-Za-z]+" title="Only alphabetic characters are allowed" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Comapany photo</label>
                                <input type="file" class="form-control" name="image" id="exampleInputUsername1"
                                    placeholder="add photo" required>
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