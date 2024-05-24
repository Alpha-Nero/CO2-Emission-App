<?php
include 'auth.php';
include 'database.php';
                
                //checking form submit 
                 if(isset($_POST['submit'])){
                 
                
                  //storing values into variables
                   $location_master_id=$_POST['location_master_id'];
                   $add_number_of_location=$_POST['add_number_of_location'];
                   $project_master_id=$_POST['project_master_id'];

                   echo "<br>location id".$location_master_id;
                   echo "<br>add_number_of_location ".$add_number_of_location;
                   echo "<br>project_master_id".$project_master_id;
                 
                   $sql_c="select * from add_location_to_project where add_Location_to_project_project_id='$project_master_id' and add_Location_to_project_location_id = $location_master_id ";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 //inserting data query into add_location_to_project
                   $sql_ds= "Insert Into add_location_to_project (add_Location_to_project_project_id, add_Location_to_project_location_id, add_number_of_location, add_Location_to_project_is_visibility)
                    Values('$project_master_id', '$location_master_id','$add_number_of_location','1')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                  header('location: view_project.php?success='.$success."&id=".$project_master_id);
                   echo "";
                   exit();
                 }else{
                  echo "fail";
                 }




                 }else
                 {
                  $error="Choose Location is already in the Project";
					   header('location:view_project.php?error='.$error."&id=".$project_master_id);
                }




                                      
            }
                 
     ?>