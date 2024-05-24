<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
            th{
                font-weight:600;
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
                    <div class="col-sm-6"style="text-align:left;">
                    <h4 style="margin-left: 22px;">Items Unit</h4>
                </div>




                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <form action="item_unit_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row"style="text-align:left;">
                                        <h4 style="margin-left: 1%;">Add Items Unit</h4>
                                    </div>
                                    <hr>
                <div class="row">
               <div class="col-md-6"style="text-align:left;">
                <label> Add Unit Name</label>
                <input type="text" name="item_unit_name" class="form-control" placeholder="Enter Value" required>
               </div>

               <div class="col-md-6"style="text-align:left;">
                <label> Add Unit Quantity</label>
                <input type="text" name="item_unit_quantity" class="form-control" placeholder="Enter Value" required>
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
                  <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px; width:100%;">
                  <thead>

                 
                  <tr >
                                		<th style="width:10%">S.no</th>
                                    <th style="width:30%">Item Unit Name</th>
                                		
                                		<th style="width:40%">Item Unit Quantity</th>
                                		
                                		<th style="width:10%">Action</th>
                                    	</tr>
                  </form>
                  </thead>
                  <tbody>



                    <?php
                    
                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                     $sql = "SELECT * FROM item_unit
                     order by item_unit_id desc;";
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_item as array variable
                     $data_Item=array();

                     //storing item table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_item[]=$row;
                         }

                     }    
                    
                  //   print_r($data_item);
                     // counting $data_consumption array rows
                 $count= count($data_item);

                    // echo count($data_item);

                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<$count; $i++){

                   //  echo "ok1";
                  ?>
                  <tr>
						       <td> <?php echo $z; ?> </td>
                   <td> <?php print_r($data_item[$i]['item_unit_name']); ?></td>
						       <td> <?php print_r($data_item[$i]['item_unit_quantity']); ?></td>
                     <td>
                    <?php 
                    $item_unit_id=$data_item[$i]['item_unit_id'];
                    $del="delete_item_unit.php?unit_id=". $item_unit_id;
                    $edit="item_unit_update.php?unit_id=".$item_unit_id;
                    ?>
                    <div style="display:flex; justify-content:flex-start;">
                    <a href="<?php echo $edit ?>"><i class="blue zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp;

                     <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete'style="margin-right:0px; color:#b28250;"></i></a>
                    </td>

                                
                <?php
                               $z++;
                      }
                   
                         ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width:10%">S.no</th>
                                    <th style="width:30%">Item Unit Name</th>
                                		
                                		<th style="width:40%">Item Unit Quantity</th>
                                		
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

