<?php
include("header.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>>carshop</title>
</head>

<body>
<form action="excel/excelcarshop.php" method="post">
<div class="logo">
              <a href="./index.php">
                <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                 <img src="img/logo.png" alt="">&nbsp; &nbsp;</a>
                 </div>
  <div class="container" style="width:100%;margin-left:15%;margin-bottom: 5%;" >
  <div class="row">
  <div class="col-md-12" style="box-shadow: 2px 2px 10px #1b93e1; border-radius:15px; top: 106px;    margin-bottom: 59px;">
  <div class="row" style="margin-left: -173%;margin-top: 2%;margin-bottom: -5%;">
      <input type="submit" name="addnew" value="Export" class="btn btn-primary" style="margin-left:63%">
    </div>
  <h2 style="text-align: center;margin-top: 6%;font-family: fantasy;">carshop REPORT</h2>
  <div class="form-horizontal" style="margin-left:0px;">
  <table class="table table-hover" style="border: 2px solid #adaaaa; box-shadow: 3px 3px 11px #777777; margin-bottom:7%">

  <tr>
                          <th> Sl.No </th>
                          <th> Name  </th> 
                          <th> Location  </th> 
                          <th> email </th>
                          <th> Phone </th>
                          <th> License </th>
                        </tr>
   
    <?php
// include("../dboperation.php");
$obj = new dboperation();
$s=1;


$sql = "SELECT * FROM tblcarshop e
         INNER JOIN tbldistrict d ON e.districtid = d.districtid
         INNER JOIN tbllocation l ON e.locationid = l.locationid where e.statuss='accepted'
       ";
$res = $obj->executequery($sql);
   while($display=mysqli_fetch_array($res))
   {
    ?>
	<tr>
                          <td class="py-1"><?php echo $s++;?></td>
                          <td> <?php echo $display["carshopname"];?></td>
                         
                       
                          <td> <?php echo $display["district"];?>,<?php echo $display["locationn"];?></td>

                          <td> <?php echo $display["email"];?></td>
                          <td> <?php echo $display["mobile"];?></td>
                          <td> <?php echo $display["license"];?></td>
                          <!-- <td> <?php echo $display["username"];?></td> -->
        
                          
                          
                      </tr>
                      <?php  
	
  }
  ?>
</table>

</div>
  </div>
  </div>
  <div> </div>
  </div>
  </div>
</form>
</body>
</html>
<?php
include("footer.php");
?>