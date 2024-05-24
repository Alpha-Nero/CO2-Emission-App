<?php 

include 'auth.php';
include_once 'db.php';

?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consumption Data | ADIPEC ESG Tool</title>

  
  <!--Adding stylesheets and favicon -->
  <?php include 'link.php'; ?>
  
</head>
<body class="hold-transition sidebar-mini">


<div class="wrapper">
  
  <!-- Add Header file for menu -->
  <?php include 'header.php';?>
  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 style="margin-left: 22px;">Entire Consumption Data</h4>
             </div>
          <div class="col-sm-6">
           <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <a href="consumption.php"><input type="submit" style="margin-left:2%;" class="btn btn-info" name="addnewpatient" value="Add Consumption"></a></h1>
                </h3>
                
              </div>
              <!-- /.card-header -->
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

                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                 
                  <tr>
                    <th style="width: 20%;">S.No.</th>
                    <th style="width: 60%;">Month and Year</th>
                    <th style="width: 20%;">Action</th>
					
                  </tr>
                  </form>
                  </thead>
                  <tbody>



                    <?php
                    

                    //fetching facility id from logincode page
                    $facility_id=$_SESSION['auth_user']['facility_id'];

                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                     $sql = "SELECT distinct  consumption_month , consumption_year from consumption where facility_id='$facility_id' order by  consumption_id desc";
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_consumption as array variable
                     $data_consumption=array();

                     //storing consumption table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_consumption[]=$row;
                         }

                     }    
                    
                     // counting $data_consumption array rows
                     $count= count($data_consumption);

                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<$count; $i++){

                      //storing month in consumption_month variable
                      $consumption_month=$data_consumption[$i]['consumption_month'];
                      //storing year in consumption_year variable
                      $consumption_year=$data_consumption[$i]['consumption_year'];
                   
                      
                  ?>
                  <tr>
						       <td><?php echo "$z"?> </td>
						       <td>
                 <?php  
                     //preparing url key for href tag with storing value in consumption_month=$consumption_month and consumption_year=$consumption_year
                     $url="viewconsumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year;
                     $url_edit="updateconsumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&facility_id=".$facility_id;
                     $url_dup="duplicate_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&facility_id=".$facility_id;
                     
                     $url_del="delete_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&facility_id=".$facility_id;
                     
                    // echo $url;
                 ?> 
                    <!-- set href url by php echo $url--> 
                    <a href="<?php  echo $url ?>">
                <?php   
                      print_r($consumption_month);
                      echo ' ';
                      print_r($consumption_year);
               ?>       </a>
                  </td>
					        <td><a href="<?php echo $url_edit; ?>"><i class="fas fa-edit"></a></i>
                  
                  <a href="<?php echo $url_del; ?>"><i class="fas fa-trash" style="margin-left:25px ;margin-right:25px ;"></i></a>
                <a href="<?php echo $url_dup; ?>"> Duplicate</a>  
                  </td>
                                
                <?php

                    $z++;
                      }
                   
                          /*  else {?>
                            <tr>
                            <td colspan="8">No data found</td>
                            </tr>
                            <?php 
                        }*/
                            ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>S.No.</th>
                    <th>Month and Year</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer-->
  <?php include 'footer.php';?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>

  

const successMessage = document.getElementById('success-message');

// Function to hide the success message
const hideSuccessMessage = () => {
  successMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideSuccessMessage, 1000);


const deleteMessage = document.getElementById('delete-message');

// Function to hide the success message
const hideDeleteMessage = () => {
  deleteMessage.style.display = 'none';
};

// Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
setTimeout(hideDeleteMessage, 1000);



</script>


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="../../dist/js/demo.js"></script>-->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
