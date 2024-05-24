<?php
include 'auth.php';
// require 'includes/header_start.php';
include 'database.php'
?>


        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-lQN4BdxCCh5UO0Xn3z3B50s2V5iFww4Vl3bcJG5N6r4Y8bO8f5V0aoEm3m2w6Qgmf" crossorigin="anonymous">


<?php
//  require 'includes/header_end.php'; 
require 'header.php';
 ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
            <?php
$project_client_id=$_GET['project_client_id'];
$sql_client="select * from project_user where project_user_id='$project_client_id'";
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

                <!-- Start content -->
                <div class="content">
                <h3>Client Project Details</h3>
                    <!-- <div class="container-fluid"> -->

                    <?php

//delete div bbox
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
//update div box
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
//success div bbox
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
//error div bbox
if (isset($_GET['error'])) {
$errorMessage = $_GET['error'];

} else {
$errorMessage = "";
}

?>

<?php if (!empty($errorMessage)): ?>
<div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" >
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
<?php echo $errorMessage; ?>
</div>

<?php endif; ?>

                       
                    <div class="card card-defaultas" style="margin:20px"><br>
                    <a href="client_add.php" style="width:50px;"><button class="btn btn-primary" style="margin-left:20px;">Back</button></a>
            <div class="card card-defaultas" style="margin:20px">
            
            <div class="card-header">
                <h5 class="card-title">Client Details</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                  <div class="row">
                  <?php
                foreach($client_data as $c_data)
                {
?>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="client_name" value="<?php echo $c_data['project_client_name']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>UserName</label>
                        <input type="email" name="username" value="<?php echo $c_data['project_username']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" value="<?php echo $c_data['project_password']; ?>" class="form-control" id="myInput" placeholder="Password" required readonly><br>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                 
            </div>
            <?php
$project_client_id=$_GET['project_client_id'];
$sql_client="SELECT * from project_user as pu JOIN project_master as pm on pm.project_user_id=pu.project_user_id where pu.project_user_id='$project_client_id';";
$result_client=mysqli_query($conn,$sql_client);
$client_data=array();
if(mysqli_num_rows($result_client) > 0)
{
    while($fetch_client=mysqli_fetch_assoc($result_client))
    {
        $client_data[]=$fetch_client;
    }
}

$sql_assign_project="SELECT * from assign_project where user_id='$project_client_id'";
$result_assign_project=mysqli_query($conn,$sql_assign_project);
$assign_project=array();
if(mysqli_num_rows($result_assign_project) > 0)
{
    while($fetch_assign_project=mysqli_fetch_assoc($result_assign_project))
    {
        $assign_project[]=$fetch_assign_project;
    }
}

?>

<form action="client_add_assign_project.php" method="POST">
            <div class="card-body">
              <h3>Project List</h3>
           <table id="example1" class="table table-bordered table-striped">
             <thead>            
             <tr>
               <th style="width: 9%;">S.No.</th>
               <th style="width: 16%;">Project Name</th>
               <th style="width: 15%;">Project Start Date</th>
               <th style="width: 15%;">Project End Date</th>
               <th>Project Description</th>
               <th style="width: 8%;">Action</th>
             </tr>
            
               
            
            
             </thead>
             <?php 
                $sr=1;
                foreach($client_data as $c_data)
                { 
                    
                    $is_checked = false;
                    foreach ($assign_project as $assign) {
                       
                        if ($c_data['project_master_id'] == $assign['project_id']) {
                            $is_checked = true;
                            break;
                        }
                    }
            ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $c_data['project_name']; ?></td>
                        <td><?php echo $c_data['project_master_start_date']; ?></td>
                        <td><?php echo $c_data['project_master_end_date']; ?></td>
                        <td><?php echo $c_data['project_master_description']; ?></td>
                        <td>
                            <input type="checkbox" name="project_id[]" <?php echo $is_checked ? 'checked' : ''; ?> value="<?php echo $c_data['project_master_id']; ?>">
                            <input type="hidden" value="<?php echo $project_client_id; ?>" name="project_client_id">
                        </td>
                    </tr>
            <?php 
                    $sr++; 
                } 
            ?>

             <tfoot>
            
             </tfoot>
           </table>

           <br>
           <button type="submit" name ="submit" class="btn btn-primary" style="margin: 20px; width:10%">Submit</button>
        </div>
                            </form>
              </div>
          
            <!-- /.card -->

              <!-- /.card-header -->
            <!-- <div class="card-body">
           
           
         
         <hr>
               


         <div class="card-header">
                <h3 class="card-title">List of Facility</h3>
                
              </div>


                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.NO.</th>
                    <th>Facility Name</th>
                    <th>Cluster</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                  </tr>
                  <tfoot>
                  <tr>
                  <th>S.NO.</th>
                    <th>Facility Name</th>
                    <th>Cluster</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Action</th>
                    
                  </tr>
                  </tfoot>
                </table>
              </div> -->

                        

                       
                     
                    <!-- </div>  -->

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



                    </script>

        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

