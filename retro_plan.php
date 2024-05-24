<?php 
    include 'auth.php';
    // require 'includes/header_start.php';

    include 'database.php';
    error_reporting(0);
    ?>

            <!--Morris Chart CSS -->
            <link rel="stylesheet" href="plugins/morris/morris.css">
            <style>
              .zmdi{
                margin-right:0px;
              }
              .icon-hover:hover, .zmdi-edit:hover{
                color:#0a0203;
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
                        <h3>Emission Factor Repository</h3>
                    </div>


                  



                        <div class="card">
                            <div class="card-body">
                            <?php

                  //fetching key value in varibale its select icon value                        
                  $key=$_GET['key'];
                  //echo $key;
                            ?>

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
              <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" id="error-message" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                      <?php echo $errorMessage; ?>
                    </div>
            
              <?php endif; ?>



                          <?php
                                $facility_id=$_SESSION['auth_user']['facility_id'];
                                if($facility_id===0)
                                {
                          ?>              
              <div class="row">
                      
                      <div class="card col-md-12"><br>
                        <form id="itemForm3" method="POST" action="upload_retro_excel.php" enctype="multipart/form-data">
                          <!-- Form fields go here -->
                          <div class="form-group " >
                            <label for="" style="font-size: x-large;">Select Item</label>
                            <input type="file" name="retro_file" class="form-control" style="height: 40px" required>
                          </div>
                        
                          <br>
                          <button type="submit" class="btn btn-info btn-primary col-md-12" style="width: 180px;" name="save">Upload Repository File</button>
                        </form>
                      </div>
                     
                      </div>
                      <?php } ?>
                      <br>
                      <div class="row">
                      <a href="retro_plan_excel/Alpha_Nero_Emission_sheet.xlsx"><button class="btn btn-primary" style="margin-left: 11px;">Download Repository File</button></a>
                  
                      </div>                  
                    

                      </div>
                      

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


    window.onload = function() {
        var inputField = document.getElementById('inputField');
        var selectField = document.getElementById('s1');

        // Handle select field changes
        selectField.addEventListener('change', function() {
            reload();
        });

        // Handle input field changes when Enter key is pressed
        inputField.addEventListener('keydown', function(event) {
            if (event.key === "Enter") {
                reload();
            }
        });

        // Handle input field changes when it loses focus
        inputField.addEventListener('blur', function() {
            reload();
        });

        function reload() {
            var s1 = selectField.value;
            var inputFieldValue = inputField.value;
            window.location.href = 'datasource.php?key=' + s1 + '&input=' + inputFieldValue;
        }
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

                  const errorMessage = document.getElementById('error-message');

                      // Function to hide the success message
                      const hideerrorMessage = () => {
                        errorMessage.style.display = 'none';
                      };

                      // Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
                      setTimeout(hideerrorMessage, 5000);




                  </script>

    <?php require 'includes/footer_start.php' ?>

            <!--Morris Chart-->
            <script src="plugins/morris/morris.min.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>

            <!-- Page specific js -->
            <script src="assets/pages/jquery.dashboard.js"></script>

    <?php require 'includes/footer_end.php' ?>
