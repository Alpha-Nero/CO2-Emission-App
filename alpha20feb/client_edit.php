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
                <h3>Client Login Details</h3>
                    <!-- <div class="container-fluid"> -->

                       
                    <div class="card card-defaultas" style="margin:20px">
            <div class="card card-defaultas" style="margin:20px">
            <div class="card-header">
                <h5 class="card-title">Edit Client</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="client_editcode.php" method="POST">
                  <div class="row">
<?php
                foreach($client_data as $c_data)
                {
?>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="client_name" value="<?php echo $c_data['project_client_name']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>UserName</label>
                        <input type="email" name="username" value="<?php echo $c_data['project_username']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo $c_data['project_password']; ?>" class="form-control" id="myInput" placeholder="Password" required><br>
                        <input type="checkbox" onclick="myFunction()"> Show Password
                        <input type="hidden" name="project_user_id" value="<?php echo $c_data['project_user_id']; ?>" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  </div>

                  <script>
                        function myFunction() {
                        var x = document.getElementById("myInput");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                        }
                        </script>

              <!-- /.card-body -->
            </div>
            <button type="submit" name ="submit" class="btn btn-primary" style="margin: 20px; width:10%">Submit</button>
              
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



        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

