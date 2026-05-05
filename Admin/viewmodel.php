<?php
include_once ('header.php');
include_once("../dboperation.php");
    $obj=new dboperation();
?>
<!-- partial -->

<script src="../jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#companyid").change(function () {
                var companyid = $(this).val();
                $.ajax({
                    type: "POST",
                    url:"getmodel.php",
                    data: { companyid: companyid },
                    success: function (data) {
                        $("#modelid").html(data);
                    }
                });
            });
        });
    </script>
<div class="form-group" style="margin-left:100px;">
    <br><br><tr>
    

                      <label for="exampleInputUsername2">SELECT COMPANY </label>
                      <div class="form-group">
                      <select class="form-control" name="companyid" id="companyid">
                        <option value="0">select company</option>
   
                      <?php
                      $sql='select * from tblcompany';
                      $result=$obj->executequery($sql);
                        while($row=mysqli_fetch_array($result))
                        {
                        ?>
                        <option value="<?php echo $row['companyid'] ?>"> <?php echo $row['companyname'];?> </option>
                       
                        <?php
                        }
                        ?>
                    </select>
                   
                      </div>



                      





                      <table id="modelid">
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