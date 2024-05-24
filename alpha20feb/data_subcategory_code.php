<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                   $data_source_subcategory_name=$_POST['data_source_subcategory_name'];
                   $data_source_id=$_POST['data_source_id'];
                   $data_source_group_id=$_POST['data_source_group_id'];
                   $data_source_subcategory_unit=$_POST['data_source_subcategory_unit'];
                   $data_source_subcategory_unit2=$_POST['data_source_subcategory_unit2'];
                   $reduction = isset($_POST['reduction']) ? $_POST['reduction'] : 'no';


                  // echo $data_source_subcategory_name;

                   $sql_dsg="select grp.*, ds.data_source_name 
                             from data_source_group grp, data_source ds 
                             where grp.data_source_id=ds.data_source_id and grp.data_source_group_id='$data_source_group_id' and ds.data_source_id='$data_source_id'";
					         $result_dsg=mysqli_query($conn, $sql_dsg);
						       $dsg=mysqli_fetch_array($result_dsg);
                   $ds_name=$dsg['data_source_name'];
					         $dsg_name=$dsg['data_source_group_name'];



                  $sql_c="select * from data_source_subcategory where data_source_id='$data_source_id' and data_source_group_id='$data_source_group_id' and data_source_subcategory_name='$data_source_subcategory_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){




                 
                   $sql_ds= "Insert Into data_source_subcategory (data_source_subcategory_name ,data_source_id, data_source_group_id, data_source_subcategory_unit,data_source_subcategory_unit2, is_reduction)
                    Values('$data_source_subcategory_name', '$data_source_id', '$data_source_group_id', '$data_source_subcategory_unit','$data_source_subcategory_unit2', '$reduction')";
                 
                  //  echo $sql_ds;
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                   echo 'again1';
                 
                 if($result_ds){
                  $success="Data Added Successfully";
                  header('location: datasubcategory.php?success='.$success);
                    
                   exit();
                 }else{
                   die(mysqli_error($conn));
                 }
                }

                else{
                  $error= "<b>".$data_source_subcategory_name ."</b> is already added for <b>". $ds_name."</b> under group <b>".$dsg_name."</b> into the system. Create another Data Source Sub Category name for <b>". $ds_name."</b> under Group <b>". $dsg_name."</b>";
						      header('location:datasubcategory.php?error='.$error);
              

                }   
                                      
                 }
                 
                                     ?>