<?php
include 'auth.php';
require 'header.php';


include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">

<?php 

$dsg_id=$_GET['dsg_id'];
$ds_id=$_GET['ds_id'];
?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6" style="text-align:left;">
                    <h4 style="margin-left: 22px;">Data Source Group </h4>
                </div>




                    <div class="card">
                        <div class="card-body">


                        
                            <div class="card">
                                <form action="data_group_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row" style="text-align:left;">
                                        <h4 style="margin-left: 1%; ">Edit Data Source Group </h4>
                                    </div>
                                    <hr>
                <div class="row">
                <div class="col-sm-6" style="text-align:left;" >

                <?php
                $sql_ds="SELECT * FROM data_source;";
                $result_ds=mysqli_query($conn,$sql_ds); 

                $data_ds=array();
                while($row=mysqli_fetch_assoc($result_ds)){
                    $data_ds[]=$row;

                }
           //  print_r($data_ds);



           $sql_dg="SELECT * FROM data_source_group where data_source_group_id='$dsg_id'";

           $result_dg = mysqli_query($conn, $sql_dg);

           $data_source_group= mysqli_fetch_array($result_dg);



                ?>


                <label >Select Data Source</label>

                <select name="data_source_id" class="form-control" required >
                <option value="">Select</option>
                <?php
                foreach($data_ds as $value){

                    if($value['data_source_id']==$ds_id){
                ?>
                <option value="<?php echo $value['data_source_id']; ?>" selected><?php print_r($value['data_source_name']);?></option>

                <?php
                    }else{
                        ?>

              <option value="<?php echo $value['data_source_id']; ?>" ><?php print_r($value['data_source_name']);?></option>
  
                        <?php
                    }
                }
                ?>
                </select>
                </div> 
                <div class="col-sm-6" style="text-align:left;" >
                <label >Add Data Source Group</label>
                <input type="text" class="form-control" name="data_source_group_name" value="<?php  echo $data_source_group['data_source_group_name']?>" placeholder="Enter Value" required>
                <input type="hidden" class="form-control" name="data_source_group_id" value="<?php  echo $data_source_group['data_source_group_id']?>" placeholder="Enter Value">
                </div> 
               
                </div>
              
                  
                 

                  <br>
                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Update</button> 
    
                    </div>
                    </div>
                    <a href="datagroup.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

                  </div>
                  
<!-- submit button -->
                
                  </form>
                  <?php
                  ?>
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



        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

