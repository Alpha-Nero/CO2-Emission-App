<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                   $data_source_name=$_POST['data_source_name'];
                   $data_source_icon=$_POST['data_source_icon_name'];

                
                   $sql_c="select * from data_source where data_source_name='$data_source_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 
                   $sql_ds= "Insert Into data_source (data_source_name, icon , is_visibility)
                    Values('$data_source_name', '$data_source_icon',  '1')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                    header('location: datasource.php?success='.$success);
                   echo "";
                   exit();
                 }else{
                  echo "fail";
                 }
                }else
                {
                  $error="Data Source "."<b>". $data_source_name ."</b>"." is already added into the system. Write another Data source name  ";
						      header('location:datasource.php?error='.$error);
                }
                                      
                 }
                 
                                     ?>