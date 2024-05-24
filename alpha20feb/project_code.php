<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                
                   $project_name=$_POST['project_name'];
                   $project_master_start_date=$_POST['project_master_start_date'];
                   $project_master_end_date=$_POST['project_master_end_date'];
                   $project_master_description=$_POST['project_master_description'];
                   $project_client_id=$_POST['project_client_id'];
                 
                   $sql_c="select * from project_master where project_name='$project_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 
                   $sql_ds= "Insert Into project_master (project_name,project_master_start_date,project_master_end_date,project_master_description, project_master_is_visibility,project_user_id)
                    Values('$project_name', '$project_master_start_date','$project_master_end_date','$project_master_description','1','$project_client_id')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                  header('location: project.php?success='.$success);
                   echo "";
                   exit();
                 }else{
                  echo "fail";
                 }
                }else
                {
                  $error="Data Source "."<b>". $data_source_name ."</b>"." is already added into the system. Write another Data source name  ";
						   header('location:project.php?error='.$error);
                }
                                      
                 }
                 
                                     ?>