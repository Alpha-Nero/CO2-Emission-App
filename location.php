<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
            .col-md-6{
                text-align:left;
            }
        </style>

<?php
//  require 'includes/header_end.php';
require 'header.php';
 ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6" style="text-align:left;">
                    <h4 style="margin-left: 22px;">Location</h4>
                </div>




                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <form action="location_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Add Location</h4>
                                    </div>
                                    <hr>
                <div class="row">
               <div class="col-md-6">
                <label> Location Name</label>
                <input type="text" name="location_master_name" class="form-control" placeholder="Enter Value" required>
               </div>
               <div class="col-md-6">
                <label> Location Area Value</label>
                <input type="text" name="location_master_area" class="form-control" placeholder="Enter Value" required>
               </div>
                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px; text-align:left">
                <label > Location Description</label>
                <textarea type="text" class="form-control" name="location_master_description" rows="3" placeholder="Enter Value" ></textarea>

                </div>   
                </div>
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-6">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style=" margin-top:0px">Submit</button> 
    
                    </div>
                    </div>
                  </div>
                  
<!-- submit button -->
                
                  </form>
                  <?php
                  ?>
                  </div>
                                   

              



                  </div>
                  <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
                  <thead>

                 
                  <tr>
                                		<th style="width:10%">S.no</th>
                                    <th style="width:30%">Location Name</th>
                                		
                                		<th style="width:30%">Location Description</th>
                                		
                                		<th style="width:10%">Location Area Value</th>
                                        <th style="width:20%">Action</th>
                                 	</tr>
                  </form>
                  </thead>
                  <tbody>



                    <?php
                    
                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                     $sql = "SELECT * FROM location_master 
                     where location_master_is_visibility=1
                     order by location_master_id desc;";
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_item as array variable
                     $data_item=array();

                     //storing item table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_item[]=$row;
                         }

                     }    
                    
                    // print_r($data_item);
                     // counting $data_consumption array rows
               //  $count= count($data_item);

                    // echo count($data_item);

                    if(!empty($data_item)){
                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<count($data_item); $i++){

                   //  echo "ok1";
                  ?>
                  <tr>
						       <td> <?php echo $z; ?> </td>
                               <td> <?php print_r($data_item[$i]['location_master_name']); ?></td>
						       <td> <?php print_r($data_item[$i]['location_master_description']); ?></td>
                               <td> <?php print_r($data_item[$i]['location_master_area']); ?></td>
                     <td>
                    <?php 
                    $location_master_id=$data_item[$i]['location_master_id'];
                    $del="delete_location.php?location_id=". $location_master_id;
                    $edit="location_update.php?location_id=".$location_master_id;
                    ?>
                    <div style="display:flex; justify-content:flex-start;">
                    <a href="<?php echo $edit ?>"><i class="blue zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp;

                     <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete'style="margin-right:0px; color:#b28250;"></i></a>
                    </td>

                                
                <?php
                               $z++;
                      //for loop end here
                      }
                   //if condition end here
                    }
                         ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width:10%">S.no</th>
                  <th style="width:30%">Location Name</th>
                                		
                  <th style="width:30%">Location Description</th>
                                		
                  <th style="width:10%">Location Area Value</th>
                  <th style="width:20%">Action</th>
                                    		</tr>
                  </tfoot>
                </table>

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

