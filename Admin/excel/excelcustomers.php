<?php
// Include the database controller
include 'excel_controller.php';

// Instantiate the DBController
$clinic = new DBController();

// Run the query to fetch data
$productResult = $clinic->runQuery("
    SELECT 
        carshop.regname,
        dis.district,
        loc.locationn,
        carshop.email,
        carshop.mobile
    FROM 
        tblregister carshop
    INNER JOIN 
        tbldistrict dis  
    ON 
        carshop.districtid = dis.districtid
    INNER JOIN 
        tbllocation loc
    ON 
        carshop.locationid = loc.locationid
");

// Set the filename for the exported Excel file
$filename = "Export_customerexcel.xls";

// Set the headers to indicate a file download of an Excel format
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Print the header row only once
$isPrintHeader = false;

// Check if the query returned any results
if (!empty($productResult)) {
    // Loop through the result set
    foreach ($productResult as $row) {
        // Print column headers if not already done
        if (!$isPrintHeader) {
            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;
        }
        // Print each row's values
        echo implode("\t", array_values($row)) . "\n";
    }
}

// End script execution after outputting the Excel file
exit();
?>
