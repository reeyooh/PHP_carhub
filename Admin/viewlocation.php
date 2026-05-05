<?php
include_once ('header.php');
include_once("../dboperation.php");
    $obj=new dboperation();
?>
<!-- partial -->

<script src="../jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#districtid").change(function () {
                var districtid = $(this).val();
                $.ajax({
                    type: "POST",
                    url:"getlocation.php",
                    data: { districtid: districtid },
                    success: function (data) {
                        $("#locationid").html(data);
                    }
                });
            });
        });
    </script>
<div class="form-group" style="margin-left:100px;">
    <br><br><tr>
                      <label for="exampleInputUsername2">SELECT DISTRICT </label>
                      <div class="form-group">
                      <select class="form-control" name="districtid" id="districtid">
                        <option value="0">select district</option>
   
                      <?php
                      $sql='select * from tbldistrict';
                      $result=$obj->executequery($sql);
                        while($row=mysqli_fetch_array($result))
                        {
                        ?>
                        <option value="<?php echo $row['districtid'] ?>"> <?php echo $row['district'];?> </option>
                        <?php
                        }
                        ?>
                    </select>
                      </div>
                      <table id="locationid">
                    </table>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php
    include_once ('footer.php');
    ?>