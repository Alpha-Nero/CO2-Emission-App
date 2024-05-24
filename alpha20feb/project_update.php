<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';
$id=$_GET['update_id'];
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
                    <div class="col-sm-6" style="text-align:left;">
                    <h4 style="margin-left: 22px;">Project </h4>
                </div>

                <?php

$sql_client="select * from project_user";
$result_client=mysqli_query($conn,$sql_client);
$client_data=array();
if(mysqli_num_rows($result_client) > 0)
{
    while($fetch_client=mysqli_fetch_assoc($result_client))
    {
        $client_data[]=$fetch_client;
    }
}

?>


                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <form action="project_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Edit Project</h4>
                                    </div>
                                    <hr>
                <?php
                  $sql="SELECT * FROM project_master where project_master_id=$id;";
                  $result=mysqli_query($conn, $sql);
                  $data_project=mysqli_fetch_array($result);
  
                ?>                    
                <div class="row">
              
                <div class="col-sm-3" style="text-align:left;">
                <label >Project Name*</label>
                <input type="text" class="form-control" name="project_name" value="<?php echo $data_project['project_name']?>" placeholder="Enter Value" required>
                <input type="hidden" class="form-control" name="project_master_id" value="<?php echo $data_project['project_master_id']?>" placeholder="Enter Value" >
                </div> 
                <div class="col-sm-3" style="text-align:left;" > 
                <label >Start Date</label>
                <input type="date" class="form-control" name="project_master_start_date" value="<?php echo $data_project['project_master_start_date']?>" placeholder="Enter Value" required>
                </div> 
                <div class="col-sm-3" style="text-align:left;" >
                <label >End Date</label>
                <input type="date" class="form-control" name="project_master_end_date" value="<?php echo $data_project['project_master_end_date']?>" placeholder="Enter Value" required>
                </div> 
                <div class="col-sm-3" >
                <label >Select Client</label>
                <select class="form-control select2" name="project_client_id" data-dropdown-css-class="select2" id="monthSelect" required>
                    			
                                <option value="">Select Client</option>
                                <?php
                                        foreach($client_data as $c_data) {
                                            ?>
                                            <option value="<?php echo $c_data['project_user_id']; ?>" <?php echo ($c_data['project_user_id']===$data_project['project_user_id']) ? 'selected' : ''; ?>>
                                                <?php echo $c_data['project_client_name']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>

            
                                </select>
                </div>
                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px;text-align:left;">
                <label >Description</label>
                <textarea type="text" class="form-control" name="project_master_description" rows="5" placeholder="Enter Value" ><?php echo $data_project['project_master_description']?></textarea>

                </div>   
                </div>
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-6">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style=" margin-top:0px">Update</button> 
    
                    </div>
                    </div>
                  </div>
                  
<!-- submit button -->
                
                  </form>
                  <?php
                  ?>
                  </div>
                                   

              



                  </div>




                  <?php 

                 
                  
                  ?>
               

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

