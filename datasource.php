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
                        <h4 style="margin-left:4%;">Data Source</h4>
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
              <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                      <?php echo $errorMessage; ?>
                    </div>
            
              <?php endif; ?>



                                <div class="card">
                                    <form action="data_source_code.php" method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <h4 style="margin-left: 1%;">Add Data Source</h4>
                                        </div>
                                        <hr>
                    <!--row1 -->                    
                    <div class="row">
                  
                    <div class="col-sm-6" >
                      <?php
                      $input = $_GET['input'];
                      
                      ?>
                    <label style=" font-weight:600;" >Add Data Source</label>
                    <input type="text" class="form-control" name="data_source_name" placeholder="Enter Value" id="inputField" value="<?php echo $input?>" required>
                    </div> 
                  
                    </div>
                    <!--./row1 -->
                    <br>
                    <!--row2 -->
                    <div class="row">
                        <?php


                      //fetching value from data icon table 
                      $sql="select * from data_source_icon order by data_source_icon_name ASC";
                      $result=mysqli_query($conn, $sql);
                      $data=array();

                      while($row=mysqli_fetch_assoc($result)){
                        $data[]=$row;

                      }



                      ?>
                  
                  <div class="col-sm-4" >
                  <Label style=" font-weight:600;">Select Data Source icon</Label>
                  <!-- Displaying data icon value in drop down -->
                  <select name="data_source_icon_name" class="form-control " style="margin-top:0px; width:100%" onchange='reload()' id=s1 required >
                            <option value="">Select</option>
        <?php
                              //Foreach loop for providing datasource fields
                              foreach($data as $value){
                                if($value['data_source_icon_name']==$key){

                              
        ?>
                              <option value="<?php echo $value['data_source_icon_name']; ?>" selected ><?php print_r( $value['data_source_icon_name']);?></option>
                      
      <?php
                                }else{
      ?>
                              <option value="<?php echo $value['data_source_icon_name']; ?>" ><?php print_r( $value['data_source_icon_name']);?></option>

                                  
    <?php
                                }
                                
        }
        ?>

                              </select>     
                              <!-- ./select-->          
                              

                              
                              </div> 
                              <!-- div for displaying image which is selected -->
                              <div class="col-md-2" style=" margin: 0% 0% 0% 1%;">
                              <div class="border" style=" border: 1px solid #E2C07F;padding: 5px; height:84px; width :58%; margin: -5% 0% 0% 0%; left:auto;">

                            

                              <?php
                            //   echo $key;

                    if(!empty($key)){
                      
                      $sql_icon="SELECT * FROM data_source_icon where data_source_icon_name='$key';";
                      // echo $sql_icon;
                      $result_icon=mysqli_query($conn, $sql_icon);
                      $data_icon=mysqli_fetch_array($result_icon);
                       $image=$data_icon['data_source_icon_name'];

                      ?>

                    
                      <img src="media/<?php echo $image?>.png" style="right:0; border: 1px solid #E2C07F;padding: 0px;width: 68px;height: 70px;" alt="">
                      <?php 
                    }else{
                      ?>
                    <p style="font-size: medium; color:#4C4C4C ;;">No Image Selected</p>
                    <?php
                    }
                      
                      ?>


                    </div>
                    </div>
                    <!-- end of displaying image box-->
                  
                  </div>
                  

                      <br>
                      <br>
                      <div class="row">
                      
                        <div class="col-sm-6">
                        <div class="form-group">
                        <button class="btn btn-info" type="submit" name="submit" style=" margin-bottom:-100px;">Submit</button> 
        
                        </div>
                        </div>
                      </div>
                      
    <!-- submit button -->
                    
                      </form>
                      
                      </div>
                                      

                  



                      </div>
                      <table id="example1" class="table table-bordered table-striped" style="margin-top: 20px; width:100%;">
                      <thead>

                    
                      <tr >
                                        <th style="width:5%">S.no</th>
                                        <th style="width:15%">Data Source</th>
                                          <th style="width:5%;">Action</th>
                                          </tr>
                      </form>
                      </thead>
                      <tbody>



                        <?php
                        
                        //declaring data_month as array variable
                        $data_month=array();

                        //fetchin data from table consumption
                        $sql = "SELECT * FROM data_source where is_visibility=1
                        order by data_source_id desc;";
                        
                        $result = mysqli_query($conn, $sql);

                        //declaring data_source as array variable
                        $data_source=array();

                        //storing item table data in $data_consumption variable
                        if (mysqli_num_rows($result) > 0) 
                        {
                          
                            while($row= mysqli_fetch_assoc($result)) 
                            {
                              //storing data in $data_consumption array
                              $data_source[]=$row;
                            }

                        }    
                        
                      //   print_r($data_source);
                        // counting $data_consumption array rows
                    $count= count($data_source);

                        // echo count($data_source);

                        $z=1;
                        
                        //loop for printing month and year 
                        for($i=0; $i<$count; $i++){

                      //  echo "ok1";
                      ?>
                      <tr>
                        
                      <td> <?php echo $z; ?> </td>
                      <td> <?php print_r($data_source[$i]['data_source_name']); ?></td>
                        <td >
                        <?php 
                        //storing id in varibale to send in next page
                        $ds_id=$data_source[$i]['data_source_id'];
                        //storing icon name of data source in varibale to send in next page
                        $ds_icon=$data_source[$i]['icon'];
                        $del="delete_ds.php?delete_id=". $ds_id;
                        $edit="data_source_update.php?id=".$ds_id."&key=".$ds_icon;
                        ?>
                        <div style="display:flex; justify-content:flex-start">
                        <a href="<?php echo $edit ?>" class="icon-hover" ><i class="blue  zmdi zmdi-edit"style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp; 
                        
                        <a href="<?php echo $del ?>" ><i class='red zmdi zmdi-delete' style="color:#b28250; margin-right:0px;"></i></a>
                        </td>
                        </div>
                        
                      

                                    
                    <?php
                                  $z++;
                          }
                      
                            ?>

                      
                      </tbody>
                      <tfoot>
                        </tr>
                                        <th style="width:5%">S.no</th>
                                        <th style="width:15%">Data Source</th>
                                        <th style="width:3px;">Action</th>
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




                  </script>

    <?php require 'includes/footer_start.php' ?>

            <!--Morris Chart-->
            <script src="plugins/morris/morris.min.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>

            <!-- Page specific js -->
            <script src="assets/pages/jquery.dashboard.js"></script>

    <?php require 'includes/footer_end.php' ?>
