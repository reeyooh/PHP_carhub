<?php
include 'excel_controller.php';
$clinic = new DBController();
$productResult = $clinic->runQuery("
    SELECT 
        carshop.carshopname,
        dis.district,
        loc.locationn,
        carshop.email,
        carshop.mobile,
        carshop.license
    FROM 
        tblcarshop carshop
    INNER JOIN 
        tbldistrict dis  
    ON 
        carshop.districtid = dis.districtid
    INNER JOIN 
        tbllocation loc
    ON 
        carshop.locationid = loc.locationid where carshop.statuss='accepted'
");

// File export settings
$filename = 'Export_carshopexcel.xls';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$isPrintHeader = false;
if (!empty($productResult)) {
    foreach ($productResult as $row) {
        if (!$isPrintHeader) {
            // Print the header row
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        // Print the data rows
        echo implode("\t", array_values($row)) . "\n";
    }
}
exit();
?>
