<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['item_id'])){
    $id=$_GET['item_id'];

    $sql="delete from item_category where item_category_id=$id";
  
    $result=mysqli_query($conn, $sql);
   
   
    if($result){
        $delete="Data Deleted Successfully";
        header('location: item_category.php?delete='.$delete);
        //header('location:datasource.php');

    }else{

        die(mysqli_error($conn));

    }

}

?>