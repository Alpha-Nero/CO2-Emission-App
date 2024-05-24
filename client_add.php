<?php
include 'auth.php';
// require 'includes/header_start.php';
include 'database.php'
?>


        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-lQN4BdxCCh5UO0Xn3z3B50s2V5iFww4Vl3bcJG5N6r4Y8bO8f5V0aoEm3m2w6Qgmf" crossorigin="anonymous">
    
        <style>
        /* Hide pagination */
        .dataTables_wrapper .dataTables_paginate {
            display: none;
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
                  
                <h3>Client Login Details</h3>
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
                       
                    <div class="card card-defaultas" style="margin:20px">
            <div class="card card-defaultas" style="margin:20px">
            <div class="card-header">
                <h5 class="card-title">Add Client</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="client_addcode.php" method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="client_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>UserName</label>
                        <input type="email" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                          <span id="passwordMatch" style="position:absolute;"></span>
                      </div>
                  </div>
                  </div>
                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#confirmPassword').on('keyup', function() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        
        if (password == confirmPassword) {
            $('#passwordMatch').html('Passwords match').css('color', 'green');
            $('#submitBtn').prop('disabled', false);
            $('#submitBtn').css('cursor','pointer');
        } else {
            $('#passwordMatch').html('Passwords do not match').css('color', 'red');
            $('#submitBtn').prop('disabled', true);
            $('#submitBtn').css('cursor','not-allowed');
            $('#submitBtn').css('background-color','#b28250');
        }
    });
});
</script>
<button type="submit" name ="submit" id="submitBtn" class="btn btn-primary" style="width:10%">Submit</button>
              <!-- /.card-body -->
                  </div>
                  
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
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <!-- DataTables Buttons CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">

  
            <div class="card-body">
              <h3>Clients List</h3>
              <table id="example1" class="table table-bordered table-striped">
        <thead>            
            <tr>
                <th style="width: 9%;">S.No.</th>
                <th>Client Name</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sr = 1;
            foreach ($client_data as $c_data) { ?>
                <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $c_data['project_client_name']; ?></td>
                    <td>
                        <?php
                        $url_ed = "client_edit.php?project_client_id=" . $c_data['project_user_id'];
                        $url_delete = "client_deletecode.php?project_client_id=" . $c_data['project_user_id'];
                        $url_viewproject = "client_view_project.php?project_client_id=" . $c_data['project_user_id'];
                        ?>
                        <div style="display:flex; justify-content:flex-start;">
                            <a href="<?php echo $url_ed; ?>"><i class="blue  zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="<?php echo $url_delete; ?>"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $url_viewproject; ?>"><i class="zmdi zmdi-eye" style="margin-right:0px; color:#b28250;"></i></a>
                        </td>
                </tr>
                <?php $sr++;
            } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Client Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                paging: false, // Disable pagination
                ordering: false // Disable sorting buttons
            });
        });
    </script>


           <br></div>

              </div>
              </form>
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

