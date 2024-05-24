<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['location_id'])){
    $id=$_GET['location_id'];

    $sql="delete from location_master where location_master_id=$id";
    
    $result=mysqli_query($conn, $sql);
   
    if($result){
        $delete="Data Deleted Successfully";
        header('location: location.php?delete='.$delete);
        //header('location:datasource.php');

    }else{

        die(mysqli_error($conn));

    }

}

?>