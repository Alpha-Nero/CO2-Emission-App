<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                   $item_category_name=$_POST['item_category_name'];
                   $item_category_description=$_POST['item_category_description'];
                 
                   $sql_c="select * from item_category where item_category_name='$item_category_name'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                 
                   $sql_ds= "Insert Into item_category (item_category_name,item_category_description)
                    Values('$item_category_name', '$item_category_description')";
                 
                    echo 'again';
                 
                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                  header('location: item_category.php?success='.$success);
                   echo "";
                   exit();
                 }else{
                  echo "fail";
                 }
                }else
                {
                  $error="Data Source "."<b>". $data_source_name ."</b>"." is already added into the system. Write another Data source name  ";
						   header('location:item_category.php?error='.$error);
                }
                                      
                 }
                 
                                     ?>