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
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                       
                        <div class="card">
                            <div class="card-body" style="text-align:left;">
                          
                            <h5 >Entire Emission Data</h5>
                           
                            </div>
                            <hr>
                            <div class="card-title">
                            <h3 class="card-title"><a href="emission.php"><input type="submit" style="margin-left:3%;" class="btn btn-info" name="addnewpatient" value="Add Emission"></a></h1>

                            </div>
                            <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                  <thead>

                 
                  <tr>
                    <th style="width: 20%;">S.No.</th>
                    <th style="width: 50%;">Emission Year</th>
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
                     $sql = "SELECT distinct year from emission_factors  order by  emission_factors_id desc";
                    
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
                    //  $consumption_month=$data_consumption[$i]['month'];
                      //storing year in consumption_year variable
                      $consumption_year=$data_consumption[$i]['year'];
                   
                      
                  ?>
                  <tr>
						       <td><?php echo "$z"?> </td>
						       <td>
                 <?php  
                     //preparing url key for href tag with storing value in consumption_month=$consumption_month and consumption_year=$consumption_year
                     $url="view_emission.php?year=". $consumption_year;
                     $url_edit="emission_update.php?year=". $consumption_year;
                     $url_dup="duplicate_emission.php?year=". $consumption_year;
                     
                     $url_del="delete_emission.php?year=". $consumption_year;
                     
                    // echo $url;
                 ?> 
                    <!-- set href url by php echo $url--> 
                    <a href="<?php  echo $url ?>">
                <?php   
                    
                      print_r("Emission for the year ".$consumption_year);
               ?>       </a>
                  </td>
                  <div style="display-flex; justify-content:flex-start;">
				          <td style="width:10px;">
                 <a href="<?php echo $url_edit; ?>" style="margin-left:10px ;"><i class="blue zmdi zmdi-edit" style="margin-right:0px; color:#b28250;"></i></a> &nbsp;|&nbsp;
                  <a href="<?php echo $url_del; ?>" style="margin-left:0px ;"><i class='red zmdi zmdi-delete' style="margin-right:0px; color:#b28250;"></i></a>
                  <!--
                 
                  <a href="#" style="margin-left:10px ;"> Duplicate</a>  
                     --> </td>
                     </div>
                                
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
                    <th>Emission Year</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>


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

