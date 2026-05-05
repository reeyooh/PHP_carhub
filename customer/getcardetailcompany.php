<?php
include_once("../dboperation.php");
$obj = new dboperation();
$carid = $_POST['carid']; // Make sure this is being posted correctly
$company = $_POST['companyid'];
$sql = "SELECT * FROM tblcar e
        INNER JOIN tblcarshop d ON e.carshopid = d.carshopid
        INNER JOIN tblcompany l ON e.companyid = l.companyid
        INNER JOIN tblmodel m ON e.modelid = m.modelid 
        WHERE (m.carname LIKE '%$carid%' OR l.companyname LIKE '%$carid%') and l.companyid='$company'
        AND e.statz = 'available'";

$result = $obj->executequery($sql);

// Check if data exists
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="col-lg-2 col-md-3 col-sm-6 mb-5">
            <div class="car-wrap rounded ">
                <div class="img rounded d-flex align-items-end" style="background-image: url('../uploads/<?php echo $row["photo1"]; ?>');">
                </div>
                <div class="text">
                    <h2 class="mb-0"><a href="viewsincar.php?carid=<?php echo $row["carid"]; ?>"><?php echo $row["companyname"]; ?> <?php echo $row["carname"]; ?></a></h2>
                    <p>Car shop: <?php echo $row["carshopname"]; ?></p>
                    <p>Model Year: <?php echo $row["yearr"]; ?></p>
                    <h2>₹ <?php echo $row["price"]; ?></h2>
                    <p><a href="viewsincar.php?carid=<?php echo $row['carid']?>" class="btn btn-primary py-2 mr-1">VIEW</a></p>
                </div>
            </div>
        </div>
    <?php }
} else {
    echo "<p>No cars found matching your search.</p>"; // Send message if no cars found
}
?>
