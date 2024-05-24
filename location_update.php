<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';

$id=$_GET['location_id'];
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
                    




                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <form action="location_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Edit Location</h4>
                                    </div>
                                    <hr>

                                 <?php
                                   $sql="SELECT * FROM location_master where location_master_id=$id;";
                                   $result=mysqli_query($conn, $sql);
                                   $data_location=mysqli_fetch_array($result);
                   
                                 ?>   
                <div class="row">
                <div class="col-md-6">
                <label> Location Name</label>
                <input type="text" name="location_master_name" value="<?php echo $data_location['location_master_name']?>" class="form-control" placeholder="Enter Value" required>
                <input type="hidden" name="location_master_id" value="<?php echo $id?>" class="form-control" placeholder="Enter Value">
                </div>
                <div class="col-md-6">
                <label> Location Area Value</label>
                <input type="text" name="location_master_area" value="<?php echo $data_location['location_master_area']?>" class="form-control" placeholder="Enter Value" required>
                </div>
                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px; text-align:left;">
                <label > Location Description</label>
                <textarea type="text" class="form-control" name="location_master_description" value="" rows="3" placeholder="Enter Value" ><?php echo $data_location['location_master_description']?></textarea>

                </div>   
                </div>
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Update</button> 
    
                    </div>
                    </div>
                    <a href="location.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

                  </div>
                  <!-- submit button -->
                  </form>
                
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

