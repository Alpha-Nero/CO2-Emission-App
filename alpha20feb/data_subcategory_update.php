<?php 
include 'auth.php';
require 'header.php';

include 'database.php';
error_reporting(0);
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <style>
          .form-group{
            text-align:left;
          }
        </style>

<?php 
// require 'includes/header_end.php';

$ds_id=$_GET['ds_id'];
$dsg_id=$_GET['dsg_id'];
$dss_id=$_GET['dss_id'];


$key=$_GET['$key'];

?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6" style="text-align:left">
                    <h4 style="margin-left: 22px;">Data Source Subcategory </h4>
                </div>




                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row" >
                                        <h4 style="margin-left: 1%;">Edit Data Source Subactegory</h4>
                                    </div>

                                  


                                    <hr>
              <div class="row">
                <div class="col-sm-6" style="width: 80%;">
                <div class="form-group">
               
                       <?php 
                       //fetching data from data source table
                       $sql_ds ="Select * from data_source order by data_source_name asc";

                        $result_ds = mysqli_query($conn, $sql_ds);

                        $datas_ds= array();

                        if(mysqli_num_rows($result_ds)>0){

                        while($row_ds=mysqli_fetch_assoc($result_ds)){

                        $datas_ds[]=$row_ds;

                              }
                              
                          }
    ?>
                          <label>Select Data Source</label>
                          <!-- provding names throught data base -->
                         <select name="data_source_id" class="form-control" disabled  style="margin-top:0px;" onchange='reload()' id=s1 required >
                         <option value="">Select</option>
    <?php
                           //Foreach loop for providing datasource fields
                           foreach($datas_ds as $value){

                            if($value['data_source_id']==$ds_id){
    ?>
                           <option value="<?php echo $value['data_source_id']; ?>" selected><?php print_r( $value['data_source_name']);?></option>
                  
     <?php
                            }else{?>

                           <option value="<?php echo $value['data_source_id']; ?>"><?php print_r( $value['data_source_name']);?></option>

                              
<?php
                            }
     }
     ?>
                           </select>
                      
                         
                
                          
                      </div>

                  </div>
                  <?php
                
                
               //  echo $key;
                 ?>

              <div class="col-sm-6">
                  <form method="post" action="data_subcategory_update_code.php">
                  <?php 
//if(isset($_Get['$key'])){
                 // echo $key;
                //fetching data from data source table
                $sql_dsg ="Select * from data_source_group where data_source_id='$ds_id' order by data_source_group_name asc";

                $result_dsg = mysqli_query($conn, $sql_dsg);

                if(mysqli_num_rows($result_dsg)>0){

                while($row_dsg=mysqli_fetch_assoc($result_dsg)){

                    $datas_dsg[]=$row_dsg;
                    

                       }
                  }/*
                }else{
                  echo " fail ";
                }*/
                //print_r($datas_dsg);

              ?>
                 <div class="form-group">
                 <label>Select Data Source Group</label>
                 <select name="data_source_group_id"   class="form-control" required>
                         <option value="">Select</option>
    
       <?php
                           //Foreach loop for providing datasource fields
                           foreach($datas_dsg as $value){

                            if($value['data_source_group_id']==$dsg_id){
     ?>
                           <option value="<?php echo $value['data_source_group_id']; ?>" selected><?php print_r( $value['data_source_group_name']);?></option>
                  
     <?php
                            }
                            else{
                                ?>

                           <option value="<?php echo $value['data_source_group_id']; ?>"><?php print_r( $value['data_source_group_name']);?></option>

                              
<?php
                            }
     }
     ?>
                   </select>
                 </div>
             </div>
                </div>

                <?php
                 $sql_dss ="Select * from data_source_subcategory where data_source_subcategory_id='$dss_id' and is_visibility=1";

                 $result_dss = mysqli_query($conn, $sql_dss);
 
                 $datas_dss=mysqli_fetch_array($result_dss);
              
                 
                ?>
             <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Add Data Source Subcategory</label>
                        <input type="text" name="data_source_subcategory_name" class="form-control" value="<?php echo $datas_dss['data_source_subcategory_name']?>" placeholder="Data source Subcategory" required>
                        <input type="hidden" name="data_source_subcategory_id" class="form-control" value="<?php echo $datas_dss['data_source_subcategory_id']?>" placeholder="Data source Subcategory" >
                        <input type="hidden" name="data_source_id" value="<?php echo $key; ?>"> </div>
                    </div>
                  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Unit for Value</label>
                        <input type="text" name="data_source_subcategory_unit" class="form-control" placeholder="Unit" value="<?php echo $datas_dss['data_source_subcategory_unit']?>" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Unit for Value</label>
                        <input type="text" name="data_source_subcategory_unit2" class="form-control" placeholder="Unit" value="<?php echo $datas_dss['data_source_subcategory_unit2']?>" >
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label>Is it reducing emission?</label>
                        <?php
                        if($datas_dss['is_reduction']=='yes'){
                        ?>
                       <input type="checkbox" name="reduction" value="yes" style="margin-left: 10px ;width:20px ;" checked>

                       
                       <?php
                        }else{
                       ?>
                       
                        <input type="checkbox" name="reduction" value="yes" style="margin-left: 10px ;width:20px ;">
                        <?php
                        }
                        ?>
                        </div>
                      </div>
                    
                  </div>

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-1">
                    <div class="form-group">
                   <button class="btn btn-info" type="submit" name="submit" style="margin-left: 00px; margin-top:0px">Update</button> 
    
                      </div>
                    </div>
                    <a href="datasubcategory.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

                  </div>
                  
                   <!-- submit button -->
                
                  </form>
                   <!-- submit button -->
                
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
  
  function reload(){
    var s1=document.getElementById('s1').value 
    self.location='datasubcategory.php?$key='+s1;
  }

function showModel(){
    document.querySelector('.overlay').classList.add('showoverlay');
    document.querySelector('.loginform').classList.add('showloginform');


}
function closeModel(){
    document.querySelector('.overlay').classList.remove('showoverlay');
    document.querySelector('.loginform').classList.remove('showloginform');


}
  </script>
<?php 
// require 'includes/footer_start.php'
 ?>

        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

<?php
//  require 'includes/footer_end.php'
  ?>
