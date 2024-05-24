<?php
include 'auth.php';
include 'database.php';

// echo "ok";
if (isset($_POST['submit'])){
   // echo "ok1";
    $name=$_POST['data_source_group_name'];

    $id=$_POST['data_source_group_id'];
    $data_source_id=$_POST['data_source_id'];
    // echo $data_source_id;
    // echo $id;
    // echo $name;
  //  for($i=0; $i<count($_POST['data_source_name']); $i++){
    
    $sql= "update data_source_group set  data_source_group_name='$name' , data_source_id= '$data_source_id' where data_source_group_id='$id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
         $update="Data Updated Successfully";
         header('location: datagroup.php?update='.$update);
          // header('location: datagroup.php');
    
        }
    
        else{
    
           header('location:datagroup_update.php');
    
        }

}


?>