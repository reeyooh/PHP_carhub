<?php
include 'excel_controller.php';
$clinic = new DBController();
$productResult = $clinic->runQuery("SELECT count(r.categoryid) as count,categoryname FROM tbl_category c inner join tbl_request r on c.categoryid=c.categoryid where r.fromdate >='2024-07-08' and r.fromdate <='2024-08-08' group by r.requestid;");


    $filename = "bookingexcel.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    session_start();
    include 'excel_controller.php';
    $clinic = new DBController();
    $fromdate=$_SESSION['fromdate'];
    $todate=$_SESSION['todate'];
    $productResult = $clinic->runQuery("SELECT 
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
        t.dateofpur >= '$fromdate'
        AND t.dateofpur <= '$todate'
        AND t.sts = 'payed'
        AND t.typee = 'admin'
    GROUP BY 
        t.paymentid;
    ");
    
    
        $filename = "bookingexcel.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $isPrintHeader = false;
        if (! empty($productResult)) {
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        }
    exit();
    
    ?>
    
exit();

?>
