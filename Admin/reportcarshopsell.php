<?php include("header.php");
// include_once("../dboperation.php");
$obj = new dbOperation();
$s = 1;
$sqlquery = "select * from tblcarshop where statuss='accepted'";
$res = $obj->executequery($sqlquery);
?>
<script src="../jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#subcontractor").change(function () {
            var cid = $(this).val();
            $.ajax({
                type: "POST",
                url: "getcarshopsell.php",
                data: "cid=" + cid,
                success: function (data) {
                    $("#carshop").html(data);
                }
            });
        });
    });
</script>

<head>
    <meta charset="utf-8">
    <title>>carhub</title>
</head>

<body>

    <div class="logo">
        <a href="../index.php">
            <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <img src="img/logo.png" alt="">&nbsp; &nbsp;</a>
    </div>
    <div class="container" style="width:100%;margin-left:5%;margin-bottom: 5%;">
        <div class="row">
            <div class="col-md-12"
                style="box-shadow: 2px 2px 10px #1b93e1; border-radius:15px; top: 106px;margin-bottom: 59px;max-width: 100%;">

                <h2 style="text-align: center;margin-top: 6%;font-family: fantasy;">SHOPWISE SOLD CAR REPORT</h2>
                <div class="form-horizontal" style="margin-left:0px;">
                    <select name="" id="subcontractor">
                        <option value="">Choose</option>
                        <?php
                        while ($display = mysqli_fetch_array($res)) {
                            ?>
                            <option value="<?php echo $display['carshopid'] ?>">
                                <?php echo $display['carshopname']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="row" id="carshop">

                </div>
            </div>
        </div>
    </div>
</body>

</div>

<?php
include("footer.php");
?>
