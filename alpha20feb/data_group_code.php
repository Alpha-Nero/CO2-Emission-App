<?php
include 'auth.php';
include 'database.php';

                
                
                 if(isset($_POST['submit'])){
                 
                   $data_source_group_name=$_POST['data_source_group_name'];
                   $data_source_id=$_POST['data_source_id'];


                  
                   $sql_ds="select * from data_source where data_source_id='$data_source_id' ";
					         $result_ds=mysqli_query($conn, $sql_ds);
						       $ds=mysqli_fetch_array($result_ds);
					         $ds_name=$ds['data_source_name'];



                   $sql_c="select * from data_source_group where data_source_id='$data_source_id' and data_source_group_name='$data_source_group_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){

                 
                   $sql_ds= "Insert Into data_source_group (data_source_group_name ,data_source_id, is_visibility )
                    Values('$data_source_group_name', '$data_source_id', '1')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){

                  $success="Data Added Successfully";
                  header('location: datagroup.php?success='.$success);
                   
                   echo "";
                   exit();
                 }else{
                   die(mysqli_error($conn));
                 }
                }
                else{
                  $error="<b>".$data_source_group_name. "</b> is already added for <b> ".$ds_name." </b> into the system. Create another Data Source Group name for <b>".$ds_name."</b>";
						      header('location:datagroup.php?error='.$error);
              

                }    
                         
    }
                 
                                     ?>