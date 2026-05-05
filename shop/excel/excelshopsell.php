<?php
session_start();
// include("header.php");
include 'excel_controller.php';

// Instantiate the DBController
$clinic = new DBController();

if (isset($_POST["addnew"])) {
    $id = $_POST["carso"];
}


// Run the query
$productResult = $clinic->runQuery("
    SELECT 
        c.companyname,
        m.carname,
        t.amount,
        t.dateofpur,
        o.carshopname,
        q.regname,
        d.district,
        e.locationn,
        q.mobile,
        q.email
    FROM 
        tblpayment t
    INNER JOIN 
        tblcar r ON t.carid = r.carid
    INNER JOIN 
        tblcarshop o ON r.carshopid = o.carshopid
    INNER JOIN 
        tblcompany c ON r.companyid = c.companyid
    INNER JOIN 
        tblmodel m ON r.modelid = m.modelid
    INNER JOIN 
        tblregister q ON t.registerid = q.registerid
    INNER JOIN 
        tbldistrict d ON q.districtid = d.districtid
    INNER JOIN 
        tbllocation e ON q.locationid = e.locationid
    WHERE 
    t.carshopid='$id' and
      t.sts = 'payed'
        AND t.typee = 'carshop'
    GROUP BY 
        t.paymentid;
");



// Excel Export
$filename = "selled_cars_shop_report.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

$isPrintHeader = false;
if (!empty($productResult)) {
    foreach ($productResult as $row) {
        if (!$isPrintHeader) {
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        echo implode("\t", array_values($row)) . "\n";
    }
}

exit();
?>
