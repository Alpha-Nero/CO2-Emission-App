<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];

    $sql="delete from data_source_subcategory where data_source_subcategory_id=$id";

    $result=mysqli_query($conn, $sql);

    if($result){

        $delete="Data Deleted Successfully";
        header('location: datasubcategory.php?delete='.$delete);
        //header('location:datasubcategory.php');


    }else{

        die(mysqli_error($conn));
    }
}

?>