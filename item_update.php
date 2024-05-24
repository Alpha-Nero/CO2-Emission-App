<?php
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';


$id=$_GET['item_id']
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
            .col-sm-2{
                text-align:left;
            }
        </style>

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
                        <div class="card-body">
                            <div class="card">
                                <form action="item_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Edit Items</h4>
                                    </div>
                                    <hr>

                <?php

                $sql="SELECT * FROM item where item_id=$id;";
                $result=mysqli_query($conn, $sql);
                $data_item=mysqli_fetch_array($result);

               // print_r($data_item);
                
                ?>
                <div class="row">

                <div class="col-sm-2" >

                <?php
                $sql_ic="SELECT * FROM item_category;";
                $result_ic=mysqli_query($conn,$sql_ic); 

                $data_ic=array();
                while($row=mysqli_fetch_assoc($result_ic)){
                    $data_ic[]=$row;

                }
           //  print_r($data_ic);


                ?>


                <label >Item Category</label>

                <select name="item_category_id" class="form-control" style="width:80%;" required>
                <option value="">Select</option>
                <?php
                foreach($data_ic as $value){

                if($value['item_category_id']==$data_item['item_category_id']){

                ?>
                <option value="<?php echo $value['item_category_id']; ?>" selected><?php print_r($value['item_category_name']);?></option>

                <?php
                }else{
                ?>
                 <option value="<?php echo $value['item_category_id']; ?>"><?php print_r($value['item_category_name']);?></option>

                <?php }
                }
                ?>
                </select>



              
                </div> 

                <div class="col-sm-2" style="margin-left:-10px;">
                <label style="margin-left:-20px;">Item Code</label>
                <input type="text" class="form-control" name="item_code" value="<?php echo $data_item['item_code'] ?>" placeholder="Enter Value" style="width:70%; margin-left:-20px;" required>
                <input type="hidden" class="form-control" name="item_id" value="<?php echo $data_item['item_id'] ?>">
                </div> 


                <div class="col-sm-2" >
                    
                    <?php
                     $sql_unit="SELECT * FROM item_unit;";
                     $result_unit=mysqli_query($conn,$sql_unit); 
     
                     $data_unit=array();
                     while($row=mysqli_fetch_assoc($result_unit)){
                         $data_unit[]=$row;
     
                     } 
    
                    ?>
                    <label style="margin-left:-68px;">Item Unit1</label>
                    <select name="item_unit" class="form-control" style="margin-left:-68px; width:80%;" required>
                    <option value="">Select</option>
                    <?php
                    foreach($data_unit as $value){
    
                    if($value['item_unit_name']==$data_item['item_unit']){
    
                    ?>
                    <option value="<?php echo $value['item_unit_name']; ?>" selected><?php print_r($value['item_unit_name']);?></option>
    
                    <?php
                    }else{
                    ?>
                     <option value="<?php echo $value['item_unit_name']; ?>"><?php print_r($value['item_unit_name']);?></option>
    
                    <?php }
                    }
                    ?>
                    </select>
                    </div>  
                <!-- end unit1 -->

                <div class="col-sm-2" >
                    
                    
                    <label style="margin-left:-100px">Item Unit2</label>
                    <select name="item_unit2" class="form-control"  style="margin-left:-100px; width:80%;">
                    <option value="">Select</option>
                    <?php
                    foreach($data_unit as $value){
    
                    if($value['item_unit_name']==$data_item['item_unit2']){
    
                    ?>
                    <option value="<?php echo $value['item_unit_name']; ?>" selected><?php print_r($value['item_unit_name']);?></option>
    
                    <?php
                    }else{
                    ?>
                     <option value="<?php echo $value['item_unit_name']; ?>"><?php print_r($value['item_unit_name']);?></option>
    
                    <?php }
                    }
                    ?>
                    </select>
                    </div> 

                

                                <!-- end second unit -->


                <!-- <div class="col-sm-2" >
                <label style="margin-left:-133px;" >Emission Factor</label>
                <input type="text" class="form-control" name="item_emission_factor" value="<?php echo $data_item['item_emission_factor'] ?>" placeholder="Enter Value" style="margin-left:-131px; width:90%" required>
                </div> 
                <div class="col-sm-2" >
                <label style="margin-left:-147px;">Ideal Emission</label>
                <input type="text" class="form-control" name="ideal_emission_factor" value="<?php echo $data_item['ideal_emission_factor'] ?>" placeholder="Enter Value" style="margin-left:-147px; width:95%" required>
               
                </div> 
                <div class="col-sm-2" >
                <label style="margin-left:945px; " >Material Details</label>
                <input type="text" class="form-control" name="item_material_detail" value="<?php echo $data_item['item_material_detail'] ?>" placeholder="Enter Value" style="margin:-28% 0px 0px 52em; width:9em;">
               
                </div> -->
                
                
                    
                  <div class="col-sm-2" style="margin-left:-160px;">
                    <label style="margin-left:24px;">Emission Factor</label>
                    <input type="text" class="form-control" name="item_emission_factor" value="<?php echo $data_item['item_emission_factor'] ?>" placeholder="Enter Value"
                      style="width:90%; margin-left:28px;" required>
                  </div>
                  <div class="col-sm-2" style="margin-left:-20px;">
                    <label style="margin-left:30px;">Ideal Emission</label>
                    <input type="text" class="form-control" name="ideal_emission_factor" value="<?php echo $data_item['ideal_emission_factor'] ?>" placeholder="Enter Value"
                      style="width:90%; margin-left:24px;" required>

                  </div>
                  <div class="col-sm-2" style="margin-left:-20px;">
                    <label style="margin-left:10px;">Material Details</label>
                    <input type="text" class="form-control" name="item_material_detail" value="<?php echo $data_item['item_material_detail'] ?>" placeholder="Enter Value"
                      style="width:90%; margin-left:16px;">

                  </div>
                



                </div>
                <div class="row" >
                <div class="card-body"style="margin: -10px; text-align:left;">
                <label >Description</label>
                <textarea type="text" class="form-control" name="item_description" rows="3" placeholder="Enter Value" ><?php echo $data_item['item_description'] ?></textarea>

                </div>   
                </div>
                  
                 

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                    <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Update</button> 
    
                    </div>
                    </div>
                    <a href="item.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

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

