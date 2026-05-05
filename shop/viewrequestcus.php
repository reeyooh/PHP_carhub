<?php
// session_start(); // Ensure session is started
include_once("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$shopid = $_SESSION['carshopid'];

// Query to count requested cars
$sqlCountRequested = "SELECT COUNT(*) AS requested_count FROM tblrequest e
INNER JOIN tblcarshop c ON e.carshopid = c.carshopid
WHERE c.carshopid = '$shopid' AND e.statusss = 'requested'";
$countRequested = $obj->executequery($sqlCountRequested);
$rowCountRequested = mysqli_fetch_assoc($countRequested);
$requestedCount = $rowCountRequested['requested_count'];

// Query to count accepted cars
$sqlCountAccepted = "SELECT COUNT(*) AS accepted_count FROM tblrequest e
INNER JOIN tblcarshop c ON e.carshopid = c.carshopid
WHERE c.carshopid = '$shopid' AND e.statusss = 'accepted'";
$countAccepted = $obj->executequery($sqlCountAccepted);
$rowCountAccepted = mysqli_fetch_assoc($countAccepted);
$acceptedCount = $rowCountAccepted['accepted_count'];

// Query for requested cars
$sql1 = "SELECT * FROM tblrequest e
INNER JOIN tblregister r ON e.registerid = r.registerid
INNER JOIN tbldistrict l ON r.districtid = l.districtid
INNER JOIN tbllocation b ON r.locationid = b.locationid
INNER JOIN tblcar d ON e.carid = d.carid
INNER JOIN tblcompany f ON d.companyid = f.companyid
INNER JOIN tblmodel m ON d.modelid = m.modelid
INNER JOIN tblcarshop c ON e.carshopid = c.carshopid
WHERE c.carshopid = '$shopid' AND e.statusss = 'requested' ORDER BY e.requestid";
$result = $obj->executequery($sql1);

// Query for accepted cars
$sql2 = "SELECT * FROM tblrequest e
INNER JOIN tblregister r ON e.registerid = r.registerid
INNER JOIN tbldistrict l ON r.districtid = l.districtid
INNER JOIN tbllocation b ON r.locationid = b.locationid
INNER JOIN tblcar d ON e.carid = d.carid
INNER JOIN tblcompany f ON d.companyid = f.companyid
INNER JOIN tblmodel m ON d.modelid = m.modelid
INNER JOIN tblcarshop c ON e.carshopid = c.carshopid
WHERE c.carshopid = '$shopid' AND e.statusss = 'accepted' ORDER BY e.requestid";
$result2 = $obj->executequery($sql2);
?>

<!-- Include jQuery and Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
  .table-container {
    width: 100%;
    padding: 0 15px;
  }
  .table-responsive {
    overflow-x: auto;
  }
</style>

<form method="post">
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg'); background-size: cover;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
          <h1 class="mb-3 bread">Used Car Requests</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light py-5">
    <div class="container table-container">
      <div class="row mb-4 justify-content-center">
        <div class="col-md-6 text-center">
          <button type="button" id="showRequested" class="btn btn-info btn-lg mx-2">
            Show Requested Cars <span class="badge badge-light"><?php echo $requestedCount; ?></span>
          </button>
          <button type="button" id="showAccepted" class="btn btn-success btn-lg mx-2">
            Show Accepted Cars <span class="badge badge-light"><?php echo $acceptedCount; ?></span>
          </button>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-12">
          <!-- Requested Cars Table -->
          <div id="requestedCars" class="table-responsive" style="display:none;">
            <?php if (mysqli_num_rows($result) > 0) { ?>
              <h3 class="text-center mb-4">Requested Cars</h3>
              <table class="table table-hover table-bordered w-100">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer Details</th>
                    <th>Car Name</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row["dateee"]; ?></td>
                      <td>
                        <a href="#" class="view-details" 
                           data-registerid="<?php echo $row["registerid"]; ?>">
                          <?php echo $row["regname"]; ?>
                        </a>
                      </td>
                      <td><?php echo $row["companyname"] . ' ' . $row["carname"]; ?></td>
                      <td><img src="../uploads/<?php echo $row["photo1"]; ?>" class="img-thumbnail" style="width:120px; height:80px;"></td>
                      <td>
                        <a href="remark/reqaccept.php?requestid=<?php echo $row['requestid']; ?>" class="btn btn-info btn-sm">Accept</a>
                        <a href="remark/reqreject.php?requestid=<?php echo $row['requestid']; ?>" class="btn btn-danger btn-sm">Reject</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } else { ?>
              <h3 class="text-center">No requested cars available</h3>
            <?php } ?>
          </div>

          <!-- Accepted Cars Table -->
          <div id="acceptedCars" class="table-responsive" style="display:none;">
            <?php if (mysqli_num_rows($result2) > 0) { ?>
              <h3 class="text-center mb-4">Accepted Cars</h3>
              <table class="table table-hover table-bordered w-100">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer Details</th>
                    <th>Car Name</th>
                    <th>Photo</th>
                    <th>Reply</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($result2)) { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row["dateee"]; ?></td>
                      <td>
                        <a href="#" class="view-details" 
                           data-registerid="<?php echo $row["registerid"]; ?>">
                          <?php echo $row["regname"]; ?>
                        </a>
                      </td>
                      <td><?php echo $row["companyname"] . ' ' . $row["carname"]; ?></td>
                      <td><img src="../uploads/<?php echo $row["photo1"]; ?>" class="img-thumbnail" style="width:120px; height:80px;"></td>
                      <td><?php echo $row["remark"]; ?></td>
                      <td>
                        <a href="payment/paymentfinal.php?carid=<?php echo $row['carid']; ?>&regnumber=<?php echo $row['regnumber']; ?>" class="btn btn-primary btn-sm">Finalize</a>
                        <a href="remark/editrequest.php?carid=<?php echo $row['carid']; ?>&requestid=<?php echo $row['requestid']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                        <a href="deleterequest.php?requestid=<?php echo $row['requestid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } else { ?>
              <h3 class="text-center">No accepted cars available</h3>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<!-- Modal for Customer Details -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Customer Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Name:</strong> <span id="modalRegName"></span></p>
        <p><strong>Mobile:</strong> <span id="modalMobile"></span></p>
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>District:</strong> <span id="modalDistrict"></span></p>
        <p><strong>Location:</strong> <span id="modalLocation"></span></p>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      // Show requested cars
      $('#showRequested').on('click', function() {
          $('#acceptedCars').hide();
          $('#requestedCars').show();
      });

      // Show accepted cars
      $('#showAccepted').on('click', function() {
          $('#requestedCars').hide();
          $('#acceptedCars').show();
      });

      // Fetch customer details
      $(document).on('click', '.view-details', function() {
          const registerid = $(this).data('registerid');

          $.ajax({
              url: 'fetch_register_details.php',
              method: 'POST',
              data: { registerid: registerid },
              dataType: 'json',
              success: function(response) {
                  if (!response.error) {
                      $('#modalRegName').text(response.regname);
                      $('#modalMobile').text(response.mobile);
                      $('#modalEmail').text(response.email);
                      $('#modalDistrict').text(response.district);
                      $('#modalLocation').text(response.locationn);
                      $('#detailsModal').modal('show');
                  } else {
                      alert(response.error);
                  }
              },
              error: function() {
                  alert('An error occurred while fetching details.');
              }
          });
      });
  });
</script>

<?php include_once("footer.php"); ?>
