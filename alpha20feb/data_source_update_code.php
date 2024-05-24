<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['submit'])){
    $name=$_POST['data_source_name'];
    $id=$_POST['data_source_id'];
    $data_source_icon=$_POST['data_source_icon_name'];
    //$data_source_icon=$_POST['data_source_icon_name'];
   // echo $id;
    //echo $name;
  //  for($i=0; $i<count($_POST['data_source_name']); $i++){
    
    $sql= "update data_source set  data_source_name='$name',  icon='$data_source_icon'  where data_source_id='$id'";
    
        $result=mysqli_query($conn, $sql);
    
        if($result){
    
            $update="Data Updated Successfully";
            header('location: datasource.php?update='.$update);
          //  header('location: datasource.php');
    
        }
    
        else{
    
            header('location:data_source_update.php');
    
        }
        
        

}


?>