<?php 
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
<style>
  a:hover{
    color:#0a0203;
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
                    <div class="col-sm-6">
                    <h4 style="margin-left:5%;">Data Source Group </h4>
                </div>




                    <div class="card">
                        <div class="card-body">



                        <?php
      if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];

      } else {
        $delete = "";
      }

      ?>

         <?php if (!empty($delete)): ?>
          <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="delete-message">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  <?php echo $delete; ?>
                </div>
        
        
          <?php endif; ?>



               <?php
			if (isset($_GET['update'])) {
				$update = $_GET['update'];

			} else {
				$update = "";
			}

			?>

         <?php if (!empty($update)): ?>
          <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="update-message">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  <?php echo $update; ?>
                </div>
        
        
          <?php endif; ?>

               <?php
			if (isset($_GET['success'])) {
				$success = $_GET['success'];

			} else {
				$success = "";
			}

			?>

         <?php if (!empty($success)): ?>
          <div class="alert alert-success alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="success-message">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  <?php echo $success; ?>
                </div>
        
        
          <?php endif; ?>
             
               <?php
			if (isset($_GET['error'])) {
				$errorMessage = $_GET['error'];

			} else {
				$errorMessage = "";
			}

			?>

         <?php if (!empty($errorMessage)): ?>
          <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto; margin-top:20px;padding:35px" id="error">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                   <?php echo $errorMessage; ?>
                </div>
        
          <?php endif; ?>


          <?php
			if (isset($_GET['error2'])) {
				$errorMessage2 = $_GET['error2'];

			} else {
				$errorMessage2 = "";
			}

			?>

         <?php if (!empty($errorMessage2)): ?>
          <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto; margin-top:20px;padding:35px" id="error2">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                   <?php echo $errorMessage2; ?>
                </div>
        
          <?php endif; ?>






                            <div class="card">
                                <form action="data_group_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Add Data Source Group </h4>
                                    </div>
                                    <hr>
                <div class="row">
                <div class="col-sm-6" >

                <?php
                $sql_ds="SELECT * FROM data_source order by data_source_name asc;";
                $result_ds=mysqli_query($conn,$sql_ds); 

                $data_ds=array();
                while($row=mysqli_fetch_assoc($result_ds)){
                    $data_ds[]=$row;

                }
           //  print_r($data_ds);


                ?>


                <label style=" font-weight:600;  ">Select Data Source</label>

                <select name="data_source_id" class="form-control" required >
                <option value="">Select</option>
                <?php
                foreach($data_ds as $value){

                ?>
                <option value="<?php echo $value['data_source_id']; ?>"><?php print_r($value['data_source_name']);?></option>

                <?php
                }
                ?>
                </select>
                </div> 
                <div class="col-sm-6" >
                <label style=" font-weight:600;">Add Data Source Group</label>
                <input type="text" class="form-control" name="data_source_group_name" placeholder="Enter Value" required>
                </div> 
               
                </div>
              
                  
                 

                  <br>
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
                  <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px; width:auto;">
                  <thead>

                 
                  <tr>
                                		<th style="width:5%">S.no</th>
                                    <th style="width:25%">Data Source</th>
                                		<th style="width:50%">Data Source Group</th>
                                		<th style="width:20%">Action</th>
                                    	</tr>
                  </form>
                  </thead>
                  <tbody>



                    <?php
                    
                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                     $sql = "SELECT * FROM data_source_group as dsg
                     join data_source as ds on dsg.data_source_id=ds.data_source_id
                     where dsg.is_visibility=1 and ds.is_visibility=1
                     order by dsg.data_source_group_id desc;";
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_dsg as array variable
                     $data_dsg=array();

                     //storing item table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_dsg[]=$row;
                         }

                     }    
                    
                  //   print_r($data_dsg);
                     // counting $data_consumption array rows
                 $count= count($data_dsg);

                    // echo count($data_dsg);

                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<$count; $i++){

                   //  echo "ok1";
                  ?>
                  <tr>
						       <td> <?php echo $z; ?> </td>
                   <td> <?php print_r($data_dsg[$i]['data_source_name']); ?></td>
						       <td> <?php print_r($data_dsg[$i]['data_source_group_name']); ?></td>
                  <td>
                    <?php 
                    $dsg_id=$data_dsg[$i]['data_source_group_id'];
                    $ds_id=$data_dsg[$i]['data_source_id'];
                    $del="delete_dsg.php?delete_id=". $dsg_id;
                    $edit="data_group_update.php?dsg_id=".$dsg_id."&ds_id=".$ds_id;
                    ?>
                    <div style="display:flex; justify-content:flex-start;">
                    <a href="<?php echo $edit ?>"><i class="blue  zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp;

                     <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete' style="margin-right:0px;color:#b28250;"></i></a>
                    </td>

                                
                <?php
                               $z++;
                      }
                   
                         ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                                    <th style="width:5%">S.no</th>
                                    <th style="width:25%">Data Source</th>
                                		<th style="width:50%">Data Source Group</th>
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

            <script>
              
const successMessage = document.getElementById('success-message');

// Function to hide the success message
const hideSuccessMessage = () => {
  successMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideSuccessMessage, 1000);



const updateMessage = document.getElementById('update-message');

// Function to hide the success message
const hideUpdateMessage = () => {
  updateMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideUpdateMessage, 1000);



const deleteMessage = document.getElementById('delete-message');

// Function to hide the success message
const hideDeleteMessage = () => {
  deleteMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideDeleteMessage, 1000);


const error = document.getElementById('error');

// Function to hide the success message
const hideerror = () => {
  error.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(error, 1000);



const error2 = document.getElementById('error2');

// Function to hide the success message
const hideerror2 = () => {
  error2.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(error2, 1000);




              </script>


        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

