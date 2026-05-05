<?php
// include_once("header.php");
require_once("../dboperation.php");
$obj = new dboperation();
$companyid = $_POST["companyid"];

$sqlquery = "SELECT * FROM tblmodel l INNER JOIN tblcompany d ON l.companyid = d.companyid WHERE l.companyid = '$companyid'";
$result = $obj->executequery($sqlquery);
?>

<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-bordered table-centered" >
        <thead>
          <tr class="table-primary text-center">
            <th style="width: 100px;">SL:NO</th>
            <th style="width: 250px;">CAR MODELS NAME</th>
            <th style="width: 100px;">EDIT</th>
            <th style="width: 100px;">DELETE</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          while($display = mysqli_fetch_array($result)) {
          ?>
          <tr class="text-center">
            <td><?php echo $i++; ?></td>
            <td><?php echo $display["carname"]; ?></td>
            <td>
              <a href="editmodel.php?modelid=<?php echo $display["modelid"];?>">
                <button class="btn btn-info">Edit</button>
              </a>
            </td>
            <td>
              <a href="deletemodel.php?modelid=<?php echo $display["modelid"]; ?>" onclick="return confirm('Are you sure you want to delete?')">
                <button class="btn btn-danger">Delete</button>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
// include_once ('footer.php');
?>

<!-- Add the following CSS to modify the table alignment and style -->
<style>
  .table {
    margin: 0 auto; /* Center the table horizontally */
    width: 80%; /* Set a reasonable width for the table */
    border-collapse: collapse;
  }

  .table th, .table td {
    text-align: center; /* Center the text in the table cells */
    padding: 12px; /* Add padding for better spacing */
    vertical-align: middle; /* Vertically align the text in the middle */
  }

  .table th {
    background-color: #f2f2f2; /* Light gray background for the headers */
    font-weight: bold;
  }

  .table-hover tbody tr:hover {
    background-color: #f5f5f5; /* Highlight row on hover */
  }

  .btn {
    padding: 6px 12px; /* Add padding to buttons */
  }

  .btn-info {
    background-color: #17a2b8; /* Bootstrap info button color */
    border-color: #17a2b8;
    color: white;
  }

  .btn-danger {
    background-color: #dc3545; /* Bootstrap danger button color */
    border-color: #dc3545;
    color: white;
  }

  .table-bordered th, .table-bordered td {
    border: 1px solid #dee2e6; /* Add borders around the table cells */
  }

  .table-centered {
    margin-left: auto;
    margin-right: auto;
  }

  /* Add padding for the card */
  .card-body {
    padding: 20px;
  }
</style>
