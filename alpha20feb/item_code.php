<?php
include 'auth.php';
include 'database.php';
                
                
                 if(isset($_POST['submit'])){
                 
                $item_category_id=$_POST['item_category_id'];
            //    echo $item_category_id;
                   $item_code=$_POST['item_code'];
                   $item_unit=$_POST['item_unit'];
                   $item_unit2=$_POST['item_unit2'];
                   $item_emission_factor=$_POST['item_emission_factor'];
                   $ideal_emission_factor=$_POST['ideal_emission_factor'];
                   $item_material_detail=$_POST['item_material_detail'];
                   $item_description=$_POST['item_description'];
                  
                  //  echo $item_code;
                   $sql_c="select * from item where item_code='$item_code'";

                   $result_c=mysqli_query($conn, $sql_c);

                   if(!mysqli_num_rows($result_c) > 0){
                  
                    $item_descriptionn= preg_replace("/'/", "\\'",$item_description);
                 
                    $sql_ds = "Insert Into item (item_code, item_unit,item_unit2,item_emission_factor, ideal_emission_factor, item_material_detail, item_description, item_category_id)
                  Values ('$item_code', '$item_unit','$item_unit2','$item_emission_factor', '$ideal_emission_factor', '$item_material_detail', '$item_descriptionn', '$item_category_id')";



                //  echo  $sql_ds;

                   $result_ds= mysqli_query($conn,$sql_ds);
                 
                 
                 if($result_ds){
                    $success="Data Added Successfully";
                  header('location: item.php?success='.$success);
                   echo "";
                   exit();
                 }else{
                  // echo "fail";
                 }
                }else
                {
                  $error="Data Source "."<b>". $data_source_name ."</b>"." is already added into the system. Write another Data source name  ";
						   header('location:datasource.php?error='.$error);
                }
                                      
                 }
                 
                                     ?>