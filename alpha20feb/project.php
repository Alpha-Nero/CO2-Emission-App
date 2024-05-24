<?php
include 'auth.php';
// require 'includes/header_start.php';
error_reporting(0);
include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
            label{
                text-align:left;
            }
            input[type='checkbox']{
  width: 10px !important;
  height: 10px !important;
  /* margin: 5px; */
  -webkit-appearance: none;
  -moz-appearance: none;
  -o-appearance: none;
  appearance: none;
  outline: 1px solid gray;
  box-shadow: none;
  font-size: 0.8em;
  text-align: center;
  line-height: 1em;
  background: #b28250;
  
}
 
input[type='checkbox']:checked:after {
  content: '✔';
  color: white;
}
.custom-confirm-btn {
    background-color: #b28250 !important;
    font-family: 'Nexa', sans-serif !important;
}

.custom-cancel-btn {
    background-color: #b28250 !important;
    font-family: 'Nexa', sans-serif !important;
}

/* Style for DataTable buttons */
.dataTables_wrapper .dt-buttons .btn {
    background-color: #b28250 !important;
    color: #fff !important;
    border-color: #b28250 !important;
}

/* Hover style for DataTable buttons */
.dataTables_wrapper .dt-buttons .btn:hover {
    background-color: black !important;
    border-color: black !important;
}
/* Style for DataTable pagination buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    color: #fff !important;
    background-color: #b28250 !important;
    border-color: #b28250 !important;
}

/* Hover style for DataTable pagination buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #e16a33 !important;
    border-color: #e16a33 !important;
}
.pagination > li > a
{
    background-color: white;
    color: #5A4181;
}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover
{
    color: #5a5a5a;
    background-color: #eee;
    border-color: #ddd;
}

.pagination > .active > a
{
    color: white;
    background-color: #b28250 !Important;
    border: solid 1px #b28250 !Important;
}

.pagination > .active > a:hover
{
    background-color: black !Important;
    border: solid 1px black;
}

/* Add margin to DataTable buttons */
.dataTables_wrapper .dt-buttons {
    /* margin-top: 0px; Adjust the value as needed */
    position: absolute;
}
#deletebtn:hover{
  background: black!important;
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
                    <div class="col-sm-6">
                    <h4 style="margin-left:4%;">Project </h4>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

                  <!-- DataTables Buttons CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> -->
 <!-- Bootstrap CSS -->
 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <!-- DataTables Buttons CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
  <!-- DataTables Buttons JS -->
  <!-- <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script> -->
  

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <!-- DataTables CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"> -->
  <!-- DataTables Buttons CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"> -->
  <!-- jQuery -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-Gn5384UqQ/AqQ 4f8tp5YllZ9f+J52b9IukFpr3zNl+g=" crossorigin="anonymous"></script> -->
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">



                    <div class="card">
                        <div class="card-body">




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
                                <form action="project_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Add Project</h4>
                                    </div>
                                    <hr>
                <div class="row">
              
                <div class="col-sm-3" >
                <label >Project Name*</label>
                <input type="text" class="form-control" name="project_name" placeholder="Enter Value" required>
                </div> 
                <div class="col-sm-3" > 
                <label >Start Date</label>
                <input type="date" class="form-control" name="project_master_start_date" placeholder="Enter Value" required>
               
                </div> 
                <div class="col-sm-3" >
                <label >End Date</label>
                <input type="date" class="form-control" name="project_master_end_date" placeholder="Enter Value" required>
                </div>
                <div class="col-sm-3" >
                <label >Select Client</label>
                <select class="form-control select2" name="project_client_id" data-dropdown-css-class="select2" id="monthSelect" required>
                    			
                                <option value="">Select Client</option>
                               <?php
                                        foreach($client_data as $c_data)
                                        { ?>
                                                <option value="<?php echo $c_data['project_user_id']; ?>"><?php echo $c_data['project_client_name'];  ?></option>
                                        <?php }
                               ?>
            
                                </select>
                </div> 
               
                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px;">
                <label style="">Description</label>
                <textarea type="text" class="form-control" name="project_master_description" rows="5" placeholder="Enter Value" ></textarea>

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

                  <br> <br> <br>


                  <?php 

                 
                  
                  ?>
                   <form action="delete_project.php" method="post" id="deleteForm">
                  <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px;">
                  <thead>

                 
                  <tr>
                                		<th style="width:5%">S.no</th>
                                    <th style="width:20%">Project Name</th>
                                		<th style="width:30%">Project Description</th>
                                		<th style="width:15%">Start Date</th>
                                		<th style="width:15%">End Date</th>
                                		<th style="width:15%">Client Name</th>
                                		<th style="width:10%">Action</th>
                                    	</tr>
                  </form>
                  </thead>
                  <tbody>



                    <?php
                    
                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                     $sql = "SELECT * FROM project_master where project_master_is_visibility=1
                     order by project_master_id desc;";
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_project as array variable
                     $data_project=array();

                     //storing item table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_project[]=$row;
                         }

                     }    
                    
                  //   print_r($data_project);
                     // counting $data_consumption array rows
                 $count= count($data_project);

                    // echo count($data_project);

                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<$count; $i++){

                   //  echo "ok1";
                   $project_user_id=$data_project[$i]['project_user_id'];
                   $sql_client="select * from project_user where project_user_id='$project_user_id'";
                   $result_client=mysqli_query($conn,$sql_client);
                   $fetch_client=mysqli_fetch_assoc($result_client);
                   $project_client_name=$fetch_client['project_client_name'];
                   $client_name=!empty($project_client_name) ? $project_client_name : '';


                   $item_id=$data_project[$i]['project_master_id'];
                   $view="view_project.php?id=". $item_id;
                  ?>
                  <tr>
						       <td> <?php echo $z; ?> </td>
                   <td> <a href="<?php echo $view?>"><?php print_r($data_project[$i]['project_name']); ?></a></td>
						       <td> <?php print_r($data_project[$i]['project_master_description']); ?></td>
                   <td> <?php print_r($data_project[$i]['project_master_start_date']); ?></td>
                   <td> <?php print_r( $data_project[$i]['project_master_end_date']); ?></td>
                   <td> <?php echo $client_name; ?></td>
                      <td>
                    <?php 
                   
                    $del="delete_project.php?delete_id=". $item_id;
                    $edit="project_update.php?update_id=".$item_id;
                    ?>
                    <div style="display:flex; justify-content:flex-start;">
                    <a href="<?php echo $edit ?>"><i class="blue  zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;

                     <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                        <input type="hidden" name="selectedItems[]" id="selectedItemsInput" value="">
<input type="checkbox" class="checkbox" name="selectedItemsCheckbox[]" style="margin-top: 2px;" data-item-id="<?php echo $item_id; ?>" id="selectedItemsCheckbox_<?php echo $item_id; ?>">
                    </td>

                                
                <?php
                               $z++;
                      }
                   
                         ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                        <th colspan=7 ><span style="margin-left: 86%;position: absolute;margin-top: 10px;"><input type="checkbox" class="checkbox" id="checkAll" style="width: 15px!important;height: 15px!important;"></span><span style="margin-left:94%;"><button type="submit" id="deletebtn" class="btn btn-danger" style="background: #b28250!important;border-color: #b28250!important;">Delete</button></span></th>
                    </tr>
                  </tfoot>
                </table>
                </form>

                <script>
$.fn.dataTable.ext.errMode = 'none';
$(document).ready(function () {
    var selectedItems = [];
    var checkAllState = false;
    var checkAllPage = 1;

    // Use event delegation to handle dynamically generated checkboxes
    $('#example1').on('change', '.checkbox', function () {
        var itemId = $(this).data('item-id');

        if (this.checked) {
            selectedItems.push(itemId);
        } else {
            // Remove the unchecked item ID from the array
            selectedItems = selectedItems.filter(id => id !== itemId);
        }
    });

 // Assuming you have a button with ID 'deletebtn' to trigger the AJAX request
$('#deletebtn').on('click', function (e) {
    e.preventDefault();
    if (selectedItems.length > 0) {
        // Show a custom confirmation box with customized button colors
        Swal.fire({
            // title: 'Confirm Deletion',
            text: 'Are you sure you want to delete the selected items?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            confirmButtonColor: '#b28250',  // Custom color
            cancelButtonColor: '#b28250',   // Custom color
            customClass: {
                confirmButton: 'custom-confirm-btn',
                cancelButton: 'custom-cancel-btn',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "Yes", proceed with deletion
                $.ajax({
                    type: 'POST',
                    url: 'delete_project.php',
                    data: { selectedItems: selectedItems },
                    success: function (response) {
                      // alert(response);
                        if (response == 1) {
                            var msg = "Data deleted successfully!";
                            self.location = 'project.php?success=' + msg;
                        } else {
                            var msg = "Data not deleted!";
                            self.location = 'project.php?error=' + msg;
                        }
                    },
                    error: function (error) {
                        console.error('AJAX request failed: ', error);
                    }
                });
            } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                // User clicked "No" or closed the modal, show cancellation message
                Swal.fire({
                    title: 'Deletion Cancelled',
                    // text: 'You clicked No or closed the modal',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'custom-confirm-btn',
                        cancelButton: 'custom-cancel-btn',
                    },
                });
            }
        });
    } else {
        // Show a custom alert for not checking the checkbox
        Swal.fire({
            // title: 'Custom Alert',
            text: 'Please First Check the CheckBox',
            icon: 'info',
            confirmButtonText: 'OK',
            confirmButtonColor: '#b28250',  // Custom color
            borderColor: '#b28250',
            customClass: {
                confirmButton: 'custom-confirm-btn',
            },
        });
    }
});



    // Check if DataTable is already initialized on the table
    if (!$.fn.DataTable.isDataTable('#example1')) {
        var table = $('#example1').DataTable({
            stateSave: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            
        });

        // Assuming you have a button with ID 'checkAll' for checking/unchecking all checkboxes
        $('#checkAll').on('click', function () {
            checkAllState = !checkAllState;
            var currentPage = table.page.info().page + 1;

            // Update DataTable state to reflect the "checkAll" state
            table.rows().every(function () {
                this.data().checked = checkAllState;
            });

            checkAllPage = currentPage;

            // Update the UI without triggering the change event
            $('#example1 .checkbox').prop('checked', checkAllState);

            // Manually trigger the change event on the checkboxes only if the master checkbox is checked
            if (checkAllState) {
                $('#example1 .checkbox').change();
            } else {
                // Clear the selectedItems array when the master checkbox is unchecked
                selectedItems = [];
            }
        });

        // Handle DataTable page change event
        table.on('draw', function () {
            console.log('DataTable draw event');
            var anyChecked = selectedItems.length > 0 || $('#checkAll').prop('checked');

            if (anyChecked && (table.page.info().page + 1 !== checkAllPage)) {
                console.log('Reloading page');
                location.reload();
            }
        });
    }

   
});


  
</script>
                            </div>

                        </div>
                    </div>



                        

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>
            <!-- End content-page -->


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

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
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


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

