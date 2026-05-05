<?php
session_start();
require_once("../dboperation.php");
$obj = new dboperation();
$cid = $_POST["cid"];

$sqlquery = "SELECT * FROM tblpayment e
    INNER JOIN tblcar w ON e.carid=w.carid
    INNER JOIN tblcarshop o ON w.carshopid=o.carshopid
    INNER JOIN tblcompany c ON w.companyid=c.companyid
    INNER JOIN tblmodel l ON w.modelid=l.modelid
    INNER JOIN tblregister r ON e.registerid=r.registerid
    INNER JOIN tbldistrict d ON d.districtid=r.districtid
    INNER JOIN tbllocation q ON q.locationid=r.locationid
    WHERE w.carshopid='$cid' AND e.typee='admin'";

$result = $obj->executequery($sqlquery);

?>

<?php if (mysqli_num_rows($result) > 0) { ?>
    <table class="table">
        <thead>
            <tr>
                <th>SI NO</th>
                <th>Car name</th>
                <th>Admin side profit</th>
                <th>Selled date</th>
                <th>Photo</th>
                <th>Customer details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $sum = 0;
            $carshopname = '';
            while ($display = mysqli_fetch_array($result)) {
                $sum += $display["amount"]; // Add amount to the total sum
                $carshopname = $display["carshopname"]; // Set car shop name if it's available
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $display["companyname"] . " " . $display["carname"]; ?></td>
                    <td><?php echo $display["amount"]; ?></td>
                    <td><?php echo $display["dateofpur"]; ?></td>
                    <td><img src="../uploads/<?php echo $display["photo1"]; ?>" style="width:120px; height:80px;"></td>
                    <td>
                        <?php echo $display["regname"]; ?><br><br>
                        <?php echo $display["district"]; ?>, <?php echo $display["locationn"]; ?><br><br>
                        <?php echo $display["mobile"]; ?><br><br>
                        <?php echo $display["email"]; ?><br><br>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="text-center" style="margin-top: 20px;">
        <h2><br>
            <?php
            if (!empty($carshopname)) {
                echo "Total Earnings of " . $carshopname . " is " . $sum;
            }
            ?>
        </h2>
        <div class="text-left mb-3">
            <form action="Excel/excelshop.php" method="post">
                <input type="hidden" name="carso" value="<?php echo $cid ?>">
                <button type="submit" name="addnew" class="btn btn-primary">Export</button>
            </form>
        </div>
    </div>

<?php } else { ?>
    <!-- Show message if no values are found -->
    <div class="text-center" style="margin-top: 20px;">
        <h2>No Cars are selled</h2>
    </div>
<?php } ?>
