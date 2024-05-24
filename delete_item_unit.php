<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['unit_id'])){
    $id=$_GET['unit_id'];

    $sql="delete from item_unit where item_unit_id=$id";
  
    $result=mysqli_query($conn, $sql);
   
   
    if($result){
        $delete="Data Deleted Successfully";
        header('location: item_unit.php?delete='.$delete);
        

    }else{

        $delete="Data Failed to Delete";
        header('location: item_unit.php?delete='.$delete);

    }

}

?>