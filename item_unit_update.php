<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';

$id=$_GET['unit_id']
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
            .col-md-6{
                text-align:left;
            }
        </style>

<?php 
// require 'includes/header_end.php';
require 'header.php';
 ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6"style="text-align:left">
                    <h4 style="margin-left: 22px;">Items Unit</h4>
                </div>

                <?php

                $sql="SELECT * FROM item_unit where item_unit_id=$id;";
                $result=mysqli_query($conn, $sql);
                $data_item=mysqli_fetch_array($result);

                // print_r($data_item);

                ?>



                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <form action="item_unit_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Add Items Unit</h4>
                                    </div>
                                    <hr>
                <div class="row">
               <div class="col-md-6">
                <label> Add Unit Name</label>
                <input type="text" name="item_unit_name" value="<?php echo $data_item['item_unit_name'] ?>" class="form-control" placeholder="Enter Value" required>
                <input type="hidden" class="form-control" name="item_unit_id" value="<?php echo $data_item['item_unit_id'] ?>">
               </div>

               <div class="col-md-6">
                <label> Add Unit Quantity</label>
                <input type="text" name="item_unit_quantity" value="<?php echo $data_item['item_unit_quantity'] ?>" class="form-control" placeholder="Enter Value" required>
               </div>

                </div>
              
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Submit</button> 
    
                    </div>
                    </div>
                    <a href="item_unit.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

                  </div>
                  <!-- submit button -->
                  </form>
                  <?php
                  ?>
                  </div>
                                   

              



                  </div>
                  




                            </div>

                        </div>
                    </div>



                        

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

