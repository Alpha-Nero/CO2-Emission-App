<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                
                   $location_master_name=$_POST['location_master_name'];
                   $location_master_area=$_POST['location_master_area'];
                   $location_master_description=$_POST['location_master_description'];
                 
                   $sql_c="select * from location_master where location_master_name='$location_master_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 
                   $sql_ds= "Insert Into location_master (location_master_name,location_master_area,location_master_description)
                    Values('$location_master_name', '$location_master_area','$location_master_description')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                  header('location: location.php?success='.$success);
                   echo "";
                   exit();
                 }else{
                  echo "fail";
                 }
                }else
                {
                  $error="Data Source "."<b>". $data_source_name ."</b>"." is already added into the system. Write another Data source name  ";
						   header('location:location.php?error='.$error);
                }
                                      
                 }
                 
                                     ?>