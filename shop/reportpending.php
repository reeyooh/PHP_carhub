<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Carshop</title>
</head>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center"> 
            <div class="col-md-9 ftco-animate pb-5 text-center"> 
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Pending Payments</h1>
            </div>
        </div>
    </div>
</section>
<br>
<body>
<form action="excel/excelcarshop.php" method="post">
    <div class="logo">
        <a href="./index.php">
            <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <img src="img/logo.png" alt="">&nbsp; &nbsp;</a>
    </div>
    <div class="container" style="width:100%;margin-left:15%;margin-bottom: 5%;">
        <div class="row">
            <div class="col-md-12" style="box-shadow: 2px 2px 10px #1b93e1; border-radius:15px; top: 106px; margin-bottom: 59px;">
                <h2 style="text-align: center;margin-top: 6%;font-family: fantasy;">Pending Payments</h2>
                <div class="form-horizontal" style="margin-left:0px;">
                    <table class="table table-hover" style="border: 2px solid #adaaaa; box-shadow: 3px 3px 11px #777777; margin-bottom:7%">
                        <?php
                        // include("../dboperation.php");
                        $obj = new dboperation();
                        $s = 1;

                        $sql = "SELECT * FROM tblpayrequest e
                            INNER JOIN tblregister d ON e.registerid = d.registerid
                            INNER JOIN tbldistrict o ON d.districtid = o.districtid
                            INNER JOIN tbllocation l ON d.locationid = l.locationid
                            INNER JOIN tblcar w ON e.carid = w.carid
                            INNER JOIN tblcompany g ON w.companyid = g.companyid
                            INNER JOIN tblmodel m ON w.modelid = m.modelid
                            WHERE e.s='pending' ORDER BY payrequestid DESC";
                        $res = $obj->executequery($sql);
                        
                        if (mysqli_num_rows($res) > 0): ?>
                            <tr>
                                <th> Sl.No </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Car Name </th>
                                <th> Photo </th>
                                <th> Price </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            <?php
                            while ($display = mysqli_fetch_array($res)) {
                                ?>
                                <tr>
                                    <td class="py-1"><?php echo $s++; ?></td>
                                    <td><?php echo $display["regname"]; ?></td>
                                    <td><?php echo $display["email"]; ?></td>
                                    <td><?php echo $display["mobile"]; ?></td>
                                    <td><?php echo $display["companyname"] . ", " . $display["carname"]; ?></td>
                                    <td><img src="../uploads/<?php echo $display["photo1"]; ?>" style="width:120px; height:80px;"></td>
                                    <td><?php echo $display["price"]; ?></td>
                                    <td><?php echo $display["s"]; ?></td>
                                    <td>
                                        <a href="pendingremainder.php?payrequestid=<?php echo $display["payrequestid"]; ?>">
                                            <input type='button' class="btn btn-info" value="Remainder">
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        else: ?>
                            <tr>
                                <td colspan='9' class='text-center'>No pending payments.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
<?php
include("footer.php");
?>
