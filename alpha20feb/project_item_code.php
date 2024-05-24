<?php
include 'auth.php';
include 'database.php';
                
                // checking form submit
                 if(isset($_POST['submit'])){
                 
                
                   $item_code=$_POST['item_code'];
                   $item_quantity=$_POST['item_quantity'];
                   $project_master_id=$_POST['project_master_id'];

                   echo "<br>item id".$item_code;
                   echo "<br>item quantity".$item_quantity;
                   echo "<br>project_master_id".$project_master_id;
                 
                   $sql_c="select * from add_item_to_project where add_Item_to_project_item_id='$item_code' and add_Item_to_project_assign_id=$project_master_id";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 
                  //query for inserting data in to table add_item_to_project
                   $sql_ds= "Insert Into add_item_to_project (add_Item_to_project_assign_id, add_Item_to_project_item_id, add_Item_to_project_item_quantity, add_Item_to_project_is_visibility)
                    Values('$project_master_id', '$item_code','$item_quantity','1')";
                 
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
                  $error="Choose Item is already in Project";
					   header('location:view_project.php?error='.$error."&id=".$project_master_id);
                }




                                      
            }
                 
     ?>