<?php 
include 'auth.php';
// require 'includes/header_start.php';

include 'database.php';

//error_reporting(0);
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">

<?php 
// require 'includes/header_end.php';
require 'header.php';

$key=$_GET['$key'];

?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6">
                    <h4 style="">Data Source Subcategory </h4>
                </div>




                    <div class="card">
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
			if (isset($_GET['error'])) {
				$errorMessage = $_GET['error'];

			} else {
				$errorMessage = "";
			}

			?>

         <?php if (!empty($errorMessage)): ?>
          <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                   <?php echo $errorMessage; ?>
                </div>
        
          <?php endif; ?>








                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="">Add Data Source Subactegory</h4>
                                    </div>

                                  


                                    <hr>
              <div class="row">
                <div class="col-sm-6" style="width: 80%;">
                <div class="form-group">
                  <form method="post">
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
                          <label style=" font-weight: 600;">Select Data Source</label>
                          <!-- provding names throught data base -->
                         <select name="data_source_id" class="form-control" style="margin-top:0px;" onchange='reload()' id=s1 required >
                         <option value="">Select</option>
    <?php
                           //Foreach loop for providing datasource fields
                           foreach($datas_ds as $value){

                            if($value['data_source_id']==$key){
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
                      
                         
                
                           </form>
                      </div>

                  </div>
                  <?php
                
                
               //  echo $key;
                 ?>

              <div class="col-sm-6">
                  <form method="post" action="data_subcategory_code.php">
                  <?php 
//if(isset($_Get['$key'])){
                 // echo $key;
                //fetching data from data source table
                $sql_dsg ="Select * from data_source_group where data_source_id='$key' order by data_source_group_name asc";

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
                 <label  style=" font-weight: 600;">Select Data Source Group</label>
                  <select name="data_source_group_id"   class="form-control"  required>
                         <option value="">Select</option>
    <?php
                    //Foreach loop for providing datasource fields
                    foreach($datas_dsg as $value){
    ?>
                  <option value="<?php echo $value['data_source_group_id']; ?>" ><?php print_r( $value['data_source_group_name']);?></option>
                 

     <?php
     }
     ?>
                   </select>
                 </div>
             </div>
                </div>
             <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label style=" font-weight: 600;">Add Data Source Subcategory</label>
                        <input type="text" name="data_source_subcategory_name" class="form-control"  placeholder="Data source Subcategory" required>
                    <input type="hidden" name="data_source_id" value="<?php echo $key; ?>"> </div>
                    </div>
                  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label style=" font-weight: 600;">Value 1</label>
                        <input type="text" name="data_source_subcategory_unit" class="form-control" placeholder="Unit"  required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label style=" font-weight: 600;">Value 2</label>
                        <input type="text" name="data_source_subcategory_unit2" class="form-control" placeholder="Unit" >
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label style=" font-weight: 600;">Is it reducing emission?</label>
                       
                       
                       
                        <input type="checkbox" name="reduction" value="yes" style=" ;width:20px ;">
                        
                        </div>
                      </div>
                    
                  </div>

                  <br>
                  <div class="row">
                   
                    <div class="col-sm-6">
                    <div class="form-group">
                   <button class="btn btn-info" type="submit" name="submit" style="margin-top:0px">Submit</button> 
    
                      </div>
                    </div>
                  </div>
                  
<!-- submit button -->
                
                  </form>
<!-- submit button -->
                
                 
                  <?php
                  ?>
                  </div>
                                   

              



                  </div>
                  <table id="example1" class="table table-striped table-bordered" style="margin-top: 20px;">
                  <thead>

                 
                  <tr>
                                		<th>S.no</th>
                                    <th >Data Source</th>
                                		<th>Data Source Group</th>
                                		<th >Data Source Subcategory</th>
                                		<th >Unit1</th>
                                		<th >Unit2</th>
                                		<th >Action</th>
                  	</tr>
                  <!-- </form> -->
                  </thead>
                  <tbody>



                    <?php
                    
                    //declaring data_month as array variable
                     $data_month=array();

                     //fetchin data from table consumption
                    //  $sql = "SELECT * FROM data_source_subcategory as dss
                    //  join data_source_group as dsg on dss.data_source_group_id=dsg.data_source_group_id
                    //  join data_source as ds on dsg.data_source_id=ds.data_source_id
                    //  where dsg.is_visibility=1 and ds.is_visibility=1 and dss.is_visibility=1
                    //  order by dss.data_source_subcategory_id desc;";

                     $sql ="select * from data_source_subcategory join data_source_group on data_source_subcategory.data_source_group_id =data_source_group.data_source_group_id
                     join data_source on data_source_group.data_source_id  = data_source.data_source_id
                     where data_source_group.is_visibility=1 and data_source.is_visibility=1 and data_source_subcategory.is_visibility=1 order by data_source_subcategory.data_source_subcategory_id desc;";                    
                    
                     $result = mysqli_query($conn, $sql);

                     //declaring data_dss as array variable
                     $data_dss=array();

                     //storing item table data in $data_consumption variable
                     if (mysqli_num_rows($result) > 0) 
                     {
                      
                         while($row= mysqli_fetch_assoc($result)) 
                         {
                          //storing data in $data_consumption array
                          $data_dss[]=$row;
                         }

                     }    
                    
                  //   print_r($data_dss);
                     // counting $data_consumption array rows
                 $count= count($data_dss);

                    // echo count($data_dss);

                     $z=1;
                    
                     //loop for printing month and year 
                     for($i=0; $i<$count; $i++){

                   //  echo "ok1";
                  ?>
                  <tr>
						       <td> <?php echo $z; ?> </td>
                   <td> <?php print_r($data_dss[$i]['data_source_name']); ?></td>
						       <td> <?php print_r($data_dss[$i]['data_source_group_name']); ?></td>
                   <td> <?php print_r($data_dss[$i]['data_source_subcategory_name']); 
                      ?></td>
                      <td> <?php print_r($data_dss[$i]['data_source_subcategory_unit']); 
                      ?></td>
                      <td> <?php print_r($data_dss[$i]['data_source_subcategory_unit2']); 
                      ?></td>
                   <td>
                    <?php 
                    $ds_id=$data_dss[$i]['data_source_id'];
                    $dsg_id=$data_dss[$i]['data_source_group_id'];
                    $dss_id=$data_dss[$i]['data_source_subcategory_id'];
                    $del="delete_dss.php?delete_id=". $dss_id;
                    $edit="data_subcategory_update.php?dss_id=".$dss_id."&dsg_id=".$dsg_id."&ds_id=".$ds_id;
                    ?>
                                        
                    <div style="">

                    <a href="<?php echo $edit ?>"><i class="blue  zmdi zmdi-edit" style="margin-right:0%; color:#b28250;"></i></a> |

                     <a href="<?php echo $del ?>"><i class='red zmdi zmdi-delete'  style="margin-right:0%; color:#b28250;"></i></a>
                    </td>
                     </div>

                                
                <?php
                               $z++;
                      }
                   
                         ?>

                  
                  </tbody>
                  <tfoot>
                  <tr>
                                    <th style="width:5%">S.no</th>
                                    <th style="width:20%">Data Source</th>
                                		<th style="width:25%">Data Source Group</th>
                                		<th style="width:35%">Data Source Subcategory</th>
                                		<th style="width:15%">Unit1</th>
                                    <th style="width:15%">Unit2</th>
                                    <th style="width:15%">Action</th>
                                    
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

        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>


