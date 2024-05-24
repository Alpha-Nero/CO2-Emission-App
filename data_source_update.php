<?php 
include 'auth.php';
require 'header.php';


include 'database.php';
?>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="plugins/morris/morris.css">



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                    <div class="col-sm-6" style="text-align:left;">
                    <h4 style="margin-left: 22px;">Data Source</h4>
                </div>


             



                    <div class="card">
                        <div class="card-body">

 <?php
 $ds_id=$_GET['id'];
 //echo $ds_id;

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
          <div class="alert alert-warning alert-dismissible" style="width: 60%; margin-left:auto; margin-right:auto;margin-top:20px; padding:35px;" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                   <?php echo $errorMessage; ?>
                </div>
        
          <?php endif; ?>




          <?php
          $sql_ds="SELECT * FROM data_source where is_visibility=1 and data_source_id=$ds_id"; 
          $result_ds=mysqli_query($conn, $sql_ds);
          $data_ds=mysqli_fetch_array($result_ds);
          ?>



                            <div class="card">
                                <form action="data_source_update_code.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <h4 style="margin-left: 1%;">Edit Data Source</h4>
                                    </div>
                                    <hr>
                <div class="row">
               
                <div class="col-sm-6"style="text-align:left;" >
                <label >Add Data Source</label>
                <input type="text" class="form-control" name="data_source_name" value="<?php echo $data_ds['data_source_name'] ?>" placeholder="Enter Value" required>
                <input type="hidden" class="form-control" name="data_source_id" value="<?php echo $data_ds['data_source_id'] ?>" placeholder="Enter Value">
                </div> 
               
                </div>

                <br>



                <div class="row">

                <?php 
                
$key=$_GET['key'];
//echo $key;
$sql="select * from data_source_icon order by data_source_icon_name asc";
$result=mysqli_query($conn, $sql);
$data=array();

while($row=mysqli_fetch_assoc($result)){
  $data[]=$row;

}

                
                ?>
               
               <div class="col-sm-4" style="text-align:left;">
               <Label>Select Data Source icon</Label>
               <select name="data_source_icon_name" class="form-control" style="margin-top:0px; width:100%" onchange='reload()' id=s1 required >
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
        </div> 

        <div class="col-md-2" style=" margin: 0% 0% 0% 1%;">
           <div class="border" style=" border: 1px solid #E2C07F;padding: 5px; height:84px; width :57%; margin: -5% 0% 0% 0%; left:auto;">


         <?php

if(!empty($key)){

$sql_icon="SELECT * FROM data_source_icon where data_source_icon_name='$key';";
$result_icon=mysqli_query($conn, $sql_icon);
$data_icon=mysqli_fetch_array($result_icon);
$image=$data_icon['data_source_icon_name'];

?>


<img src="media/<?php echo $image?>.png" style=" border: 1px solid #E2C07F;padding: 5px;width:65px;" alt="">
<?php 
}else{
echo "No Image Selected";
}

?>



</div>
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
                    <a href="datasource.php"> <input style="margin-left: 10%; width: 80px; cursor: pointer;" class="btn btn-info btn-success float-left col-md-12" type="button" value="Back"> </a>             

                    
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


            <script>



function reload() {
    var s1 = document.getElementById('s1').value;
    var data_source_id = <?php echo $ds_id; ?>; // Assuming you have defined $data_source_id in PHP

    window.location.href = 'data_source_update.php?key=' + s1 + '&id=' + data_source_id;
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


        <!--Morris Chart-->
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>


