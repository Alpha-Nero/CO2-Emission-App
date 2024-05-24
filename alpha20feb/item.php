<?php
include 'auth.php';


include 'database.php';
error_reporting(0);
?>

<!--Morris Chart CSS -->
<link rel="stylesheet" href="plugins/morris/morris.css">
<style>
.col-sm-2{
  text-align:left;
}
.bold-tabl{
  font-weight:bold;
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

.dataTables_wrapper .dt-buttons {
    /* margin-top: 0px; Adjust the value as needed */
    position: absolute;
}


</style>


<?php

require 'header.php';

?>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <div class="col-sm-6" style="text-align:left;">
        <h4 style="margin-left: 22px;">Items </h4>
      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <!-- DataTables Buttons CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css"> -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">

      <div class="card">
        <div class="card-body">
          <div class="card">
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

            <form action="item_code.php" method="POST">
              <div class="card-body">
                <div class="row">
                  <h4 style="margin-left: 1%;">Add Items</h4>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-2">

                    <?php
                    $sql_ic = "SELECT * FROM item_category order by item_category_name asc;";
                    $result_ic = mysqli_query($conn, $sql_ic);

                    $data_ic = array();
                    while ($row = mysqli_fetch_assoc($result_ic)) {
                      $data_ic[] = $row;

                    }
                    //  print_r($data_ic);
                    

                    ?>



                    <label>Item Category</label>

                    <select name="item_category_id" class="form-control" onchange='reload()' id=s1 style="width:8em;" required>
                      <option value="">Select</option>
                      <?php
                      foreach ($data_ic as $value) {

                        if($value['item_category_id']==$_GET['$key'])
                        {
                        ?>
                        
                        <option value="<?php echo $value['item_category_id']; ?>" selected>
                          <?php print_r($value['item_category_name']); ?>
                        </option>

                        <?php
                      }else{
                      ?>
                      <option value="<?php echo $value['item_category_id']; ?>" >
                          <?php print_r($value['item_category_name']); ?>
                        </option>
                      <?php } } ?>
                    </select>
                  </div>
                  <div class="col-sm-2" style="margin-left:-40px;">
                    <label style="margin-left:20px;">Item Code</label>
                    <input type="text" class="form-control" name="item_code" placeholder="Enter Value" style="width:8em;
                 margin-left:16px;" required>
                  </div>


                  <?php
                  $sql_unit = "SELECT * FROM item_unit order by item_unit_name asc;";
                  $result_unit = mysqli_query($conn, $sql_unit);

                  $data_unit = array();
                  while ($row = mysqli_fetch_assoc($result_unit)) {
                    $data_unit[] = $row;

                  }

                  ?>

                  <div class="col-sm-1" style="margin-left:-40px;">
                    <label style="margin-left:49px;">Unit1</label>
                    <select name="item_unit" class="form-control" style="width:6em; margin-left:36px;" required>
                      <option value="">Select</option>
                      <?php
                      foreach ($data_unit as $value) {

                        ?>
                        <option value="<?php echo $value['item_unit_name']; ?>">
                          <?php print_r($value['item_unit_name']); ?>
                        </option>

                        <?php
                      }
                      ?>
                    </select>
                  </div>

                  <!-- second unnit -->
                  <div class="col-sm-1" style="margin-left:3em;">
                    <label style="margin-left:40px;">Unit2</label>
                    <select name="item_unit2" class="form-control" style="width:7em; margin-left:25px;">
                      <option value="">Select</option>
                      <?php
                      foreach ($data_unit as $value) {

                        ?>
                        <option value="<?php echo $value['item_unit_name']; ?>">
                          <?php print_r($value['item_unit_name']); ?>
                        </option>

                        <?php
                      }
                      ?>
                    </select>
                  </div>


                  <div class="col-sm-2" style="margin-left:40px;">
                    <label style="margin-left:24px;">Emission Factor</label>
                    <input type="text" class="form-control" name="item_emission_factor" placeholder="Enter Value"
                      style="width:90%; margin-left:28px;" required>
                  </div>
                  <div class="col-sm-2" style="margin-left:-4px;">
                    <label style="margin-left:30px;">Ideal Emission</label>
                    <input type="text" class="form-control" name="ideal_emission_factor" placeholder="Enter Value"
                      style="width:90%; margin-left:24px;" required>

                  </div>
                  <div class="col-sm-2">
                    <label style="margin-left:10px;">Material Details</label>
                    <input type="text" class="form-control" name="item_material_detail" placeholder="Enter Value"
                      style="width:90%; margin-left:16px;">

                  </div>
                </div>
                <div class="row">
                  <div class="card-body" style="margin: -10px; text-align:left">
                    <label>Description</label>
                    <textarea type="text" class="form-control" name="item_description" rows="3"
                      placeholder="Enter Value"></textarea>

                  </div>
                </div>

                
                <!-- <br>




                <br> -->
                <div class="row">

                  <div class="col-sm-6">
                    <div class="form-group">
                      <button class="btn btn-info" type="submit" name="submit"
                        style=" margin-top:0px">Submit</button>
                        <br></br>
                      <!-- Button trigger modal -->
                      <br>
                   <p style="text-align:left;">   <a href="documents/Project_add_Item_Template.xlsx"><i style="color:#b28250" id="uploadlink"><u >Download Items Upload Template</i></u></a></p>
                      </br>
                      
                      <button type="button" id="btnshow"  class="btn btn-info btn-primary" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Upload File                        
                      </button>
                    

                    </div>
                  </div>
                </div>
               

                <!-- submit button -->

            </form>
            <?php
            ?>
          </div>
           <!-- Modal -->
           <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Project Item Detail File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="itemForm3" method="POST" action="project_add_item_code.php" enctype="multipart/form-data">
                          <!-- Form fields go here -->
                          <div class="form-group " style="text-align:left;">
                            <label for="item_category_id">Select Item</label>
                            <input type="file" name="item_doc" class="form-control" style="height: 40px">
                          </div>
                          <div class="row">
                            <div class="form-group col-md-12">
                              <input type="hidden" class="form-control" name="project_master_id"
                                value="<?php echo $project_master_id ?>" placeholder="Enter Qunatity">
                               

                            </div>
                          </div>
                          <br>
                          <button type="submit" class="btn btn-info btn-primary col-md-12" name="save">Submit</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                       
                      </div>
                    </div>
                  </div>
                </div>

               

        </div>
        <br>
        <br>
        <br>
        <!-- -------------------------------------------- -->
        <form action="delete_item.php" method="post" id="deleteForm">
    <div class="row">
        
         
    <!-- <span>Check All</span> -->
            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
            
             
                <thead>
                  
                <tr>
                
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">SR.NO</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Item Category</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Platform(s): activate to sort column ascending">Item Code</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Engine version: activate to sort column ascending">Item Description</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Unit1</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Unit2</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Emission Factor</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Ideal Emission</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Material Detail</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="CSS grade: activate to sort column ascending">Action <br>  
            
                </th>
              </tr>
                </thead>
                <tbody>

                    <?php
                    $itemid = $_GET['$key'];
                    $data_month = array();

                    $sql = '';
                    if (empty($itemid)) {
                        $sql = "SELECT * FROM item as it
                                JOIN item_category as ic ON it.item_category_id = ic.item_category_id
                                WHERE it.item_is_visibility = 1  
                                ORDER BY item_id DESC";
                    } else {
                        $sql = "SELECT * FROM item as it
                                JOIN item_category as ic ON it.item_category_id = ic.item_category_id
                                WHERE it.item_is_visibility = 1 AND it.item_category_id = $itemid
                                ORDER BY item_id DESC";
                    }

                    $result = mysqli_query($conn, $sql);

                    $data_Item = array();

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data_item[] = $row;
                        }
                    }

                    if (!empty($data_item)) {
                        $z = 1;

                        for ($i = 0; $i < count($data_item); $i++) {
                            ?>

                            <tr>
                                <td><?php echo $z; ?></td>
                                <td>
                    <?php print_r($data_item[$i]['item_category_name']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_code']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_description']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_unit']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_unit2']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_emission_factor']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['ideal_emission_factor']); ?>
                  </td>
                  <td>
                    <?php print_r($data_item[$i]['item_material_detail']); ?>
                  </td>
                                <!-- Your other table cells -->
                                <td>
                                    <?php
                                    $item_id = $data_item[$i]['item_id'];
                                    $del = "delete_item.php?item_id=" . $item_id;
                                    $edit = "item_update.php?item_id=" . $item_id;
                                    ?>
                                    <div style="display:flex; justify-content:flex-start;">
                                        <a href="<?php echo $edit ?>"><i class="blue zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a>
                                        &nbsp;|&nbsp;
                                        <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a>
                                        &nbsp;|&nbsp;
                                        <input type="hidden" name="selectedItems[]" id="selectedItemsInput" value="">
<input type="checkbox" class="checkbox" name="selectedItemsCheckbox[]" style="margin-top: 2px;" data-item-id="<?php echo $item_id; ?>" id="selectedItemsCheckbox_<?php echo $item_id; ?>">
                                    </div>
                                </td>
                            </tr>

                            <?php
                            $z++;
                        }
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan=10 ><span style="margin-left: 88%;position: absolute;margin-top: 10px;"><input type="checkbox" class="checkbox" id="checkAll" style="width: 15px!important;height: 15px!important;"></span><span style="margin-left:94%;"><button type="submit" id="deletebtn" class="btn btn-danger" style="background: #b28250!important;border-color: #b28250!important;">Delete</button></span></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
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
                    url: 'delete_item.php',
                    data: { selectedItems: selectedItems },
                    success: function (response) {
                        if (response == 1) {
                            var msg = "Data deleted successfully!";
                            self.location = 'item.php?success=' + msg;
                        } else {
                            var msg = "Data not deleted!";
                            self.location = 'item.php?error=' + msg;
                        }
                    },
                    error: function (error) {
                        // console.error('AJAX request failed: ', error);
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
            drawCallback: function () {
                // Restore the "checkAll" state after DataTable is redrawn
                // if (checkAllState) {
                //     table.page(checkAllPage - 1).draw(false);
                //     $('#checkAll').prop('checked', true);
                //     checkAllState = false;
                // }
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
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
 <!-- Bootstrap JS -->
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<script>
  function reload(){
    var s1=document.getElementById('s1').value 
    self.location='item.php?$key='+s1;
  }
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


<!--Morris Chart-->
<script src="plugins/morris/morris.min.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>

<!-- Page specific js -->
<script src="assets/pages/jquery.dashboard.js"></script>