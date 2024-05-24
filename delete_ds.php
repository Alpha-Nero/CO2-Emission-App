<?php
include 'auth.php';
include 'database.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];

    $sql_ds="delete from data_source where data_source_id=$id";
    $sql_dsg="delete from data_source_group where data_source_id=$id";
    $sql_dss="delete from data_source_subcategory where data_source_id=$id";

    $result_ds=mysqli_query($conn, $sql_ds);
    $result_dsg=mysqli_query($conn, $sql_dsg);
    $result_dss=mysqli_query($conn, $sql_dss);

    
    if($result_ds&&$result_dsg&&$result_dss){
        $delete="Data Deleted Successfully";
        header('location: datasource.php?delete='.$delete);
        //header('location:datasource.php');

    }else{

        die(mysqli_error($conn));

    }

}

?>