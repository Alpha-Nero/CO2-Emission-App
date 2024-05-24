<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';


$id=$_GET['item_id']
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">

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
                                <form action="item_category_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Edit Items</h4>
                                    </div>
                                    <hr>

                    <?php

                    $sql="SELECT * FROM item_category where item_category_id=$id;";
                    $result=mysqli_query($conn, $sql);
                    $data_item=mysqli_fetch_array($result);

                    // print_r($data_item);

                    ?>
               
                <div class="row">

               
                <div class="col-sm-12" style="text-align:left;" >
                <label >Item Code</label>
                <input type="text" class="form-control" name="item_category_name" value="<?php echo $data_item['item_category_name'] ?>" placeholder="Enter Value">
                <input type="hidden" class="form-control" name="item_category_id" value="<?php echo $data_item['item_category_id'] ?>">
                </div> 
               
                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px; text-align:left;">
                <label>Description</label>
                 <textarea type="text" class="form-control" name="item_category_description" rows="3" placeholder="Enter Value"><?php echo $data_item['item_category_description']; ?></textarea>

                </div>   
                </div>
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Update</button> 
    
                    </div>
                    </div>
                    <a href="item_category.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

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


