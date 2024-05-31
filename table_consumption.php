<?php
include 'auth.php';
// require 'includes/header_start.php';
include 'database.php'
?>


        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-lQN4BdxCCh5UO0Xn3z3B50s2V5iFww4Vl3bcJG5N6r4Y8bO8f5V0aoEm3m2w6Qgmf" crossorigin="anonymous">


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

                   
                   
                    <div class="card">
                      <div class="card-header" style="background-color: #FFFFFF;">
                      <h5 style=" font-weight:550; font-style:larger; ">Entire Consumption Data</h5>

                      </div>
                      <div class="card-body">
                      

                                <div class="card-title d-flex p-0">
                                <h3 class="card-title"> <a href="consumption.php"><input type="submit" style="margin-left:0%;" class="btn btn-info" name="addnewpatient" value="Add Consumption"></a></h1>

                               <!--   <ul class="nav nav-pills ml-auto p-2" style="text-decoration: none;">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab" >Monthly</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Daily</a></li>
                                   
                                  </ul>-->
                                </div><!-- /.card-header -->



                              
                                <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">

                              
                                <table  class="table table-bordered table-striped active" style="">
                                <thead>

                              
                                <tr>
                                  <th style="width: 10%;">S.No.</th>
                                  <th style="width: 50%;">Month and Year</th>
                                  <th style="width: 10%;">Action</th>
                        
                                </tr>
                                </form>
                                </thead>
                                <tbody>



                                  <?php
                                  

                                  //fetching facility id from logincode page
                                //  $facility_id=$_SESSION['auth_user']['facility_id'];

                                  //declaring data_month as array variable
                                  $data_month=array();

                                  //fetchin data from table consumption
                                  $sql = "SELECT DISTINCT month, year FROM `tbl_month_consumption_sub` WHERE  is_monthly=1 order by  consumption_id desc";
                                  
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
                                    $consumption_month=$data_consumption[$i]['month'];
                                    //storing year in consumption_year variable
                                    $consumption_year=$data_consumption[$i]['year'];
                                
                                    
                                ?>
                                <tr style="width:auto;">
                                <td><?php echo "$z"?> </td>
                                <td>
                              <?php  
                                  //preparing url key for href tag with storing value in consumption_month=$consumption_month and consumption_year=$consumption_year
                                  $url="view_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&key=0";
                                  $url_edit="update_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&key=0";
                                  $url_dup="duplicate_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&key=0";
                                  
                                  $url_del="delete_consumption.php?consumption_month=" . $consumption_month."&consumption_year=". $consumption_year."&key=0";
                                  
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
                                <td style="display:flex; justify-content:flex-start; width:auto;">
                                <a href="<?php echo $url_edit; ?>" style="margin-left:10px ;"><i class="blue zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp;
                                <a href="<?php echo $url_del; ?>" style="margin-left:0px ;"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a> 
                                
                              
                            <!--   <a href="#" style="margin-left:10px ;"> Duplicate</a>  
                                  --></td>
                                              
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





                             <?php /*   <div class="tab-pane" id="tab_2">
                                <!-- Content for Tab 2 -->
                              <table id="#tab_2" class="table table-bordered table-striped">
                                <thead>

                              
                                <tr>
                                  <th style="width: 20%;">S.No.</th>
                                  <th style="width: 50%;">Month and Year</th>
                                  <th style="width: 30%;">Action</th>
                        
                                </tr>
                                </form>
                                </thead>
                                <tbody>



                                  <?php
                                  

                                  //fetching facility id from logincode page
                                //  $facility_id=$_SESSION['auth_user']['facility_id'];

                                  //declaring data_month as array variable
                                  $data_month=array();

                                  //fetchin data from table consumption
                                  $sql = "SELECT DISTINCT consumption_date FROM `tbl_month_consumption_sub` WHERE  is_monthly=0  order by  consumption_id desc";
                                  
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
                                    $consumption_date=$data_consumption[$i]['consumption_date'];
                                    //storing year in consumption_year variable
                                   // $consumption_year=$data_consumption[$i]['year'];
                                
                                    
                                ?>
                                <tr>
                                <td><?php echo "$z"?> </td>
                                <td>
                              <?php  
                                  //preparing url key for href tag with storing value in consumption_month=$consumption_month and consumption_year=$consumption_year
                                  $url="view_consumption.php?consumption_date=" . $consumption_date."&key=1";
                                  $url_edit="update_consumption.php?consumption_date=" . $consumption_date."&key=1";
                                  $url_dup="duplicate_consumption.php?consumption_date=" . $consumption_date."&key=1";
                                  
                                  $url_del="delete_consumption.php?consumption_date=" . $consumption_date."&key=1";
                                  
                                  // echo $url;
                              ?> 
                                  <!-- set href url by php echo $url--> 
                                  <a href="<?php  echo $url ?>">
                              <?php   
                                    print_r($consumption_date);
                                    echo ' ';
                                  //  print_r($consumption_year);
                            ?>       </a>
                                </td>
                                <td>
                                <a href="<?php echo $url_edit; ?>" style="margin-left:10px ;"><i class="blue zmdi zmdi-edit"></i></a> 
                                <a href="<?php echo $url_del; ?>" style="margin-left:10px ;"><i class='red zmdi zmdi-delete'></i></a> 
                                
                              
                            <!--   <a href="#" style="margin-left:10px ;"> Duplicate</a>  
                                  --></td>
                                              
                              <?php

                                  $z++;
                                    }
                                
                                        /*  else {?>
                                          <tr>
                                          <td colspan="8">No data found</td>
                                          </tr>
                                          <?php 
                                      }
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

                                </div> */ ?>
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

