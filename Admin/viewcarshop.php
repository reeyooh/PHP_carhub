<?php
include_once ("header.php");
include_once ("../dboperation.php");
$obj = new dboperation();
?>

  <script src="../jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#districtid").change(function () {
                var districtid = $(this).val();
                $.ajax({
                    type: "POST",
                    url:"getcarshop.php",
                    data: { districtid: districtid },
                    success: function (data) {
                        $("#carshopid").html(data);
                    }
                });
            });
        });
    </script>

<div class="form-group" style="margin-left:100px;">
  <br><br>
  <tr>
    <label for="exampleInputUsername2">SELEC CARSHOP ACCORDING TO DISTRICT </label>
    <div class="form-group">
      <select class="form-control" name="districtid" id="districtid">
        <option value="0">select district</option>

        <?php
        $sql = 'select * from tbldistrict';
        $result = $obj->executequery($sql);
        while ($row = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $row['districtid'] ?>"> <?php echo $row['district']; ?> </option>
          <?php
        }
        ?>
      </select>
    </div>
    
    <?php
    $sqlquery = "SELECT * FROM tblcarshop e  INNER JOIN tbldistrict d ON e.districtid=d.districtid INNER JOIN tbllocation l ON e.locationid=l.locationid where statuss='accepted'";
    $result = $obj->executequery($sqlquery)
      ?>




    <!-- <div class="col-lg-6 grid-margin stretch-card"> -->
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">company details</h4>
        <div class="table-responsive">
          <table class="table table-hover" id="carshopid">
            <thead>
              <tr>
                <th>#</th>
                <th>CARSHOPE NAME</th>
                <th>DATE OF REGISTER</th>
                <th>DISTRICT </th>
                <th>LOCATION</th>
                <th>MOBILE</th>
                <th>PHOTO </th>
                <!-- <th>USERNAME </th> -->
                <!-- <th> PASSWORD</th> -->
                <!-- <th>EDIT</th> -->
                <th>DELETE</th>
              </tr>
            </thead>
            <tbody>
              <!-- <div class="col-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-1 mb-3" onclick='window.location.href="carshop.php"'>
                  Registration </button>
              </div> -->

              <?php
              $i = 1;
              while ($display = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $display["carshopname"]; ?></td>
                  <td><?php echo $display["datee"]; ?></td>
                  <td><?php echo $display["district"]; ?></td>
                  <td><?php echo $display["locationn"]; ?></td>
                  <td><?php echo $display["mobile"]; ?></td>
                  <td><img src="../uploads/<?php echo $display["photo"]; ?>" style="width:120px; height:80px;"></td>
                  <!-- <td><?php echo $display["username"]; ?></td>
                  <td><?php echo $display["passwordd"]; ?></td> -->
                  <!-- <td>
                    <a href="editcarshop.php?carshopid=<?php echo $display["carshopid"]; ?>">
                      <input type='button' class="btn btn-info" value="Edit"></a>
                  </td> -->
                  <td>
                    <a href="deletecarshop.php?carshopid=<?php echo $display["carshopid"]; ?>"
                      onclick="return confirm('are you sure want to delete?')">
                      <input type='button' class="btn btn-danger" value="Delete"></a>
                  </td>
                </tr>
                <?php
              }
              ?>
              <table id="carshopid">
              </table>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
</div>
<?php
include_once ("footer.php");
?>